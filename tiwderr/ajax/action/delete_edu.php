<?php
require_once("../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "DELETE FROM `tbl_tutor_edu` 
                WHERE `id` = '$id';";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Delete row in tbl_tutor_edu success ^-^";
} else {
    echo "Delete row in tbl_tutor_edu failed T^T";
}
