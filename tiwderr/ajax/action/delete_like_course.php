<?php
require_once("../../connection/connect_db.php");

$course_id = $_POST['course_id'];
$username = $_POST['username'];

$sql = "DELETE FROM `tbl_like_course` 
                WHERE `username` = '$username' AND `course_id` = $course_id;";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Delete row in tbl_like_course success ^-^";
} else {
    echo "Delete row in tbl_like_course failed T^T";
}
