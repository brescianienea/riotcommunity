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
const tableName = 'users';
$userData = $_POST;
loginUser($db, $userData);
function loginUser($db, $userData)
{

    $username = $userData['username'];
    $password = $userData['password'];
    $response = [];
    if (!empty($username) && !empty($password)) {

        $query = "SELECT user_id, username, password FROM " . tableName;
        $query .= " WHERE username = '$username'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $result = $result->fetch_array(MYSQLI_BOTH);
            if (password_verify($password, $result['password'])) {
                $response['message'] = "success";
                $_SESSION['logged'] = 'true';
                $_SESSION['user_id'] = $result['user_id'];
            } else {
                $response['message'] = "Wrong username or password";
            }

        } else {
            $response['message'] = "Wrong username or password";

        }

    } else {
        $response['message'] = "All Fields are required";
    }

    echo json_encode($response);
}