<?php
require_once("../../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "DELETE FROM `tbl_admin`
        WHERE `id` = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "success";

} else {
    echo "failed";
}
