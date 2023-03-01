<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_SESSION['username'];
$title = $_POST['title'];
$intro = $_POST['intro'];
$subject = $_POST['subject'];
$level = $_POST['level'];
$purpose = $_POST['purpose'];
$price = $_POST['price'];
$channel = implode(",", json_decode($_POST['channel']));
$gtype = $_POST['gtype'];
$day = implode(",", json_decode($_POST['day']));
$time = implode(",", json_decode($_POST['time']));
$descrip = $_POST['descrip'];
$cover = $_POST['cover'];

print_r($_POST);
if ($cover == "") {
    $cover = "tiwderr1.jpg";
}
// $sql = "INSERT INTO `tbl_course`(`title`, `intro`, `subject`, `level`, `purpose`, `price`, `channel`, `group_type`, `day`, `time`, `course_descrip`, `cover`, `create_by`, `created_time`, `last_update`, `course_status`)
//         VALUES('$title', '$intro', '$subject', '$level', '$purpose', '$price', '$channel', '$gtype', '$day', '$time', '$descrip', '$cover', '$username', NOW(), NULL, 1);";
// $result = mysqli_query($conn, $sql);

$sql = "INSERT INTO `tbl_course`(`title`, `intro`, `subject`, `level`, `purpose`, `price`, `channel`, `group_type`, `day`, `time`, `course_descrip`, `cover`, `create_by`, `created_time`, `last_update`, `course_status`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NULL, 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssiidsssssss', $title, $intro, $subject, $level, $purpose, $price, $channel, $gtype, $day, $time, $descrip, $cover, $username);


$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_course success ^-^\n"  . $sql;
    if ($cover != "tiwderr1.jpg") {
        $filePath = "../../temp/images/" . $cover;
        $destinationFilePath = "../../assets/images/cover_course/" . $cover;
        if (!rename($filePath, $destinationFilePath)) {
            echo "File can't be moved!";
        } else {
            echo "File has been moved!";
        }
    }
} else {
    echo "Insert into tbl_course failed T-T\n"  . $sql;
}

$stmt->close();
