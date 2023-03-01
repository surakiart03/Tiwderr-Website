<?php
require_once("../../connection/connect_db.php");

$review_type = $_POST['review_type']; // course or student
$review_to = $_POST['review_to'];
$score = $_POST['score'];
$message = $_POST['message'];
$show_user = $_POST['show_user'];
$create_by = $_POST['create_by'];

print_r($_POST);
$tbl = "tbl_review_" . $review_type;

$sql = "INSERT INTO `$tbl`(`$review_type`, `score`, `message`, `show_user`, `create_by`, `created_time`)
        VALUES(?, ?, ?, ?, ?, NOW());";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sdsds', $review_to, $score, $message, $show_user, $create_by);

$result = $stmt->execute();


if ($result) {
    echo "Insert into $tbl success ^-^\n" . $sql;
} else {
    echo "Insert into $tbl failed T-T\n"  . $sql;
}

$stmt->close();