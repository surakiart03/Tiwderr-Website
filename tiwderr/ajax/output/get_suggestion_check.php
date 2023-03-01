<?php
session_start();

include "../../connection/connect_db.php";
$username = (isset($_SESSION['username']) ? $_SESSION['username'] : "");

$sql_attention = "SELECT `username` FROM `tbl_attention` WHERE `username` = '$username';";
$result_attention = mysqli_query($conn, $sql_attention);

if (mysqli_num_rows($result_attention) == 0) {
    $suggest = 0;
} else {
    $suggest = 1;
}
// print_r($sql_attention);
echo $suggest;