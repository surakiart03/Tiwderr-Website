<?php
session_start();
ob_start();
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
    <title>เปลี่ยนรหัสผ่าน | TiWDERR</title>

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
                                <h2 class="mb-3 text-center">เปลี่ยนรหัสผ่าน</h2>
                                <!-- <h9> something.... </h9> -->
                                <div style="padding-top:30px" class="panel-body">
                                    <?php
                                    include('./connection/connect_db.php');
                                    $error = "";
                                    if (isset($_GET["reset_code"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
                                        $repass_code = $_GET["reset_code"];
                                        $email = $_GET["email"];
                                        $curDate = date("Y-m-d H:i:s");
                                        // $query = "SELECT * FROM tbl_user WHERE email like '$email' AND verification_code like '$v_code'";
                                        $query = "SELECT * FROM tbl_reset_password WHERE reset_code like '$repass_code' and email like '$email'";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) != 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            if ($row == "") {
                                                $error = "<script type='text/javascript'>
                                                            $(document).ready(function(){
                                                                Swal.fire({
                                                                    title: 'ลิงก์ของคุณหมดอายุแล้ว',
                                                                    text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                                                                    icon: 'error',
                                                                    timer: 5000,
                                                                    confirmButtonColor: '#3085d6',
                                                                    confirmButtonText: 'ตกลง',
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
                                                echo "<h5 class='mb-3 text-center'>ลิงก์ของคุณหมดอายุแล้ว</h5>
                                                        <h6 class='mb-3 lead text-center'>ขอบคุณที่ไว้วางใจกับทางเว็บไซต์ Tiwderr</h6>";
                                            } else {
                                                $expDate = $row['exp_date'];
                                                if ($expDate >= $curDate) {
                                    ?>
                                                    <form method="post" action="" name="update">
                                                        <input type="hidden" name="action" value="update" class="form-control form-control-sm text-dark" />
                                                        <div class="form-group">
                                                            <label class="text-primary">ระบุรหัสผ่านใหม่ของคุณ</label>
                                                            <input type="password" name="pass1" class="form-control form-control-sm text-dark" autofocus />
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="text-primary">ยืนยันรหัสผ่านใหม่ของคุณ</label>
                                                            <input type="password" name="pass2" class="form-control form-control-sm text-dark" />
                                                        </div>
                                                        <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                                        <div class="form-group">
                                                            <input type="submit" id="reset" value="ยืนยัน" class="btn btn-primary btn-sm w-100" />
                                                        </div>

                                                    </form>
                                    <?php
                                                } else {
                                                    $error = "<script type='text/javascript'>
                                                                $(document).ready(function(){
                                                                    Swal.fire({
                                                                        title: 'ลิงก์ของคุณหมดอายุแล้ว',
                                                                        text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                                                                        icon: 'error',
                                                                        timer: 5000,
                                                                        confirmButtonColor: '#3085d6',
                                                                        confirmButtonText: 'ตกลง',
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
                                                    echo "<h5 class='mb-3 text-center'>ลิงก์ของคุณหมดอายุแล้ว</h5>
                                                            <h6 class='mb-3 lead text-center'>ขอบคุณที่ไว้วางใจกับทางเว็บไซต์ Tiwderr</h6>";
                                                }
                                            }
                                        }
                                        if ($error != "") {
                                            echo $error;
                                        }
                                        ob_end_flush();
                                    }

                                    $error = "";
                                    if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"] == "update")) {
                                        $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
                                        $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
                                        if ($pass1 != '' && $pass2 != '') {
                                            $email = $_POST["email"];
                                            $curDate = date("Y-m-d H:i:s");
                                            if ($pass1 != $pass2) {
                                                $error = "<script type='text/javascript'>
                                                        $(document).ready(function(){
                                                            Swal.fire({
                                                                title: 'รหัสผ่านของคุณไม่ตรงกัน!',
                                                                text: 'โปรดตรวจสอบความถูกต้องอีกครั้ง',
                                                                icon: 'error',
                                                                confirmButtonColor: '#3085d6',
                                                                confirmButtonText: 'ตกลง'
                                                            })
                                                        });
                                                    </script>";
                                                echo "<h5 class='mb-3 text-center'>กำลังประมวลผล . . . .</h5>
                                                        <h6 class='mb-3 lead text-center'>ขอบคุณที่ไว้วางใจกับทางเว็บไซต์ Tiwderr</h6>";
                                            }
                                        } else {
                                            echo $error = "<script type='text/javascript'>
                                                    $(document).ready(function(){
                                                        Swal.fire({
                                                            title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                                                            text: 'โปรดตรวจสอบความถูกต้องอีกครั้ง',
                                                            icon: 'error',
                                                            timer: 2000,
                                                            confirmButtonColor: '#3085d6',
                                                            confirmButtonText: 'ตกลง',
                                                            timerProgressBar: true,
                                                        })
                                                    });
                                                </script>";
                                            echo "<h5 class='mb-3 text-center'>กำลังประมวลผล . . . .</h5>
                                                    <h6 class='mb-3 lead text-center'>ขอบคุณที่ไว้วางใจกับทางเว็บไซต์ Tiwderr</h6>";
                                        }
                                        if ($error != "") {
                                            echo $error;
                                            header("refresh: 2");
                                        } else {

                                            $pass1 = md5($pass1);
                                            $update = "UPDATE tbl_user SET user_password = '$pass1' WHERE email = '$email'";
                                            if (mysqli_query($conn, $update)) {
                                                $del = "DELETE FROM tbl_reset_password WHERE email = '$email'";
                                                mysqli_query($conn, $del);
                                            }
                                            echo "<script type='text/javascript'>
                                                    $(document).ready(function(){
                                                        Swal.fire({
                                                            title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                                            text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                                                            icon: 'success',
                                                            timer: 5000,
                                                            confirmButtonColor: '#3085d6',
                                                            confirmButtonText: 'ตกลง',
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
                                            echo "<h5 class='mb-3 text-center'>เปลี่ยนรหัสผ่านสำเร็จ!</h5>
                                                    <h6 class='mb-3 lead text-center'>ขอบคุณที่ไว้วางใจกับทางเว็บไซต์ Tiwderr</h6>";
                                        }
                                        ob_end_flush();
                                    }
                                    ?>
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