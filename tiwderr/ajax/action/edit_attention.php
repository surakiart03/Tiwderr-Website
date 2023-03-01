<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_SESSION['username'];
$subject = $_POST['subject'];
$level = ($_POST['level'] ? $_POST['level'] : '');
$purpose = ($_POST['purpose'] ? $_POST['purpose'] : '');
$channel = $_POST['channel'];
$gtype = $_POST['gtype'];
$gender = $_POST['gender'];

$sql_check = "SELECT `username` FROM `tbl_attention` WHERE `username` = '$username';";
$result_check = mysqli_query($conn, $sql_check);

if (!array_filter($_POST)) {
    if (mysqli_num_rows($result_check) != 0) {
        $sql = "DELETE FROM `tbl_attention` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "success ^-^" . $sql;
        } else {
            echo "failed T-T" . $sql;
        }
    }
} else {
    if (mysqli_num_rows($result_check) != 0) {
        $sql = "UPDATE `tbl_attention`
            SET `subject` = '$subject'
                , `level` = '$level'
                , `purpose` = '$purpose'
                , `channel` = '$channel'
                , `group_type` = '$gtype'
                , `gender` = '$gender'
            WHERE `username` = '$username';";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO `tbl_attention`(`username`, `subject`, `level`, `purpose`, `channel`, `group_type`, `gender`)
        VALUES('$username', '$subject', '$level', '$purpose', '$channel', '$gtype', '$gender');";
        $result = mysqli_query($conn, $sql);
    }

    if ($result) {
        echo "success ^-^" . $sql;
    } else {
        echo "failed T-T" . $sql;
    }
}
