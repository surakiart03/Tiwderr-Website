<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}

$username = "";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $username = $_SESSION['username'];
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
                                    <form>
                                        <div class="form-group">
                                            <label class="text-primary">รหัสผ่านเก่า</label>
                                            <input type="password" name="" id="pw_old" class="form-control form-control-sm text-dark" autofocus />
                                        </div>

                                        <div class="form-group">
                                            <label class="text-primary">รหัสผ่านใหม่</label>
                                            <input type="password" name="" id="pw_new" class="form-control form-control-sm text-dark" maxlength="16" minlength="8"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-primary">ยืนยันรหัสผ่านใหม่</label>
                                            <input type="password" name="" id="cf_pw_new" class="form-control form-control-sm text-dark" maxlength="16" minlength="8" />
                                        </div>
                                        <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                        <div class="form-group">
                                            <button type="button" value="ยืนยัน" class="btn btn-primary btn-sm w-100" onclick="changePassword();">ยืนยัน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include "layout/footer.php" ?>

    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="src/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="src/js/miri-ui-kit.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/logout.js"></script>
    <script type="text/javascript">
        var username = "<?= $username ?>";

        $(document).ready(function() {

        });

        function changePassword() {
            var empty_input = 0;
            var text_title = "กรอกข้อมูลไม่ครบถ้วน !";
            var text_alert = "";

            if (!$('#pw_old').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุรหัสผ่านเก่า";
                $("#pw_old").focus();
            } else if (!$('#pw_new').val()) {
                empty_input += 1;
                text_alert = "กรุณาระบุรหัสผ่านใหม่";
                $("#pw_new").focus();
            } else if ($('#pw_new').val().length < 8 || $('#pw_new').val().length > 16) {
                empty_input += 1;
                text_title = "กรอกข้อมูลไม่ถูกต้อง !";
                text_alert = "รหัสผ่านควรมีความยาวตั้งแต่ 8 ถึง 16 ตัว ";
                $("#pw_new").focus();
            } else if (!$('#cf_pw_new').val()) {
                empty_input += 1;
                text_alert = "กรุณายืนยันรหัสผ่านใหม่";
                $("#cf_pw_new").focus();
            } else if ($('#pw_new').val() != $('#cf_pw_new').val()) {
                empty_input += 1;
                text_title = "ยืนยันรหัสผ่านใหม่ไม่ตรงกัน !";
                text_alert = "กรุณากรอกข้อมูลใหม่อีกครั้ง";
                $("#cf_pw_new").focus();
            } else {
                var pw_old = $("#pw_old").val();
                var pw_new = $("#pw_new").val();
                var cf_pw_new = $("#cf_pw_new").val();

                Swal.fire({
                    title: 'คุณต้องการเปลี่ยนรหัสผ่าน ?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/action/function_edit_password.php",
                            data: {
                                username: username,
                                password_old: pw_old,
                                password_new: pw_new
                            },
                            success: function(response) {
                                console.log('res: ' + response);
                                if (response == "failed") {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'รหัสผ่านเก่าไม่ถูกต้อง',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else if (response == "pass") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'เปลี่ยนรหัสผ่านของคุณแล้ว',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = "profile.php?username=" + username;
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'มีบางอย่างผิดพลาด',
                                        text: 'ไม่สามารถเปลี่ยนรหัสผ่านได้',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(error) {
                                console.log('AJAX Error: ' + error);
                            }
                        });
                    }
                })
            }

            if (empty_input != 0) {
                console.log('check submit');
                Swal.fire({
                    title: text_title,
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