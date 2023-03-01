<?php
session_start();
require_once("../../../connection/connect_db.php");

$username   = $_POST['username'];
$email = $_POST['email'];
$id_card = $_POST['id_card'];
$coppied_id = $_POST['coppied_id'];
$status = $_POST['status'];
$remark = $status .  ($_POST['remark'] ? "-" . $_POST['remark'] : "");
$action_by  = $_POST['action_by'];

$sql = "INSERT INTO `tbl_admin_log`(`action`, `username`, `remark`, `action_by`, `action_time`)
VALUES ('approve', '$username', '$remark', '$action_by', NOW())";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo 'Update tbl_admin_log success ^-^\n';
} else {
    echo 'Update tbl_admin_log failed T-T\n';
}

if ($status == "P") {
    $sql = "UPDATE `tbl_user`
            SET `is_approved` = 1
                , `approved_time` = NOW()
            WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    echo "Update approve OK\n";
} else {
    $sql = "UPDATE `tbl_user_info`
    SET `id_card` = NULL
        , `coppied_id` = NULL
    WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE `tbl_user`
    SET `is_approved` = 0
        , `approved_time` = NULL
    WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($coppied_id != "") {
        if (is_file('../../../uploads/user_coppied_id/' . $coppied_id)) {
            unlink('../../../uploads/user_coppied_id/' . $coppied_id);
        }
    }
    echo "Reset ID card OK\n";
}

include ("../mail/mail_approve.php");