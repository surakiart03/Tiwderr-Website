<?php
require_once("../../connection/connect_db.php");


$username = $_POST['username'];
$type = $_POST['type'];
$contact = $_POST['contact'];

$sql = "INSERT INTO `tbl_tutor_contact`(`username`, `type`, `contact`)
        VALUES(?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $type, $contact);


$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_tutor_contact success ^-^\n"  . $sql;
} else {
    echo "Insert into tbl_tutor_contact failed T-T\n"  . $sql;
}

$stmt->close();