<?php
session_start();
require_once("connection/connect_db.php");
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    header("Location: profile.php?username=" . ($_SESSION['username']));
}

$sql = "SELECT `role` FROM `tbl_user` 
            WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    foreach ($result as $row) {
        $role = $row['role'];
    }
}

if (!isset($_SESSION['username']) && $role =="student") {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
    <title><?= $username ?> | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/tab-card.css">
    <link rel="stylesheet" href="assets/css/dataTables.min.css">
    <link rel="stylesheet" href="./assets/css/nostra-map.css">
    <link rel="stylesheet" href="./assets/css/cropper.css">
    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- include cropper css/js -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
</head>

<body class="bg-gradient-white">
    <?php
    include "layout/header_nobanner.php"
    ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <Section class="miri-ui-kit-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div id="forProfileCard"></div>

                    <div id="forInfoCard"></div>

                    <div id="forContactCard"></div>

                    <div id="forScheduleCard"></div>
                </div>
                <div class="col-lg-8">
                    <div id="forAboutUser"></div>
                </div>
            </div>
        </div>
    </Section>
    <!-- Modal -->
    <div id="forModal"></div>
    <!-- End Modal -->

    <?php include "layout/footer.php" ?>

    <!-- Script -->
    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="src/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="src/js/miri-ui-kit.js"></script>
    <script src="assets/js/floating-btn.js"></script>
    <script src="assets/js/summernote-lite.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript" src="https://api.nostramap.com/nostraapi/v2.0?key=GbPW1G4Ccwo2UKIH19XLIlrztUKQgGRqL2QueshxP1tmES2aHUkqMx9zUpQbf14F)(6SZVz93VXUugIaUzw3Im0=====2"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
    <script src="assets/js/please-approve.js"></script>
    <script src="assets/js/logout.js"></script>
    <script>
        var role = "<?= $role ?>";
        var username = "<?= $username ?>";

        $(document).ready(function() {
            getNotify();
            showProfileCard();

            if (role === "tutor") {
                showInfoCard();
                showContactCard();
                showScheduleCard();
                showAboutUser();
            } else {
                showInfoCard();
                showAboutUser();
            }
        });

        function showProfileCard() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_profile_card.php",
                data: {
                    username: username,
                    role: role,
                },
                success: function(response) {
                    $("#forProfileCard").html(response);

                }
            });
        }

        function showInfoCard() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_profile_info.php",
                data: {
                    username: username,
                    role: role,
                },
                success: function(response) {
                    $("#forInfoCard").html(response);

                }
            });
        }

        function showContactCard() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_profile_contact.php",
                data: {
                    username: username,
                    role: role,
                },
                success: function(response) {
                    $("#forContactCard").html(response);

                }
            });
        }

        function showScheduleCard() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_profile_schedule.php",
                data: {
                    username: username,
                    role: role,
                },
                success: function(response) {
                    $("#forScheduleCard").html(response);
                }
            });
        }

        function showAboutUser() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_profile_" + role + ".php",
                data: {
                    username: username,
                    role: role,
                },
                success: function(response) {
                    $("#forAboutUser").html(response);

                }
            });
        }
    </script>

</body>

</html>