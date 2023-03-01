<?php
require_once("../../connection/connect_db.php");

$post_id =     $_POST['post_id'];
$offer_id =    $_POST['offer_id'];
$message =     $_POST['message'];
$create_by =   $_POST['create_by'];

$sql = "INSERT INTO `tbl_offer_reply`(`post_id`, `offer_id`, `message`, `create_by`, `created_time`)
        VALUES(?, ?, ?, ?, NOW());";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ddss', $post_id, $offer_id, $message, $create_by);

$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_offer_reply success ^-^\n" . $sql;

} else {
    echo "Insert into tbl_offer_reply failed T-T\n"  . $sql;
}

$stmt->close();
