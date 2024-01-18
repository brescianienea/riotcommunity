<?php

class Message
{
    static function getMessagesSent($receiver, $sender)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiverID = $receiver;
            $senderID = $sender;
            $response = [];
            if (!empty($senderID) && !empty($receiverID)) {
                $query = "SELECT message_id, sender_id, content, datetime_sent FROM message";
                $query .= " WHERE sender_id = " . $senderID . " AND";
                $query .= " receiver_id = " . $receiverID;
                $query .= " OR sender_id = " . $receiverID;
                $query .= " AND receiver_id = " . $senderID;
                $query .= " ORDER BY datetime_sent DESC";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $mex = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($mex, $row);
                        $i++;
                    }
                    return $mex;
                } else {
                    return [];
                }

            } else {
                return [];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getAllChats($user_id)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $user_id = $user_id;
            $response = [];
            if (!empty($user_id)) {
                $query = "SELECT DISTINCT sender_id, receiver_id FROM message";
                $query .= " WHERE sender_id = " . $user_id;
                $result = $db->query($query);
                $query = "SELECT DISTINCT sender_id, receiver_id FROM message";
                $query .= " WHERE receiver_id = " . $user_id;
                $result2 = $db->query($query);
                if ($result->num_rows > 0 || $result2->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $mex = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($mex, $row['receiver_id']);
                        $i++;
                    }
                    $i = 0;
                    while ($i < $result2->num_rows) {
                        $row = $result2->fetch_assoc();
                        if (!in_array($row['sender_id'], $mex)) {
                            array_push($mex, $row['sender_id']);
                        }
                        $i++;
                    }
                    $mex = array_reverse($mex);
                    return $mex;
                } else {
                    return [];
                }

            } else {
                return [];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}