<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_SESSION['username'];
$title = $_POST['title'];
$subject = $_POST['subject'];
$level = $_POST['level'];
$purpose = $_POST['purpose'];
$price = $_POST['price'];
$channel = $_POST['channel'];
$gtype = $_POST['gtype'];
$day = implode(",", json_decode($_POST['day']));
//$day = "...";
$time = $_POST['time'];
$descrip = $_POST['descrip'];

$sql = "INSERT INTO `tbl_post`(`title`, `subject`, `level`, `purpose`, `price`, `channel`, `group_type`, `day`, `time`, `post_descrip`, `create_by`, `created_time`, `last_update`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NULL);";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssissssss', $title, $subject, $level, $purpose, $price, $channel, $gtype, $day, $time, $descrip, $username);

$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_post success ^-^" . $sql;
} else {
    echo "Insert into tbl_post failed T-T" . $sql;
}

$stmt->close();
