<?php
session_start();
require_once("../../../connection/connect_db.php");

$username   = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$create_by = $_POST['create_by'];

$sql_check = "SELECT 
                    COUNT(CASE WHEN (`username` = '$username') THEN 1 ELSE NULL END) AS `username`
                    , COUNT(CASE WHEN (`email` = '$email') THEN 1 ELSE NULL END) AS `email`
            FROM `tbl_admin`";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) != 0) {
    foreach ($result_check as $row) {
        $is_username = $row['username'];
        $is_email = $row['email'];
    }

}

if ($is_username == 0 && $is_email == 0) {
    $sql = "INSERT INTO `tbl_admin` (`username`, `email`, `password`, `role`, `create_by`, `created_time`)
            VALUES('$username', '$email', '$password', 'admin', '$create_by', NOW());";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
} else if ($is_username != 0 && $is_email != 0) {
    echo "1";
} else if ($is_username != 0) {
    echo "2";
} else if ($is_email != 0) {
    echo "3";
}