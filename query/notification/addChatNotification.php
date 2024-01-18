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
addNotification($db, $userData);

function addNotification($db, $userData)
{
    $receiver_id = $_SESSION['receiver_id'];
    $sender_id = $userData['sender_id'];
    $unread = $userData['unread'];
    $response = [];

    try {
        if (!empty($receiver_id) && !empty($sender_id) && !empty($unread)) {
            $query = "INSERT INTO `notifications` (`receiver_id`, `sender_id`, `unread`) VALUES ('$receiver_id', '$sender_id', '$unread')";
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