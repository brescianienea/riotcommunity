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
$db = $conn;
$userData = $_POST;
addFriendRequest($db, $userData);

function addFriendRequest($db, $userData)
{
    $sender = $_SESSION['user_id'];
    $receiver = $userData['user_id'];
    $response = [];
    try {
        if (!empty($sender) && !empty($receiver)) {
            $query = "SELECT sender FROM friend_requests";
            $query .= " WHERE receiver = '$sender'";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $response['message'] = "Friend request already sent by receiver.";
            } else {
                $query = "INSERT INTO `friend_requests` (`sender`, `receiver`) VALUES ('$sender', '$receiver')";
                $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
                $notification['user_id'] = $receiver;
                $notification['friendreq_notification'] = 1;
                $notification['chat_notification'] = 0;
                Notification::addNotification($notification['user_id'], $notification['friendreq_notification'], $notification['chat_notification']);
            }
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}