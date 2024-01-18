<?php

class Notification
{

    static function getNotificationsByID($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $userID = $userData;
            $response = [];
            if (!empty($userID)) {
                $query = "SELECT friendreq_notification, chat_notification FROM notifications";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_assoc();
                    return $result;
                } else {
                    return null;
                }

            } else {
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }


    static function addNotification($user_id, $friendreq_notification, $chat_notification, $reset = false)
    {
        try {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            if (!empty($user_id) && (!empty($friendreq_notification) || $friendreq_notification == 0) && (!empty($chat_notification) || $chat_notification == 0)) {

                if (!$reset) {
                    $query = "SELECT friendreq_notification, chat_notification FROM notifications";
                    $query .= " WHERE user_id = " . $user_id;
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        $result = $result->fetch_assoc();
                        $fr = $result['friendreq_notification'] + $friendreq_notification;
                        $cn = $result['chat_notification'] + $chat_notification;
                        $query = "UPDATE `notifications`  SET  `friendreq_notification` = '$fr', `chat_notification` =  '$cn' WHERE `user_id` = $user_id   ";
                        $db->query($query);
                    }
                } else {
                    if ($friendreq_notification == 1) {
                        $friendreq_notification = 0;
                        $query = "UPDATE `notifications`  SET  `friendreq_notification` = '$friendreq_notification' WHERE `user_id` = $user_id";

                        $db->query($query);
                    }
                    if ($chat_notification == 1) {
                        $chat_notification = 0;
                        $query = "UPDATE `notifications`  SET  `chat_notification` = '$chat_notification' WHERE `user_id` = $user_id";

                        $db->query($query);
                    }

                }
            }

        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

}