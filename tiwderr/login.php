<?php
session_start();
// print_r($_SESSION);
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
    <title>เข้าสู่ระบบ | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/tab-card.css">
    <link rel="stylesheet" href="./assets/css/show-password-toggle.css">
    <link rel="stylesheet" href="./assets/css/show-password-toggle.css.map">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-dark">
    <?php
    // include_once "./ajax/action/function_login.php";

    if (isset($_SESSION['username'])) {
        header("Location: profile.php?username=" . ($_SESSION['username']));
    }
    include "layout/header_nobanner.php";
    ?>
    <div class="container">
        <section class="">
            <div class="container pt-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-">
                                <h2 class="mb-3 text-center">เข้าสู่ระบบ</h2>
                                <div class="panel-heading">
                                    <!-- <h2 class="text-center">เข้าสู่ระบบ</h2> -->
                                    <div style="float:right; position: relative; top:-10px"><a href="forget_password.php">ลืมรหัสผ่าน?</a></div>
                                </div>
                                <div style="padding-top:30px" class="panel-body">
                                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                    <form id="loginform" class="form-horizontal" method="post" role="form">
                                        <div style="margin-bottom: 25px" class="col form-group">
                                            <span class="form-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <label class="text-primary">อีเมล</label>
                                            <input id="email" type="text" class="form-control form-control-sm text-dark" name="email" value="" placeholder="อีเมล" required>
                                        </div>
                                        <div style="margin-bottom: 25px" class="col form-group">
                                            <span class="form-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <label class="text-primary">รหัสผ่าน</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control form-control-sm text-dark" name="passWord" placeholder="ระบุรหัสผ่าน" required>
                                                <button id="toggle-password" type="button" class="d-none" aria-label="Hide password."></button>
                                            </div>
                                        </div>

                                        <div class="form-group px-3">
                                            <button class="btn btn-sm btn-primary w-100" type="submit" >เข้าสู่ระบบ</button>

                                        </div>
                                        <div class="form-group text-center ">
                                            <span class="">ยังไม่มีบัญชีผู้ใช้งาน?</span>
                                            <a href="main_register.php" class="text-primary">สมัครสมาชิก</a>
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
    <script src="./assets/js/show-password-toggle.min.js" async></script>
    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        });
        $("#loginform").submit(function(e) {
            e.preventDefault();
            loginFunc();
        })
        function loginFunc() {
            var empty_input = 0;
            var text_alert = "";

            if (!$('#email').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุอีเมล";
                $("#email").focus();
            } else if (!$('#password').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุรหัสผ่าน";
                $("#password").focus();
            } else {
                var email = $("#email").val();
                var password = $("#password").val();

                $.ajax({
                    url: "ajax/action/function_login2.php",
                    method: "POST",
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == "success") {
                            window.location='index.php';
                        } else if (response == "not found") {
                            Swal.fire({
                                title: 'อีเมลหรือรหัสผ่านผิด !',
                                text: 'โปรดตรวจสอบข้อมูลอีกครั้ง',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: "ตกลง",
                            });
                        } else {
                            Swal.fire({
                                title: 'ไม่สามารถเข้าสู่ระบบได้!',
                                text: 'บัญชีผู้ใช้นี้ยังไม่ได้ยืนยันอีเมล โปรดตรวจสอบข้อความจากเราในอีเมลของคุณเพื่อทำการยืนยัน',
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: "ตกลง",
                            });
                        }
                    }
                });
            }

            if (empty_input != 0) {
                console.log('check submit');
                Swal.fire({
                    title: 'กรอกข้อมูลไม่ครบถ้วน !',
                    text: text_alert,
                    icon: 'error',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง'
                })
            }
        }
    </script>
</body>

</html>