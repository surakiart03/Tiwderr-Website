<?php
require_once("../../connection/connect_db.php");

$post_id    = $_POST['post_id'];
$cf_subject = $_POST['cf_subject'];
$rm_subject = $_POST['rm_subject'];
$cf_level   = $_POST['cf_level'];
$rm_level   = $_POST['rm_level'];
$cf_purpose = $_POST['cf_purpose'];
$rm_purpose = $_POST['rm_purpose'];
$cf_price   = $_POST['cf_price'];
$rm_price   = $_POST['rm_price'];
$cf_channel = $_POST['cf_channel'];
$rm_channel = $_POST['rm_channel'];
$cf_group_type   = $_POST['cf_gtype'];
$rm_group_type  = $_POST['rm_gtype'];
$cf_day     = $_POST['cf_day'];
$rm_day     = $_POST['rm_day'];
$cf_time    = $_POST['cf_time'];
$rm_time    = $_POST['rm_time'];
$offer_descrip    = $_POST['descrip'];
$create_by  = $_POST['create_by'];

$sql = "INSERT INTO `tbl_offer`(`post_id`, `cf_subject`, `rm_subject`, `cf_level`, `rm_level`, `cf_purpose`, `rm_purpose`, `cf_price`, `rm_price`, `cf_channel`, `rm_channel`, `cf_group_type`, `rm_group_type`, `cf_day`, `rm_day`, `cf_time`, `rm_time`, `offer_descrip`, `create_by`, `created_time`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());";

$stmt = $conn->prepare($sql);
$stmt->bind_param('dssssssssssssssssss', $post_id, $cf_subject, $rm_subject, $cf_level, $rm_level, $cf_purpose, $rm_purpose, $cf_price, $rm_price, $cf_channel, $rm_channel, $cf_group_type, $rm_group_type, $cf_day, $rm_day, $cf_time, $rm_time, $offer_descrip, $create_by);

$result = $stmt->execute();

if ($result) {
    echo "Insert into tbl_offer success ^-^\n" . $sql;
} else {
    echo "Insert into tbl_offer failed T-T\n"  . $sql;
}


$stmt->close();
