<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: login.php");
}

$header_title = "ตรวจสอบตัวตน";
$menu = "manage_approve";
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

    <title>ตรวจสอบตัวตน | TiWDERR Admin</title>

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom fonts (icon) for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.css"/>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include("layout/main_menu.php");
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include("layout/header.php");
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-flex flex-row">
                        <h3 class="text-dark">ตรวจสอบการยืนยันตัวตนของติวเตอร์</h3>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item ">
                                    <a id="nav1" class="nav-link mouse-hover" onclick="filter(1);">ทั้งหมด (<span id="num_nav1">0</span>)</a>
                                </li>
                                <li class="nav-item">
                                    <a id="nav2" class="nav-link mouse-hover" onclick="filter(2);">ยังไม่ยืนยัน (<span id="num_nav2">0</span>)</a>
                                </li>
                                <li class="nav-item">
                                    <a id="nav3" class="nav-link mouse-hover" onclick="filter(3);">รอการตรวจสอบ (<span id="num_nav3">0</span>)</a>
                                </li>
                                <li class="nav-item">
                                    <a id="nav4" class="nav-link mouse-hover" onclick="filter(4);">ผ่าน (<span id="num_nav4">0</span>)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="forTable" class="table-responsive">

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
            include("layout/footer.php");
            ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal -->
    <div id="forModal">

    </div>
    <!-- End Modal -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/logout.js"></script>

    <script>
        var filterTable = 1;

        $(document).ready(function() {
            filter(1);
            showTableUserNum();
        });

        function filter(num) {
            $('#nav' + num).addClass("active");
            filterTable = num;

            for (var i = 0; i <= 4; i++) {
                if (num != i) {
                    $('#nav' + i).removeClass("active");
                }
            }

            showTableUser();
        }

        function showTableUser() {
            $.ajax({
                type: "POST",
                url: "ajax/output/tbl_manage_approve.php",
                data: {
                    filterTable
                },
                success: function(response) {
                    $("#forTable").html(response);
                },
                error: function(error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        }

        function showTableUserNum() {
            $.ajax({
                type: "POST",
                url: "ajax/output/get_num_manage_approve.php",
                data: {},
                dataType: "JSON", 
                success: function(response) {
                    // console.log(response);
                    // var arr = ;
                    console.log('res: ' + response);
                    for (var i = 0; i < 4; i++) {
                        $("#num_nav" + (i+1)).text(response[i]);
                    }
                },
                error: function(error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        }
    </script>
</body>

</html>