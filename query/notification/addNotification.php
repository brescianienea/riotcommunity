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

function addNotification($db, $userData, $reset = false)
{
    $user_id = $userData['user_id'];
    $friendreq_notification = $userData['friendreq_notification'];
    $chat_notification = $userData['chat_notification'];
    $response = [];

    try {
        if (!empty($user_id) && !empty($friendreq_notification) && !empty($chat_notification)) {
            if(!$reset) {
                $query = "SELECT friendreq_notification, chat_notification FROM notifications";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_assoc();
                    return $result;
                }
                $fr = $result['friendreq_notification'] + $friendreq_notification;
                $cn = $result['chat_notification'] + $chat_notification;
                $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`, `chat_notification`) VALUES ('$user_id', '$fr', '$cn')";
                $db->query($query);
            } else {
                if($friendreq_notification == 1) {
                    $friendreq_notification = 0;
                    $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`) VALUES ('$user_id', '$friendreq_notification')";
                    $db->query($query);
                }
                if($chat_notification == 1) {
                    $chat_notification = 0;
                    $query = "INSERT INTO `notifications` (`user_id`, `chat_notification`) VALUES ('$user_id', '$chat_notification')";
                    $db->query($query);
                }
                
            }
            
            $response['message'] = "success";
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}