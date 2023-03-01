<?php
require_once("../../connection/connect_db.php");
session_start();

$username  = $_POST['username'];
$name      = $_POST['name'];
$bio       = $_POST['bio'];
$gender    = $_POST['gender'];
$avatar    = $_POST['avatar'];
$avatar_old= $_POST['avatar_old'];
$cover     = $_POST['cover'];
$cover_old = $_POST['cover_old'];

if ($avatar == "") {
    $avatar = $avatar_old;
} else {
    if ($avatar_old != "default_pic.jpg") {
        if (is_file('../../assets/images/avatar/' . $avatar_old)) {
            unlink('../../assets/images/avatar/' . $avatar_old);
        }
    }
    
    $filePath = "../../temp/images/" . $avatar;
    $destinationFilePath = "../../assets/images/avatar/" . $avatar;
    if (!rename($filePath, $destinationFilePath)) {
        echo "File can't be moved!";
    } else {
        echo "File has been moved!";
    }
    $_SESSION['profile_pic'] = $avatar;
}

if ($cover == "") {
    $cover = $cover_old;
} else {
    if ($cover_old != "default_cover.jpg") {
        if (is_file('../../assets/images/cover_profile/' . $cover_old)) {
            unlink('../../assets/images/cover_profile/' . $cover_old);
        }
    }
    
    $filePath = "../../temp/images/" . $cover;
    $destinationFilePath = "../../assets/images/cover_profile/" . $cover;
    if (!rename($filePath, $destinationFilePath)) {
        echo "File can't be moved!";
    } else {
        echo "File has been moved!";
    }
}

$sql = "UPDATE `tbl_user_info`
        SET `profile_name` = ?
        , `profile_pic` = ?
        , `profile_cover` = ?
        , `gender` = ?
        , `bio` = ?
        WHERE `username` = '$username' ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $name, $avatar, $cover, $gender, $bio);

$result = $stmt->execute();

if ($result) {
    echo "Update tbl_user_info success ^-^\n";

} else {
    echo "Update tbl_user_info failed T-T\n";
}

$stmt->close();
