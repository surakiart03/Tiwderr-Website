<?php
session_start();
//print_r($_SESSION);
if (isset($_SESSION['username']) && $_SESSION['role'] != "admin") {
    header("Location: ../index.php");
} else if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/images/logo_icon.png" type="image/x-icon">

    <title>เข้าสู่ระบบ | TiWDERR Admin</title>


    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body class="bg-gradient-white">

    <div class="container">

        <div class="p-3 row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-">
                        <div class="d-flex flex-row justify-content-center">
                            <img src="../assets/images/logo_icon.png" alt="logo" width="200px">
                        </div>

                        <h2 class="mb-3 text-center">Management System</h2>

                        <div style="padding-top:30px" class="panel-body">

                            <form id="loginform" class="form-horizontal" method="post" role="form">
                                <div style="margin-bottom: 25px" class="col form-group">
                                    <span class="form-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <label class="text-primary">ชื่อบัญชี</label>
                                    <input id="username" type="text" class="form-control form-control-sm text-dark" name="username" value="" placeholder="" required autofocus>
                                </div>
                                <div style="margin-bottom: 25px" class="col form-group">
                                    <span class="form-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <label class="text-primary">รหัสผ่าน</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control form-control-sm text-dark" name="passWord" placeholder="" required>
                                        <button id="toggle-password" type="button" class="d-none" aria-label="Hide password."></button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary w-100" type="submit">เข้าสู่ระบบ</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <?php
    include("../layout/footer.php");
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

        });
        $("#loginform").submit(function(e) {
            e.preventDefault();
            loginFunc();
        })

        function loginFunc() {
            var empty_input = 0;
            var text_alert = "";

            if (!$('#username').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุชื่อบัญชี";
                $("#username").focus();
            } else if (!$('#password').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุรหัสผ่าน";
                $("#password").focus();
            } else {
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    url: "ajax/action/function_login.php",
                    type: "POST",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == "success") {
                            window.location = 'index.php';
                        } else if (response == "not found") {
                            Swal.fire({
                                title: 'อีเมลหรือรหัสผ่านผิด !',
                                text: 'โปรดตรวจสอบข้อมูลอีกครั้ง',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: "ตกลง",
                            });
                        } else {
                           
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