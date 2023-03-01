<?php
require_once("../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "DELETE FROM `tbl_post` 
        WHERE `id` = '$id';";
$result = mysqli_query($conn, $sql);

$sql_offer = "DELETE FROM `tbl_offer`
                WHERE `post_id` = '$id';";
$result_offer = mysqli_query($conn, $sql_offer);

$sql_offer_reply = "DELETE FROM `tbl_offer_reply`
                WHERE `post_id` = '$id';";
$result_offer_reply = mysqli_query($conn, $sql_offer_reply);

if ($result && $result_offer && $result_offer_reply) {
    echo "Delete row in tbl_post with related tbl_offer and tbl_offer_reply success ^-^";
} else {
    echo "Delete row in tbl_post with related tbl_offer and tbl_offer_reply failed T^T";
}
