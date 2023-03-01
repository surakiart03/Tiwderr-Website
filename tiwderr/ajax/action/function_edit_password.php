<?php
session_start();
ini_set('display_errors', 0); // hide warning
require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$password_old = md5($_POST['password_old']);
$password_new = md5($_POST['password_new']);

$sql_check = "SELECT * FROM `tbl_user`
                WHERE `username` = '$username' AND `user_password` = '$password_old'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) != 0) {
    $sql = "UPDATE `tbl_user`
            SET `user_password` = '$password_new'
            WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "pass";
    } else {
        echo "something error";
    }
    
} else {
    echo "failed";
}

?>
