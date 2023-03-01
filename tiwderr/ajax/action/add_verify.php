<?php

require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$id_card = str_replace("-", "", $_POST['id_card']);

$file_name = $_FILES['coppied_id']['name'];
$fileExt = explode('.', $file_name);
$fileActExt = strtolower(end($fileExt));
$new_file_name = md5(rand(100, 200))  . "." .  $fileActExt; 

// print_r($_POST);
if (move_uploaded_file($_FILES['coppied_id']['tmp_name'], "../../uploads/user_coppied_id/" . $new_file_name)) {
    echo "ไปเบิ่งไฟล์จ้า";
$sql = "UPDATE `tbl_user_info`
        SET `id_card` = ?
            , `coppied_id` = ?
        WHERE `username` = '$username' ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $id_card, $new_file_name);

$result = $stmt->execute();

if ($result) {
    echo "Update tbl_user_info success ^-^\n"  . $sql;
} else {
    echo "Update tbl_user_info failed T-T\n"  . $sql;
}

$stmt->close();

} else {
    echo "เซฟไม่เข้าแมะสู";
}

