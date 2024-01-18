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
deleteFriend($db, $userData);

function deleteFriend($db, $userData) {

    $my_id = $_SESSION['user_id'];
    $friends_id = $userData['user_id'];
    $response = [];

    try {
        if (!empty($my_id) && !empty($friends_id)) {
            $query = "SELECT my_id FROM friends";
            $query .= " WHERE my_id = '$my_id'";
            $query .= " AND friends_id = '$friends_id'";
            $query .= " OR my_id = '$friends_id'";
            $query .= " AND friends_id = '$my_id'";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $query = "DELETE FROM friends";
                $query .= " WHERE my_id = '$my_id'";
                $query .= " AND friends_id = '$friends_id'";
                $query .= " OR my_id = '$friends_id'";
                $query .= " AND friends_id = '$my_id'";
                $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
            } else {
                $response['message'] = "Friendship doesn't exist.";
            }
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}