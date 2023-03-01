<?php
require_once("../../connection/connect_db.php");
session_start();

$username  = $_POST['username'];
$location       = $_POST['location'];
$t_lattitude    = $_POST['t_lattitude'];
$t_longitude    = $_POST['t_longitude'];

$sql_check = "SELECT * FROM `tbl_location`
                WHERE `username` = '$username'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) != 0) {
    $sql = "UPDATE `tbl_location`
        SET `location` = ?
        , `t_lattitude` = ?
        , `t_longitude` = ?
        WHERE `username` = '$username' ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdd', $location, $t_lattitude, $t_longitude);

    $result = $stmt->execute();

    if ($result) {
        echo "Update tbl_location success ^-^\n";
    } else {
        echo "Update tbl_location failed T-T\n";
    }

    $stmt->close();
} else {
    $sql = "INSERT INTO `tbl_location` (`username`, `location`, `t_lattitude`, `t_longitude`)
            VALUES (?, ?, ?, ?);";
        
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdd', $username, $location, $t_lattitude, $t_longitude);

    $result = $stmt->execute();

    if ($result) {
        echo "Insert into tbl_location success ^-^\n";
    } else {
        echo "Insert into tbl_location failed T-T\n";
    }

    $stmt->close();
}
