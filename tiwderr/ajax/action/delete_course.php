<?php
require_once("../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "DELETE FROM `tbl_course` 
        WHERE `id` = '$id';";
$result = mysqli_query($conn, $sql);

$sql_like_course = "DELETE FROM `tbl_like_course` 
        WHERE `course_id` = '$id';";
$result_like_course = mysqli_query($conn, $sql_like_course);

$sql_review = "DELETE FROM `tbl_review_course`
                WHERE `course` = '$id'";
$result_review = mysqli_query($conn, $sql_review);

if ($result && $result_like_course && $result_review) {
    echo "Delete row in tbl_course with related tbl_like_course and tbl_review_course success ^-^";
} else {
    echo "Delete row in tbl_course with related tbl_like_course and tbl_review_course failed T^T";
}
