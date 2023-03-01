<?php
require_once("../../connection/connect_db.php");
include("MAILfunc.php");

$userName = $_POST["userName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$phone = str_replace("-", "", $phone);
$passWord = md5($_POST["passWord"]);
$role = $_POST["role"];
$profile_name = $_POST["profile_name"];

$v_code = bin2hex(random_bytes(16));

$path = "https://digiproj.sut.ac.th/prj65_02/tiwderr/index.php?";
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
                                      <img align="center" border="0" src="https://digiproj.sut.ac.th/prj65_02/tiwderr/src/images/email_verify.png" alt="Image" title="Image" style="                                          
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
                                  <span style="font-size: 26px; line-height: 26px"><strong><span style="line-height: 26px">ยืนยันตัวตนของคุณ</span></strong></span>
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
                                      ">ขอบคุณที่สมัครสมาชิกกับทางเว็บไซต์
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
                                      ">กรุณายืนยันตัวตนของคุณโดยทำการคลิกที่ปุ่มด้านล่างเพื่อยืนยันให้แน่ใจว่าคุณเป็นเจ้าของอีเมลนี้สำหรับใช้ในการเข้าสู่ระบบเว็บไซต์
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
                                <a href="' . $path .'email=' . $email . '&v_code=' . $v_code . '" target="_blank" class="v-button et_st">
                                  <span style="
                                        display: block;
                                        padding: 15px 40px 14px;
                                        line-height: 120%;
                                      "><strong><span style="line-height: 16.8px">คลิกเพื่อยืนยันตัวตน</span></strong></span>
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
                                      ">เราจะไม่ส่งอีเมลที่ไม่เกี่ยวข้องหรือไม่จำเป็นไปยังอีเมลของคุณและจะไม่เปิดเผยข้อมูลของคุณสู่สาธารณะ</span>
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

$from = "tiwderrmail@gmail.com";
$to = $email;
$subject = "TiWDERR | ยืนยันตัวตนบัญชีผู้ใช้";
$body = $html;


if ((isset($_POST["userName"])) && (isset($_POST["profile_name"])) && (isset($_POST["email"])) && (isset($_POST["phone"])) && (md5(isset($_POST["passWord"]))) && isset($_POST["role"])) {
  $sql = "INSERT INTO tbl_user (username, email, phone, user_password, role, verification_code, is_verified) VALUES('$userName', '$email', '$phone', '$passWord', '$role', '$v_code', 0);";
  if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn); // this will gives you last inserted id
    $sql1 = "INSERT INTO tbl_user_info (username, profile_name) VALUES ('$userName', '$profile_name');";  // change column name and values here;
    if (mysqli_query($conn, $sql1) && sendMail($from, $to, $subject, $body)) {
    }
  } else {
    echo "error";
  }
}
mysqli_close($conn);

// if (!empty($_FILES['profile_pic']['name'])) {

//     $profile_pic = $_FILES['profile_pic']['name'];

//     $fileExt = explode('.', $profile_pic);
//     $fileActExt = strtolower(end($fileExt));
//     $allowImg = array('png', 'jpeg', 'jpg' , 'pdf');
//     $fileNew = rand() . "." . $fileActExt;
//     $filePath = 'uploads/' . $fileNew;

//     if (in_array($fileActExt, $allowImg)) {
//         if ($_FILES['profile_pic']['size'] > 0  && $_FILES['profile_pic']['error'] == 0) {
//             $query = "INSERT INTO test_user (first_name, last_name, userName, profile_name, email, passWord, profile_pic, role) VALUES('$first_name','$last_name','$userName','$profile_name','$email','$passWord', '$fileNew', '$role')";
//             if (mysqli_query($conn, $query)) {
//                 move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath);
//             } else {
//                 echo json_encode(array('error' => '0', 'message' => 'อัพโหลดไม่สำเร็จ โปรดลองอีกครั้ง'));
//             }
//         } else {
//             echo json_encode(array('error' => '0', 'message' => 'Unable to upload physical profile_pic'));
//         }
//     } else {
//         echo json_encode(array('error' => '0', 'message' => 'Only PNG, JPEG, JPG image allow'));
//     }
// }
