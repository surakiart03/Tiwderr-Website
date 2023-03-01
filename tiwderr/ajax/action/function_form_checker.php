<?php

require_once("../../connection/connect_db.php");

if (isset($_POST['userName_check'])) {
    $userName = $_POST['userName'];
    $sql = "SELECT * FROM tbl_user WHERE username = '$userName' ";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo 'taken';
    } else {
        echo 'not_taken';
    }
    exit();
}

if (isset($_POST['email_check'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM tbl_user WHERE email = '$email' ";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo 'taken';
    } else {
        echo 'not_taken';
    }
    exit();
}

if (isset($_POST['phone_check'])) {
    $phone = $_POST['user_phone'];
    $sql = "SELECT * FROM tbl_user WHERE phone = '$phone' ";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo 'taken';
    } else {
        echo 'not_taken';
    }
    exit();
}
