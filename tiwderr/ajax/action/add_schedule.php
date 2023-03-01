<?php
require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$day = $_POST['day'];
$detail = $_POST['detail'];

$sql_check = "SELECT `username`, `day` 
                FROM `tbl_tutor_schedule` 
                WHERE `username` = '$username' AND `day` = '$day';";
$result_check = mysqli_num_rows(mysqli_query($conn, $sql_check));

if ($result_check > 0) {
    echo "data exist";
} else {
    $sql = "INSERT INTO `tbl_tutor_schedule`(`username`, `day`, `detail`)
        VALUES(?, ?, ?);";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $day, $detail);

    $result = $stmt->execute();


    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }

    $stmt->close();
}
