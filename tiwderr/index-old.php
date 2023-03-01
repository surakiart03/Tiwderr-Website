<?php
session_start();
// print_r($_SESSION);
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}
$username = "";
if (isset($_SESSION['username'])) {
$username = $_SESSION['username'];
}
?>
<?php
require_once("connection/connect_db.php");
$verified_status = "";
if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];
    $query = "SELECT * FROM tbl_user WHERE email = '$email' AND verification_code = '$v_code'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        //print_r($row);
        if ($row['is_verified'] == 0) {
            $v_code_new = bin2hex(random_bytes(16)); //
            $update = "UPDATE tbl_user 
                        SET is_verified = 1
                        , verification_code = '$v_code_new'
                        , verified_time = NOW() 
                        WHERE username = '$username'";
            if (mysqli_query($conn, $update)) {
                $verified_status = "true";
            }
        } else {
            $verified_status = "false";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
    <title>TiWDERR ติวเด้อ</title>


    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- AOS animate on scroll library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

</head>

<body class="bg-gradient-white">
    <?php include "layout/header_banner_index.php" ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <section class="miri-ui-kit-section how-we-work-section font-weight-light p-3">
        <div class="container  p-5 animate__animated animate__fadeInLeft">
            <div class="row">
                <div class="col-md-6 ">
                    <span style="font-size: 500%" class="text-primary font-weight-bold mb-5">TiWDERR</span>
                    <p class="h6 mt-5 mb-5"><span class="text-danger">"ติวเด้อ (TiWDERR)"</span> เป็นเว็บไซต์สำหรับค้นหาติวเตอร์ตามความต้องการของผู้เรียน โดยสามารถตั้งโพสต์ระบุสิ่งที่ต้องการศึกษา กำหนดงบประมาณของตน เพื่อให้บุคคลที่มีความรู้ด้านนั้น ๆ สามารถเสนอตนเองให้แก่ผู้เรียนได้ นอกจากนี้ บุคคลที่มีความรู้และต้องการรับสอนพิเศษสามารถตั้งโพสต์เสนองานเพื่อรับสอนได้ ซึ่งเว็บไซต์จะช่วยให้ผู้เรียนมีทางเลือกในการศึกษาหาความรู้ของตน และผู้สอนพิเศษมีทางเลือกในการหารายได้จากการสอนมากยิ่งขึ้น</p>
                </div>
                <div class="col-md-6 d-md-flex justify-content-end animate__animated animate__fadeInRight">
                    <div class="card bg-light text-white count-card">
                        <img src="./src/images/pro_people.png" alt="about 1" class="card-img">
                        <div class="card-img-overlay">
                            <div class="count-box bg-success text">
                                <span class="h2 text-white animate__animated animate__bounce">5430</span>
                                <span class="font-weight-medium">จำนวนติวเตอร์</span>
                            </div>
                            <div class="count-box bg-danger">
                                <span class="h2 text-white animate__animated animate__bounce">3323</span>
                                <span class="font-weight-medium">จำนวนผู้เรียน</span>
                            </div>
                            <div class="count-box bg-warning">
                                <span class="h2 text-white animate__animated animate__bounce">5981</span>
                                <span class="font-weight-medium">งานสอน</span>
                            </div>
                            <div class="count-box bg-primary">
                                <span class="h2 text-white animate__animated animate__bounce">3422</span>
                                <span class="font-weight-medium">โพสต์ประกาศ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="miri-ui-kit-section font-weight-light p-3">
        <div data-aos="fade-down" class="container  p-5">
            <div class="row text-center mb-2">
                <div class="col">
                    <span class="h5">TiWDERR มาพร้อมกับ <span class="h5 text-primary">
                            <?php
                            $query = "SELECT subject FROM tbl_subjects";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_num_rows($result);
                                echo ($row);
                            }
                            ?> หมวดวิชา</span>
                        ให้คุณได้เลือกค้นหา</span>
                </div>
            </div>
            <div class="row text-center mb-5">
                <div class="col">
                    <span class="h1 text-danger ">10 อันดับ</span><span class="h1"> หมวดวิชายอดนิยม</span>
                </div>
            </div>
            <div class="row mb-5">
                <div data-aos="flip-left">
                    <div class="row justify-content-center ">
                        <?php
                        $top10query = "SELECT A.*, D.sum_sub FROM tbl_subjects A LEFT JOIN (SELECT subject, COUNT(subject) AS sum_sub  FROM tbl_course GROUP BY subject) D ON A.subject = D.subject ORDER BY D.sum_sub DESC LIMIT 10";
                        $result1 = mysqli_query($conn, $top10query);
                        while ($row = $result1->fetch_assoc()) {
                            // echo '<div data-aos="flip-left"><span style="font-size: 250%" class ="badge badge-danger mr-5 mb-5">';
                            // echo $row['subject'];
                            // echo '</span"></div>';

                        ?>

                            <div class="col-md-3">
                                <div class="card border-danger mb-3 shadow-sm raise-on-hover">
                                    <div class="card-body text-center">
                                        <span class="card-title  h5"><i class="mdi mdi-prize"></i><?= $row['subject'] ?></span>
                                    </div>
                                </div>
                            </div>


                            <!-- <span style="font-size: 250%" class="badge badge-danger mr-5 mb-5">
                        $row['subject']
                        </span"> -->

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="miri-ui-kit-section font-weight-light p-3">

        <div data-aos="fade-left" class="container  p-5">
            <div class="row">
                <div class="col-md-6 text-center"><img src="./src/images/index_content2.png" width="75%" height="75%" alt="About" class="img-fluid"></div>

                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-primary">ค้นหาผู้สอน และ ค้นหาประกาศตามหาผู้สอน</h2>
                        </div>
                        <div class="col-2   ">
                            <span class="card-icon bg-danger text-white rounded-circle"><i class="mdi mdi-magnify"></i></span>
                        </div>
                    </div>
                    <p class="h6 mb-5">ผู้เรียนสามารถค้นหาติวเตอร์ที่สนใจ และ ติวเตอร์สามารถค้นหาประกาศตามหาติวเตอร์ของผู้เรียนตามเกณฑ์ที่เกี่ยวข้อง</p>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-danger btn-pill btn-block mdi mdi-account-search-outline" type="button" onclick="window.location='tutor_finder.php'"> ค้นหาติวเตอร์</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-pill btn-block mdi mdi-table-search" type="button" onclick="window.location='announcement_post.php'"> ค้นหาประกาศ</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="miri-ui-kit-section font-weight-light p-3">
        <div data-aos="fade-right" class="container  p-5">
            <div class="row">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-2   ">
                            <span class="card-icon bg-danger text-white rounded-circle"><i class="mdi mdi-post-outline"></i></span>
                        </div>
                        <div class="col">
                            <h2 class="text-primary">ประกาศหาผู้สอน และ เพิ่มข้อมูลคอร์สเรียน</h2>
                        </div>
                    </div>
                    <p class="h6 mb-5">ผู้เรียนสามารถลงประกาศหาติวเตอร์ที่ตนสนใจตามเกณฑ์ที่เกี่ยวข้อง และ ติวเตอร์สามารถเพิ่มรายละเอียดข้อมูลคอร์สวิชาเรียนที่สอนบนโปรไฟล์ของตนเอง</p>
                </div>
                <div class="col-md-6 text-center"><img src="./src/images/index_content1.png" width="75%" height="75%" alt="About" class="img-fluid"></div>
            </div>
        </div>
    </section>

    <section class="miri-ui-kit-section font-weight-light p-3">
        <div data-aos="fade-left" class="container  p-5">
            <div class="row">
                <div class="col-md-6 text-center"><img src="./src/images/tiwderr_index_content4.png" width="75%" height="75%" alt="About" class="img-fluid"></div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-2   ">
                            <span class="card-icon bg-danger text-white rounded-circle"><i class="mdi mdi-message-draw"></i></span>
                        </div>
                        <div class="col">
                            <h2 class="text-primary">รีวิวให้คะแนนผู้สอนและผู้เรียน</h2>
                        </div>
                    </div>
                    <p class="h6 mb-5">ผู้เรียนสามารถเขียนรีวิวและให้คะแนนติวเตอร์ได้ ซึ่งสามารถช่วยให้ผู้เรียนรายอื่นประกอบการค้นหาผู้สอนที่ดีที่สุดสำหรับตน และ ติวเตอร์สามารถเขียนรีวิวและให้คะแนนผู้เรียนได้ ซึ่งนับว่าเป็นคะแนนพฤติกรรมการใช้งาน</p>
                </div>
            </div>
        </div>
    </section>
    <section class="miri-ui-kit-section font-weight-light p-3">
        <div data-aos="fade-right" class="container  p-5">
            <div class="row">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-primary">สมัครสมาชิกกับเว็บไซต์ TiWDERR</h2>
                        </div>
                        <div class="col-2   ">
                            <span class="card-icon bg-danger text-white rounded-circle"><i class="mdi mdi-account-plus"></i></span>
                        </div>

                    </div>
                    <p class="h6 mb-5">ผู้ใช้สามารถเลือกสมัครสมาชิกเป็นผู้เรียน หรือ สมัครสมาชิกเป็นผู้สอน จะต้องมีการยินยันตัวตนผ่านอีเมลทั้งผู้เรียนและผู้สอนถึงจะสามารถเข้าสู่ระบบได้ และ ผู้สอนจะต้องอัพโหลดเอกสารสำเนาบัตรประชาชนและระบุประวัติการศึกษาให้กับทาง TiWDERR ตรวจสอบยืนยันตัวตนเพื่มเติมเพิ่มความน่าเชื่อให้กับผู้สอน</p>
                </div>
                <div class="col-md-6 text-center"><img src="./src/images/tiwderr_index_content3.png" width="75%" height="75%" alt="About" class="img-fluid"></div>

            </div>
        </div>
    </section>
    <?php include "layout/footer.php" ?>
    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="src/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="src/js/miri-ui-kit.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/floating-btn.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/logout.js"></script>
    <script>
        AOS.init();
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {
 		if ("<?= $username ?>" != "") {
			getNotify();
		}
            var verified_status = "<?= $verified_status ?>";
            if (verified_status != "" && verified_status == "true") {
                Swal.fire({
                    title: 'ยืนยันตัวตนสำเร็จ !',
                    text: 'คุณสามารถเริ่มต้นใช้งาน TiWDERR ได้แล้ว',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //cancelButtonColor: '#d33',
                    confirmButtonText: 'เข้าสู่ระบบเลย !',
                    //cancelButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                })
            }

        });
    </script>
</body>

</html>