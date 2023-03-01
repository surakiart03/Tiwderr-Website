<?php

require_once("../../connection/connect_db.php");

$course_id = $_POST['course_id'];
$username   = $_POST['username'];

$sql = "INSERT INTO `tbl_like_course`(`username`, `course_id`, `created_time`)
        VALUES (?,?,NOW());";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sd', $username, $course_id);


$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_like_course success ^-^\n"  . $sql;
} else {
    echo "Insert into tbl_like_course failed T-T\n"  . $sql;
}

$stmt->close();
