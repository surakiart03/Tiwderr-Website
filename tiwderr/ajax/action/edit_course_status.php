<?php
require_once("../../connection/connect_db.php");

$id = $_POST['id'];
$status_val = $_POST['status_val'];

$sql = "UPDATE `tbl_course` 
        SET `course_status` = $status_val,
            `last_update` = NOW()
        WHERE `id` = '$id';";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Update row in tbl_course success ^-^";
} else {
    echo "Update row in tbl_course failed T^T";
}
