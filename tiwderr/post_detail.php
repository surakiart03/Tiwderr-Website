<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
$post_id = $_GET['post'];
$student = $_GET['student'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
    <title>ประกาศหาติวเตอร์ | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/tab-card.css">
    <link rel="stylesheet" href="./assets/css/dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"> -->

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-white">
    <?php
    include "layout/header_nobanner.php"
    ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <!-- <div class="container">
        <Section class="miri-ui-kit-section pb-0">
            <div class="container" id="forContent">

            </div>
        </Section>

    </div> -->
    <Section class="miri-ui-kit-section pb-0">
        <div class="container" id="forContent1">

        </div>
    </Section>
    <Section class="miri-ui-kit-section pb-0">
        <div class="container" id="forContent2">

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
    <script src="assets/js/plugins/rSlider.min.js"></script>
    <script src="assets/js/floating-btn.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="assets/js/summernote-lite.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/dataTables.min.js"></script>
    <script src="assets/js/please-approve.js"></script>
    <script src="assets/js/logout.js"></script>
    <script>
        var myfile = [];
        $(document).ready(function() {
            getNotify();
            showPostDetail();

            // if ("<?= $student ?>" == "<?= $_SESSION['username'] ?>") {
            //     showOffer();
            // }
        });

        function showPostDetail() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_post_detail.php",
                data: {
                    post_id: <?= $post_id ?>,
                    student: "<?= $student ?>",
                },
                success: function(response) {
                    $("#forContent1").html(response);
                }
            });
        }
    </script>
</body>

</html>