<?php
session_start();
ini_set('display_errors', 0); // hide warning
require_once("../../connection/connect_db.php");

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT `username`, `is_verified` FROM `tbl_user` WHERE `email` = '$email' AND user_password = '$password'";
$result = mysqli_query($conn, $sql);

// print_r($sql);
if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);

    $username = $row['username'];
    $verified = $row['is_verified'];

    if ($verified == 1) {

        $sql_user = "SELECT A.*, B.profile_pic 
                    FROM `tbl_user` A 
                    INNER JOIN `tbl_user_info` B 
                    ON A.username = B.username
                    WHERE A.username = '$username'";

        $result_user = mysqli_query($conn, $sql_user);

        if (mysqli_num_rows($result_user) != 0) {
            while ($row_user = mysqli_fetch_assoc($result_user)) {
                $session_keys = array_keys($row_user);
                foreach ($session_keys as $keys) {
                    $_SESSION[$keys] = $row_user[$keys];
                }
            }
            echo "success";
        }
    } else {
        echo "not verified";
    }
} else {
    echo "not found";
}
?>
