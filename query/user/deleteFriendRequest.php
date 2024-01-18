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
addFriend($db, $userData);

function addFriend($db, $userData)
{
    $sender = $_SESSION['user_id'];
    $receiver = $userData['user_id'];
    $response = [];

    try {
        if (!empty($sender) && !empty($receiver)) {
            $query = "SELECT sender FROM friend_requests";
            $query .= " WHERE sender = '$sender'";
            $query .= " AND receiver = '$receiver'";
            $query .= " OR sender = '$receiver'";
            $query .= " AND receiver = '$sender'";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $query = "DELETE FROM friend_requests";
                $query .= " WHERE sender = '$sender'";
                $query .= " AND receiver = '$receiver'";
                $query .= " OR sender = '$receiver'";
                $query .= " AND receiver = '$sender'";
                $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
                $notification['user_id'] = $receiver;
                $notification['friendreq_notification'] = -1;
                $notification['chat_notification'] = 0;
                Notification::addNotification($notification['user_id'], $notification['friendreq_notification'], $notification['chat_notification']);


            } else {
                $response['message'] = "Friend request doesn't exist.";
            }
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}