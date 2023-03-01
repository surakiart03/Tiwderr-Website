<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
    <title>ลืมรหัสผ่าน | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/tab-card.css">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<?php
if (isset($_SESSION['username'])) {
    header("Location: profile.php");
}
include "layout/header_nobanner.php"
?>


<body class="bg-gradient-white">

    <div class="container">
        <section class="vh-50">
            <div class="container py-5 h-50">
                <div class="row d-flex justify-content-center align-items-center h-50">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-">
                                <h2 class="mb-3 text-center">ลืมรหัสผ่าน ?</h2>
                                <p class="text-center">ระบุอีเมลของคุณที่ผูกกับบัญชี TiWDERR<br>เราจะส่งลิงก์สำหรับเปลี่ยนรหัสผ่านไปยังอีเมลของคุณ</p>

                                <div style="padding-top:30px" class="panel-body">

                                    <?php
                                    include('./connection/connect_db.php');

                                    if (isset($_POST['email']) && (!empty($_POST['email']))) {
                                        $email = $_POST['email'];
                                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);


                                        if (isset($_POST['email'])) {
                                            $email = $_POST['email'];
                                            $sql = "SELECT * FROM tbl_user WHERE email = '$email' ";
                                            $results = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($results) > 0) {
                                                // echo 'taken';
                                                $error = "";
                                            } else {
                                                // echo 'not_taken';

                                                $error = "<script type='text/javascript'>
                                                            $(document).ready(function(){
                                                                Swal.fire({
                                                                    title: 'ไม่พบบัญชี TiWDERR ที่ใช้อีเมลนี้',
                                                                    text: 'โปรดตรวจสอบความถูกต้องอีกครั้ง',
                                                                    icon: 'error',
                                                                    confirmButtonColor: '#3085d6',
                                                                    confirmButtonText: 'ตกลง',
                                                                })
                                                            });
                                                        </script>";
                                            }
                                            // exit();
                                        }

                                        if ($error != '') {
                                            echo $error;
                                        } else {

                                            $output = '';

                                            $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                                            $expDate = date("Y-m-d H:i:s", $expFormat);
                                            $repass_code = md5(time());
                                            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                                            $repass_code = $repass_code . $addKey;
                                            // Insert Temp Table
                                            mysqli_query($conn, "INSERT INTO tbl_reset_password (email, reset_code, exp_date) VALUES ('$email', '$repass_code', '$expDate')");


                                            // $output = '<p>โปรดคลิกที่ลิงก์ด้านล่าง เพื่อไปสู่หน้าเปลี่ยนรหัสผ่าน</p>';
                                            //replace the site url

                                            $html = '
                                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                                                <head>
                                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                                                <meta name="x-apple-disable-message-reformatting" />
                                                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                                                <title></title>
                                                <style type="text/css">
                                                    @media only screen and (min-width: 670px) {
                                                    .u-row {
                                                        width: 650px !important;
                                                    }
                                                    .u-row .u-col {
                                                        vertical-align: top;
                                                    }
                                                    .u-row .u-col-100 {
                                                        width: 650px !important;
                                                    }
                                                    }
                                                    @media (max-width: 670px) {
                                                    .u-row-container {
                                                        max-width: 100% !important;
                                                        padding-left: 0px !important;
                                                        padding-right: 0px !important;
                                                    }
                                                    .u-row .u-col {
                                                        min-width: 320px !important;
                                                        max-width: 100% !important;
                                                        display: block !important;
                                                    }
                                                    .u-row {
                                                        width: 100% !important;
                                                    }
                                                    .u-col {
                                                        width: 100% !important;
                                                    }
                                                    .u-col>div {
                                                        margin: 0 auto;
                                                    }
                                                    }
                                                    body {
                                                    margin: 0;
                                                    padding: 0;
                                                    font-family: "Kanit", sans-serif;
                                                    }
                                                    table,
                                                    tr,
                                                    td {
                                                    vertical-align: top;
                                                    border-collapse: collapse;
                                                    }
                                                    p {
                                                    margin: 0;
                                                    }
                                                    .ie-container table,
                                                    .mso-container table {
                                                    table-layout: fixed;
                                                    }
                                                    * {
                                                    line-height: inherit;
                                                    }
                                                    a[x-apple-data-detectors="true"] {
                                                    color: inherit !important;
                                                    text-decoration: none !important;
                                                    }
                                                    table,
                                                    td {
                                                    color: #000000;
                                                    }
                                                    #u_body a {
                                                    color: #0000ee;
                                                    text-decoration: underline;
                                                    }
                                                    .et_st {
                                                    box-sizing: border-box;
                                                    display: inline-block;
                                                    font-family: Kanit;
                                                    text-decoration: none;
                                                    -webkit-text-size-adjust: none;
                                                    text-align: center;
                                                    color: #ffffff;
                                                    background-color: #2edf7b;
                                                    border-radius: 60px;
                                                    -webkit-border-radius: 60px;
                                                    -moz-border-radius: 60px;
                                                    width: auto;
                                                    max-width: 100%;
                                                    overflow-wrap: break-word;
                                                    word-break: break-word;
                                                    word-wrap: break-word;
                                                    mso-border-alt: none;
                                                    border-top-color: #ccc;
                                                    border-top-style: solid;
                                                    border-top-width: 0px;
                                                    border-left-color: #ccc;
                                                    border-left-style: solid;
                                                    border-left-width: 0px;
                                                    border-right-color: #ccc;
                                                    border-right-style: solid;
                                                    border-right-width: 0px;
                                                    border-bottom-color: #0275a4;
                                                    border-bottom-style: solid;
                                                    border-bottom-width: 5px;
                                                    font-size: 14px;
                                                    }
                                                </style>
                                                    <!-- Font style -->
                                                <link rel="preconnect" href="https://fonts.googleapis.com">
                                                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                                <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

                                                </head>
                                                <body class="clean-body u_body" style="
                                                    margin: 0;
                                                    padding: 0;
                                                    -webkit-text-size-adjust: 100%;
                                                    background-color: #ffffff;
                                                    color: #000000;
                                                    ">
                                                <table id="u_body" style="
                                                        border-collapse: collapse;
                                                        table-layout: fixed;
                                                        border-spacing: 0;
                                                        mso-table-lspace: 0pt;
                                                        mso-table-rspace: 0pt;
                                                        vertical-align: top;
                                                        min-width: 320px;
                                                        margin: 0 auto;
                                                        background-color: #ffffff;
                                                        width: 100%;
                                                    " cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="
                                                            word-break: break-word;
                                                            border-collapse: collapse !important;
                                                            vertical-align: top;
                                                            ">
                                                        <div class="u-row-container" style="padding: 0px; background-color: transparent">
                                                            <div class="u-row" style="
                                                                margin: 0 auto;
                                                                min-width: 320px;
                                                                max-width: 650px;
                                                                overflow-wrap: break-word;
                                                                word-wrap: break-word;
                                                                word-break: break-word;
                                                                background-color: #e6ffff;
                                                                ">
                                                            <div style="
                                                                    border-collapse: collapse;
                                                                    display: table;
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    background-color: transparent;
                                                                ">
                                                                <div class="u-col u-col-100" style="
                                                                    max-width: 320px;
                                                                    min-width: 650px;
                                                                    display: table-cell;
                                                                    vertical-align: top;
                                                                    ">
                                                                <div style="height: 100%; width: 100% !important">
                                                                    <div style="
                                                                        box-sizing: border-box;
                                                                        height: 100%;
                                                                        padding: 0px;
                                                                        border-top: 0px solid transparent;
                                                                        border-left: 0px solid transparent;
                                                                        border-right: 0px solid transparent;
                                                                        border-bottom: 0px solid transparent;
                                                                        ">
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 0px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tr>
                                                                                <td style="
                                                                                        padding-right: 0px;
                                                                                        padding-left: 0px;
                                                                                    " align="center">
                                                                                    <img align="center" border="0" src="https://digiproj.sut.ac.th/prj65_02/tiwderr/src/images/email_reset.png" alt="Image" title="Image" style="
                                                                                        outline: none;
                                                                                        text-decoration: none;
                                                                                        -ms-interpolation-mode: bicubic;
                                                                                        clear: both;
                                                                                        display: inline-block !important;
                                                                                        border: none;
                                                                                        height: 50%;
                                                                                        float: none;
                                                                                        width: 50%;
                                                                                        max-width: 650px;
                                                                                        " width="650" />
                                                                                </td>
                                                                                </tr>
                                                                            </table>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="u-row-container" style="padding: 0px; background-color: transparent">
                                                            <div class="u-row" style="
                                                                margin: 0 auto;
                                                                min-width: 320px;
                                                                max-width: 650px;
                                                                overflow-wrap: break-word;
                                                                word-wrap: break-word;
                                                                word-break: break-word;
                                                                background-color: #e6ffff;
                                                                ">
                                                            <div style="
                                                                    border-collapse: collapse;
                                                                    display: table;
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    background-color: transparent;
                                                                ">
                                                                <div class="u-col u-col-100" style="
                                                                    max-width: 320px;
                                                                    min-width: 650px;
                                                                    display: table-cell;
                                                                    vertical-align: top;
                                                                    ">
                                                                <div style="height: 100%; width: 100% !important">
                                                                    <div style="
                                                                        box-sizing: border-box;
                                                                        height: 100%;
                                                                        padding: 0px;
                                                                        border-top: 0px solid transparent;
                                                                        border-left: 0px solid transparent;
                                                                        border-right: 0px solid transparent;
                                                                        border-bottom: 0px solid transparent;
                                                                        ">
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 0px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div style="
                                                                                    color: #018eea;
                                                                                    line-height: 170%;
                                                                                    text-align: left;
                                                                                    word-wrap: break-word;
                                                                                ">
                                                                                <p style="
                                                                                    line-height: 170%;
                                                                                    text-align: center;
                                                                                    ">
                                                                                <span style="font-size: 30px; line-height: 51px"><strong>TiWDERR</strong></span>
                                                                                </p>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 10px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div style="
                                                                                    color: #1b262c;
                                                                                    line-height: 100%;
                                                                                    text-align: center;
                                                                                    word-wrap: break-word;
                                                                                ">
                                                                                <p style="font-size: 14px; line-height: 100%">
                                                                                <span style="font-size: 26px; line-height: 26px"><strong><span style="line-height: 26px">เปลี่ยนรหัสผ่านของคุณ</span></strong></span>
                                                                                </p>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 10px 50px 20px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div style="
                                                                                    color: #1b262c;
                                                                                    line-height: 140%;
                                                                                    text-align: center;
                                                                                    word-wrap: break-word;
                                                                                ">
                                                                                <p style="
                                                                                    font-size: 14px;
                                                                                    line-height: 140%;
                                                                                    text-align: left;
                                                                                    ">
                                                                                <span style="
                                                                                        font-size: 16px;
                                                                                        line-height: 22.4px;
                                                                                    ">ขอบคุณที่ไว้วางใจกับทางเว็บไซต์
                                                                                    TiWDERR</span>
                                                                                </p>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 10px 50px 20px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div style="
                                                                                    color: #1b262c;
                                                                                    line-height: 140%;
                                                                                    text-align: center;
                                                                                    word-wrap: break-word;
                                                                                ">
                                                                                <p style="
                                                                                    line-height: 140%;
                                                                                    text-align: justify;
                                                                                    ">
                                                                                <span style="
                                                                                        font-size: 16px;
                                                                                        line-height: 22.4px;
                                                                                    ">กรุณายืนยันตัวตนของคุณโดยทำการคลิกที่ปุ่มด้านล่างเพื่อยืนยันให้แน่ใจว่าคุณเป็นเจ้าของอีเมลนี้สำหรับใช้ในการเปลี่ยนรหัสผ่านเข้าเว็บไซต์
                                                                                    TiWDERR</span>
                                                                                </p>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 10px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div align="center">
                                                                                <a href="https://digiproj.sut.ac.th/prj65_02/tiwderr/reset_password.php?reset_code=' . $repass_code . '&email=' . $email . '&action=reset" target="_blank" class="v-button et_st">
                                                                                <span style="
                                                                                        display: block;
                                                                                        padding: 15px 40px 14px;
                                                                                        line-height: 120%;
                                                                                    "><strong><span style="line-height: 16.8px">คลิกเพื่อเปลี่ยนรหัสผ่าน</span></strong></span>
                                                                                </a>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="font-family: Kanit" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="
                                                                                overflow-wrap: break-word;
                                                                                word-break: break-word;
                                                                                padding: 18px 50px 50px;
                                                                                font-family: Kanit;
                                                                                " align="left">
                                                                            <div style="
                                                                                    color: #5f5f5f;
                                                                                    line-height: 140%;
                                                                                    text-align: center;
                                                                                    word-wrap: break-word;
                                                                                ">
                                                                                <p style="
                                                                                    font-size: 14px;
                                                                                    line-height: 140%;
                                                                                    text-align: center;
                                                                                    ">
                                                                                <span style="
                                                                                        font-size: 12px;
                                                                                        line-height: 16.8px;
                                                                                    ">เราจะไม่ส่งอีเมลที่ไม่เกี่ยวข้องหรือไม่จำเป็นไปยังอีเมลของคุณและจะไม่เปิดเผยข้อมูลของคุณสู่สารธารณะ</span>
                                                                                </p>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                </body>
                                                </html>
                                                ';
                                            $body = $html;
                                            $subject = "TiWDERR | เปลี่ยนรหัสผ่าน";

                                            $email_to = $email;
                                            echo 'ส่งอีเมลไปยัง ' . $email_to . ' แล้ว';


                                            //autoload the PHPMailer
                                            require("vendor/autoload.php");
                                            $mail = new PHPMailer();
                                            $mail->IsSMTP();
                                            $mail->Host = "smtp.gmail.com"; // Enter your host here
                                            $mail->SMTPAuth = true;
                                            $mail->Username = "tiwderrmail@gmail.com"; // Enter your email here
                                            $mail->Password = "azqasvdhvddnqknv"; //Enter your passwrod here
                                            $mail->Port = 587;
                                            $mail->IsHTML(true);
                                            $mail->From = "tiwderrmail@gmail.com";
                                            $mail->FromName = "TiWDERR | เปลี่ยนรหัสผ่าน";
                                            $mail->Subject = $subject;
                                            //$mail->AddEmbeddedImage('src/images/email_verify.png', 'email_verify');
                                            $mail->Body = $body;
                                            $mail->AddAddress($email_to);
                                            $mail->CharSet = "UTF-8";
                                            if (!$mail->Send()) {
                                                echo "Mailer Error: " . $mail->ErrorInfo;
                                            } else {
                                                echo "<script type='text/javascript'>
                                                        $(document).ready(function(){
                                                            Swal.fire({
                                                                title: 'ส่งลิงก์สำหรับเปลี่ยนรหัสผ่านแล้ว โปรดตรวจสอบอีเมลของคุณ',
                                                                text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                                                                icon: 'success',
                                                                timer: 5000,
                                                                confirmButtonColor: '#3085d6',
                                                                timerProgressBar: true,
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    window.location.href='login.php';
                                                                }
                                                            })
                                                        setTimeout(function() {
                                                            location.href = 'login.php'
                                                        }, 5000);
                                                        });
                                                    </script>";
                                                // header("refresh: 5");
                                                exit;
                                            }
                                        }
                                    }
                                    ?>

                                    <form method="post" action="" name="reset">
                                        <div class="form-group">
                                            <label class="text-primary">อีเมล</label>
                                            <input type="email" name="email" id="email" placeholder="" class="form-control form-control-sm text-dark" autofocus/>
                                        </div>

                                        <div class="form-group text-center">
                                            <input type="submit" id="reset" value="ส่งอีเมล" class="btn btn-primary btn-sm w-100" />
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="loginbox" style="margin-left:25%; margin-right:25%; " class="mainbox ">
            <div class="panel panel-info">

            </div>
        </div>
    </div>

    <?php include "layout/footer.php" ?>
    
</body>

</html>