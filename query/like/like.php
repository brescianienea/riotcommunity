<?php
class Like {
    static function getLikesByID($userData)
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
                $query = "SELECT post_id FROM likes";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $posts = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($posts, $row);
                        $i++;
                    }
                    return $posts;
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