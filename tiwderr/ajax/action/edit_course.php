<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$id = $_POST['id'];
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
$cover_old = $_POST['cover_old'];
$cover = $_POST['cover_new'];

if ($cover == "") {
    $cover = $cover_old;
} else {
    if ($cover_old != "tiwderr1.jpg") {
        if (is_file('../../assets/images/cover_course/' . $cover_old)) {
            unlink('../../assets/images/cover_course/' . $cover_old);
        }
    }
    
    $filePath = "../../temp/images/" . $cover;
    $destinationFilePath = "../../assets/images/cover_course/" . $cover;
    if (!rename($filePath, $destinationFilePath)) {
        echo "File can't be moved!";
    } else {
        echo "File has been moved!";
    }
}

$sql = "UPDATE `tbl_course`
        SET `title` = ?
            , `intro` = ?
            , `subject` = ?
            , `level` = ?
            , `purpose` = ?
            , `price` = ?
            , `channel` = ?
            , `group_type` = ?
            , `day` = ?
            , `time` = ?
            , `course_descrip` = ?
            , `cover` = ?
            , `create_by` = ?
            , `last_update` = NOW()
        WHERE `id` = $id ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssdsssssss', $title, $intro, $subject, $level, $purpose, $price, $channel, $gtype, $day, $time, $descrip, $cover, $username);

$result = $stmt->execute();

if ($result) {
    echo "Update tbl_course success ^-^\n"  . $sql;
} else {
    echo "Update tbl_course failed T-T\n"  . $sql;
}

$stmt->close();
