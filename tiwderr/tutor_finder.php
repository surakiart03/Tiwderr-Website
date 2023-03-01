<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
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
    <title>ค้นหาติวเตอร์ | TiWDERR</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/rSlider.min.css">

    <!-- Summernote Css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- Cropper CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
    <link rel="stylesheet" href="./assets/css/cropper.css">


    <style>
        .modal.left .modal-dialog,
        .modal.right .modal-dialog {
            position: fixed;
            /* margin: auto; */
            width: 500px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content,
        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body,
        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

        /*Left*/
        .modal.left.fade .modal-dialog {
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left.fade.show .modal-dialog {
            left: 0;
        }

        /*Right*/
        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }
    </style>
</head>

<body class="bg-gradient-white">
    <?php
    $banner_head = "ค้นหาติวเตอร์";
    $banner_txt0 = "หาติวเตอร์สอนพิเศษ พื้นที่ใกล้ ๆ บ้าน ติวตัวต่อตัว ออนไลน์หรือออนไซต์ ทุกระดับชั้น ทุกวิชา<br>จะเรียนพิเศษ/กวดวิชา/ติวสอบ ก็เลือกได้อย่างอิสระ";
    $banner_btn1 = '<a href="#content" class="btn btn-danger btn-pill"><i class="mdi mdi-emoticon mr-1"></i>เริ่มค้นหาติวเตอร์</a>';
    $banner_btn2 = '<button type=button" class="btn btn-primary btn-pill ml-3" onclick="window.location.href=' . "'login.php';" . '">
            <i class="mdi mdi-script mr-1"></i>ลงงานสอนพิเศษ
        </button>';

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == "tutor") {
            if ($_SESSION['is_approved'] != 0) {
                $banner_btn2 = '<button type=button" class="btn btn-primary btn-pill ml-3" onclick="showModalAddCourse();">
                        <i class="mdi mdi-script mr-1"></i>ลงงานสอนพิเศษ
                    </button>';
            } else {
                $banner_btn2 = '<button type=button" class="btn btn-secondary btn-pill ml-3" onclick="alertApprove();">
            <i class="mdi mdi-script mr-1"></i>ลงงานสอนพิเศษ
        </button>';
            }
        } else if ($_SESSION['role'] == "student") {
            $banner_btn2 = '';
        }
    }

    include "layout/header_banner.php"
    ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <Section class="miri-ui-kit-section pb-0" id="content">
        <div class="container">
            <div class="row p-0 m-0">
                <h1>ค้นหาติวเตอร์</h1>
            </div>
            <div class="row m-0 p-0 d-flex justify-content-between">
                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 m-0 mb-3 p-0">
                    <div class="d-flex flex-row">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm  text-dark" id="search_tutor_finder" placeholder="ค้นหาติวเตอร์หรือหัวข้องานสอน" value="">
                            <div class="input-group-append">
                                <span class="mdi mdi-magnify input-group-text" style="font-size:1.5rem;"></span>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary py-1 ml-3 text-nowrap" type="button" onclick="showModalFilterCourse()"><i class="mdi mdi-filter-outline"></i>ตัวกรอง</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 m-0 mb-3 d-flex">
                    <span class="text-nowrap mr-3">เรียงตาม</span>
                    <select class="form-control form-control-sm text-dark mr-3" id="sort" name="sort">
                        <option value="0" selected>โพสต์ล่าสุด</option>
                        <option value="1">ราคาต่อชั่วโมง</option>
                        <option value="2">คะแนน</option>
                    </select>
                    <i class="mdi mdi-sort mouse-hover" style="font-size:1.5rem;" id="c_updown"></i>
                    <input type="hidden" id="updown" value=" DESC">
                </div>
            </div>
        </div>
    </Section>
    <Section id="forCourse" class="miri-ui-kit-section pt-0 mt-0">


    </Section>

    <!-- Modal -->
    <div id="forModal">
    </div>
    <!-- End Modal -->

    <!-- Modal -->
    <div id="forModal2">
    </div>
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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
    <script src="assets/js/please-approve.js"></script>
    <script src="assets/js/logout.js"></script>
    <script>
        $(document).ready(function() {
            getNotify();
            showCourse();

            $("#c_updown").on('click', function() {
                if ($("#updown").val() == " DESC") {
                    $("#updown").val(' ASC');
                } else {
                    $("#updown").val(' DESC');
                }
                var search_some = $("#search_tutor_finder").val() ?? "";
                var sort = $("#sort").val() ?? '0';
                var updown = $("#updown").val();
                $.ajax({
                    url: "ajax/output/get_course.php",
                    method: "POST",
                    data: {
                        search: "search",
                        check: "No",
                        search_some: search_some,
                        sort: sort,
                        updown: updown
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#forCourse").html(response);
                    }
                });
            })


            $("#sort").on('change', function() {
                var search_some = $("#search_tutor_finder").val() ?? "";
                var sort = $("#sort").val() ?? '0';
                var updown = $("#updown").val();
                $.ajax({
                    url: "ajax/output/get_course.php",
                    method: "POST",
                    data: {
                        search: "search",
                        check: "No",
                        search_some: search_some,
                        sort: sort,
                        updown: updown
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#forCourse").html(response);
                    }
                });
            })

            $("#search_tutor_finder").on('input', function() {
                var search_some = $("#search_tutor_finder").val() ?? "";
                var sort = $("#sort").val() ?? '0';
                var updown = $("#updown").val();
                $.ajax({
                    url: "ajax/output/get_course.php",
                    method: "POST",
                    data: {
                        search: "search",
                        check: "No",
                        search_some: search_some,
                        sort: sort,
                        updown: updown
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#forCourse").html(response);
                    }
                });
            })
        });

        function showCourse() {
            $.ajax({
                type: "post",
                url: "ajax/output/get_course.php",
                data: {

                },
                success: function(response) {
                    $("#forCourse").html(response);
                }
            });
        }

        function showModalAddCourse() {
            $.ajax({
                type: "post",
                url: "ajax/modal/md_add_course.php",
                data: {

                },
                success: function(response) {
                    $("#forModal").html(response);
                    $("#modal_add_course").modal("toggle");

                }
            });
        }

        function showModalFilterCourse() {
            $("#search_tutor_finder").val('');
            $("#sort").val('0').change();
            $.ajax({
                type: "post",
                url: "ajax/modal/md_filter_course.php",
                data: {

                },
                success: function(response) {
                    $("#forModal2").html(response);
                    $("#modal_filter_course").modal("toggle");

                }
            });
        }
    </script>
</body>

</html>