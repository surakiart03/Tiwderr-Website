<?php
session_start();
ini_set('display_errors', 0); // hide warning
require_once("../../../connection/connect_db.php");

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM `tbl_admin` WHERE `username` = '$username' AND `password` = '$password'";
$result = mysqli_query($conn, $sql);

// print_r($sql);
if (mysqli_num_rows($result) != 0) {

    while ($row_user = mysqli_fetch_assoc($result)) {
        $session_keys = array_keys($row_user);
        foreach ($session_keys as $keys) {
            $_SESSION[$keys] = $row_user[$keys];
        }
    }
    echo "success";

} else {
    echo "not found";
}
