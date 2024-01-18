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
registerUser($db, $userData);
function registerUser($db, $userData)
{

    $mail = $userData['mail'];
    $day = $userData['day'];
    $month = $userData['month'];
    $year = $userData['year'];
    $username = $userData['username'];
    $password = $userData['password'];
    $response = [];
    try {
        if (!empty($username) && !empty($password) && !empty($day) && !empty($month) && !empty($year)) {
            $date = $year . "-" . $month . "-" . $day;
            $dateTimeStamp = strtotime($date);
            $currentTimestamp = time();

            if (checkdate($month, $day, $year) && $dateTimeStamp < $currentTimestamp) {
                $currYear = date("Y");
                $currMonth = date("M");
                $currDay = date("D");
                $age = $currYear - $year;
                if ($age == 16) {
                    if ($currMonth > $month || ($currMonth == $month && $currDay > $day)) {
                        $age--;
                    }
                }
                if ($age >= 16) {
                    $query = "SELECT username FROM " . tableName;
                    $query .= " WHERE username = '$username'";
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        $response['message'] = "Username already in use.";
                    } else {
                        $query = "SELECT email FROM " . "members";
                        $query .= " WHERE email = '$mail'";
                        $result = $db->query($query);
                        if ($result->num_rows > 0) {
                            $response['message'] = "Email already in use.";
                        } else {
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $query = "INSERT INTO `users` (`username`, `password`, `admin`) VALUES ('$username', '$hashedPassword', 0)";

                            $db->query($query);
                            $query = "SELECT user_id FROM " . tableName;
                            $query .= " WHERE username = '$username'";
                            $result = $db->query($query);
                            if ($result->num_rows != 1) {
                                $response['message'] = "Something went wrong.";
                            } else {
                                $resultArr = $result->fetch_array(MYSQLI_BOTH);
                                $memberID = $resultArr['user_id'];
                                $dateFinal = date("Y-m-d", strtotime($year . '-' . $month . '-' . $day));
                                $query = "INSERT INTO `members` (`member_id`, `email`, `birthdate`) VALUES ('$memberID', '$mail', '$dateFinal')";
                                $db->query($query);
                                $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`, `chat_notification`) VALUES ('$memberID', 0, 0)";
                                $db->query($query);
                                $response['message'] = "success";
                            }
                            //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
                        }
                    }
                } else {
                    $response['message'] = "The date is not valid.\nNot 16 Years old.";
                }
            } else {
                $response['message'] = "The date is not valid.";
            }
        } else {
            $response['message'] = "All Fields are required";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }


    echo json_encode($response);
}