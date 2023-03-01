<?php
require_once("../../connection/connect_db.php");

$id = $_POST['id'];
$status_val = $_POST['status_val'];
$sql = "UPDATE `tbl_post` 
        SET `post_status` = $status_val,
            `last_update` = Now()
        WHERE `id` = '$id';";
$result = mysqli_query($conn, $sql);

$sql_update = "SELECT `last_update` FROM `tbl_post` WHERE `id` = '$id';";
$result_update = mysqli_query($conn, $sql_update);
while ($row = mysqli_fetch_assoc($result_update)) {
    $date = $row['last_update'];
}
if ($result) {
    echo $date;
} else {
    echo "Update row in tbl_post failed T^T";
}
