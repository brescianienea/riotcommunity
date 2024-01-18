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
addFriend($db, $userData);

function addFriend($db, $userData)
{
    $my_id = $_SESSION['user_id'];
    $friends_id = $userData['user_id'];
    $response = [];

    try {
        if (!empty($my_id) && !empty($friends_id)) {
            $query = "SELECT sender FROM friend_requests";
            $query .= " WHERE sender = '$my_id'";
            $query .= " AND receiver = '$friends_id'";
            $query .= " OR sender = '$friends_id'";
            $query .= " AND receiver = '$my_id'";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $query = "INSERT INTO `friends` (`my_id`, `friends_id`) VALUES ('$my_id', '$friends_id')";
                $db->query($query);
                $query = "DELETE FROM friend_requests";
                $query .= " WHERE sender = '$my_id'";
                $query .= " AND receiver = '$friends_id'";
                $query .= " OR sender = '$friends_id'";
                $query .= " AND receiver = '$my_id'";
                $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
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