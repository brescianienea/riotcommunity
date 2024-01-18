<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
$db = $conn;
$userData = $_POST;

addPost($db, $userData);

function addPost($db, $userData)
{
    $dateTime = date('m/d/Y h:i:s a');
    $timestamp = strtotime($dateTime);
    $member_id = $_SESSION['user_id'];
    $content = $userData['content'];
    $datetime_posted = date('Y-m-d H:i:s', $timestamp);
    $title = $userData['title'];
    $tenor_tag = isset($userData['tenor_tag']) ? $userData['tenor_tag'] : '';
    $game_tag = isset($userData['game_tag']) ? $userData['game_tag'] : '';
    $response = [];

    try {
        if (!empty($member_id) && !empty($content) && !empty($datetime_posted)) {
            $query = "INSERT INTO `post` (`member_id`,`title`, `content`, `datetime_posted`, `tenor_tag`, `game_tag`) VALUES ('$member_id', '$title' ,'$content', '" . $datetime_posted . "', '$tenor_tag', '$game_tag')";
            $db->query($query);
            $response['message'] = "success";
            //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}