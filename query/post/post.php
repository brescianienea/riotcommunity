<?php

class Post
{

    static function getPostsByID($userData, $tenorTag = null, $gameTag = null, $sorting = null)
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
                $query = "";
                if ($sorting == "popularity") {
                    $query = "SELECT post.*, COUNT(post_id) AS likeNum FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                    $query .= " WHERE member_id = " . $userID;
                } else {
                    $query = "SELECT * FROM post";
                    $query .= " WHERE member_id = " . $userID;
                }
                if ($tenorTag != null) {
                    $query .= " AND tenor_tag = '" . $tenorTag . "'";
                }
                if ($gameTag != null) {
                    $query .= " AND game_tag = '" . $gameTag . "'";
                }
                if ($sorting == "popularity") {
                    $query .= " GROUP BY post.post_id ORDER BY likeNum";
                } else {
                    $query .= " ORDER BY datetime_posted DESC";
                }
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

    static function getPostsByMultipleIDs($userData, $tenorTag = null, $gameTag = null, $sorting = null)
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
                $posts = [];
                $users = " WHERE member_id IN (" . implode(', ', $userID) . ")";
                if ($users != "") {
                    $query = "";
                    if ($sorting == "popularity") {
                        $query = "SELECT post.*, COUNT(post_id) AS likeNum FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                        $query .= $users;
                    } else {
                        $query = "SELECT * FROM post";
                        $query .= $users;
                    }
                    if ($tenorTag != null) {
                        $query .= " AND tenor_tag = '" . $tenorTag . "'";
                    }
                    if ($gameTag != null) {
                        $query .= " AND game_tag = '" . $gameTag . "'";
                    }
                    if ($sorting == "popularity") {
                        $query .= " GROUP BY post.post_id ORDER BY likeNum";
                    } else {
                        $query .= " ORDER BY datetime_posted DESC";
                    }
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        //$result = $result->fetch_assoc();
                        $i = 0;
                        while ($i < $result->num_rows) {
                            $row = $result->fetch_assoc();
                            array_push($posts, $row);
                            $i++;
                        }
                    }
                }
                return $posts;
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getPostsByPostID($userData, $tenorTag = null, $gameTag = null, $sorting = null)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $postID = $userData;
            $response = [];
            if (!empty($postID)) {
                $query = "";
                if ($sorting == "popularity") {
                    $query = "SELECT post.*, COUNT(post_id) AS likeNum FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                    $query .= " WHERE post_id = " . $postID;
                } else {
                    $query = "SELECT * FROM post";
                    $query .= " WHERE post_id = " . $postID;
                }
                if ($tenorTag != null) {
                    $query .= " AND tenor_tag = '" . $tenorTag . "'";
                }
                if ($gameTag != null) {
                    $query .= " AND game_tag = '" . $gameTag . "'";
                }
                if ($sorting == "popularity") {
                    $query .= " GROUP BY post.post_id ORDER BY likeNum";
                } else {
                    $query .= " ORDER BY datetime_posted DESC";
                }
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $i = 0;
                    $posts = [];
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

    static function getAllPosts($tenorTag = null, $gameTag = null, $sorting = null)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $response = [];
            $query = "";
            if ($sorting == "popularity") {
                $query = "SELECT post.*, COUNT(post_id) AS likeNum FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
            } else {
                $query = "SELECT * FROM post";
            }
            if($tenorTag != null || $gameTag != null) {
                $query .= " WHERE";
            }
            if ($tenorTag != null) {
                $query .= " tenor_tag = '" . $tenorTag . "'";
            }
            if ($gameTag != null) {
                if($tenorTag != null) {
                    $query .= " AND";
                }
                $query .= " game_tag = '" . $gameTag . "'";
            }
            if ($sorting == "popularity") {
                $query .= " GROUP BY post.post_id ORDER BY likeNum";
            } else {
                $query .= " ORDER BY datetime_posted DESC";
            }
            $result = $db->query($query);
            $posts = [];
            if ($result->num_rows > 0) {
                //$result = $result->fetch_assoc();
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
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}