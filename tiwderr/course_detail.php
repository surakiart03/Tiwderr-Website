<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}

$course_id = $_GET['course'];
$tutor = $_GET['tutor'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
    <title>ค้นหาติวเตอร์ | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/tab-card.css">
    <link rel="stylesheet" href="./assets/css/dataTables.min.css">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Cropper CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
    <link rel="stylesheet" href="./assets/css/cropper.css">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-white">
    <?php
    include "layout/header_nobanner.php"
    ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <div class="container">
        <Section class="miri-ui-kit-section pb-0">
            <div class="container" id="forContent">

            </div>
        </Section>

    </div>

    <!-- Modal -->
    <div id="forModal" class="container"></div>
    <!-- End Modal -->

    <?php include "layout/footer.php" ?>

    <!-- Script -->
    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="src/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="src/js/miri-ui-kit.js"></script>
    <script src="assets/js/plugins/rSlider.min.js"></script>
    <script src="assets/js/floating-btn.js"></script>
    <script src="assets/js/summernote-lite.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/dataTables.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
    <script src="assets/js/logout.js"></script>
    <script>
        $(document).ready(function() {
            getNotify();
            showCourseDetail();
        });

        function showCourseDetail() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_course_detail.php",
                data: {
                    course_id: <?= $course_id ?>,
                    tutor: "<?= $tutor ?>",
                },
                success: function(response) {
                    $("#forContent").html(response);
                }
            });
        }
    </script>

</body>

</html>