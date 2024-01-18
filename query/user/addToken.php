<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
require_once("user.php");
$db = $conn;
$userData = $_POST;
addToken($db, $userData);

function addToken($db, $userData) {
    $user_id = User::getIDByUsername($userData['username']);
    $token = $userData['token'];
    $response = [];

    try {
        if (!empty($userID) && !empty($token)) {
            $query = "INSERT INTO `tokens` (`user_id`, `token`) VALUES ('$user_id', '$token')";
            $db->query($query);
            $response['message'] = "success";
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}