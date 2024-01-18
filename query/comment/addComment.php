<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
require_once("../user/user.php");
$db = $conn;
$userData = $_POST;
addComment($db, $userData);

function addComment($db, $userData)
{
    $user_id = $_SESSION['user_id'];
    $comment_id = $userData['post_id'];
    $content = $userData['comment'];
    $response = [];

    try {
        if (!empty($user_id) && !empty($comment_id) && !empty($content)) {
            $query = "INSERT INTO `comments` (`user_id`, `comment_id`, `content`) VALUES ('$user_id', '$comment_id', '$content')";
            $db->query($query);
            $response['message'] = "success";
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}