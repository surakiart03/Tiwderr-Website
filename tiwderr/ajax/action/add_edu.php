<?php
require_once("../../connection/connect_db.php");


$username   = $_POST['username'];
$level  = $_POST['level'];
$institute  = $_POST['institute'];
$facmaj = $_POST['facmaj'];
$diploma    = $_POST['diploma'];
$gpax   = $_POST['gpax'];
$year   = $_POST['year'];
$state  = $_POST['state'];

$sql = "INSERT INTO `tbl_tutor_edu`(`username`, `level`, `edu_stat`, `institute`, `fac_maj`, `diploma`, `period_year`, `gpax`)
        VALUES (?,?,?,?,?,?,?,?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssssd', $username, $level, $state, $institute, $facmaj, $diploma, $year, $gpax);


$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_tutor_edu success ^-^\n"  . $sql;
} else {
    echo "Insert into tbl_tutor_edu failed T-T\n"  . $sql;
}

$stmt->close();