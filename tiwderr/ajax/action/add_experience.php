<?php
require_once("../../connection/connect_db.php");

$experience = $_POST['experience'];
$username = $_POST['username'];

$sql_check = "SELECT * FROM `tbl_tutor_experience` 
                WHERE `username` = '$username';";
$result_check = mysqli_num_rows(mysqli_query($conn, $sql_check));

if ($result_check > 0) {
    $sql = "UPDATE `tbl_tutor_experience`
            SET `experience` = ? , `last_update` = NOW()
            WHERE `username` = '$username'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $experience);

    $result = $stmt->execute();

    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }

    $stmt->close();
} else {
    $sql = "INSERT INTO `tbl_tutor_experience`(`experience`, `username`, `last_update`)
        VALUES(?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $experience, $username);

    $result = $stmt->execute();

    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }

    $stmt->close();
}
