<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
require_once("{$base_dir}query/notification/notification.php")

?>
<?php
require_once("../user/user.php");
$db = $conn;
$userData = $_POST;
addMessage($db, $userData);

function addMessage($db, $userData)
{
    $dateTime = date('m/d/Y h:i:s a');
    $timestamp = strtotime($dateTime);
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $userData['receiver_id'];
    $content = $userData['message-text'];
    $datetime_sent = date('Y-m-d H:i:s', $timestamp);;
    $response = [];
    try {
        if (!empty($sender_id) && !empty($receiver_id) && !empty($content) && !empty($datetime_sent)) {
            $query = "INSERT INTO `message` (`sender_id`, `receiver_id`, `content`, `datetime_sent`) VALUES ('$sender_id', '$receiver_id', '$content', '$datetime_sent')";
            $db->query($query);
            $response['message'] = "success";
            $notification['user_id'] = $receiver_id;
            $notification['friendreq_notification'] = 0;
            $notification['chat_notification'] = 1;
            Notification::addNotification($notification['user_id'], $notification['friendreq_notification'], $notification['chat_notification']);

        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}