<?php
require_once("../../connection/connect_db.php");


$username = $_POST['username'];
$title = $_POST['title'];
$org = $_POST['org'];
$detail = $_POST['detail'];

$sql = "INSERT INTO `tbl_tutor_award`(`username`, `title`, `org`, `detail`, `created_time`)
        VALUES(?, ?, ?, ? , NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $username, $title, $org, $detail);


$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_tutor_award success ^-^\n"  . $sql;
} else {
    echo "Insert into tbl_tutor_award failed T-T\n"  . $sql;
}

$stmt->close();