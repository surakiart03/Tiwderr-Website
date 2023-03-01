<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}
$username = "";
if (isset($_SESSION['username'])) {
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
    <title>Miri UI Kit - Landing Page</title>

    <!-- Vendor css -->
    <link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <!-- Base css with customised bootstrap included -->
    <link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

    <!-- Stylesheet for demo page specific css -->
    <link rel="stylesheet" href="./assets/css/demo.css">
    <link rel="stylesheet" href="./assets/css/how.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Big Added -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <!--  -->


</head>

<body class="bg-gradient-white">
    <?php
    include "layout/header_nobanner.php"
    ?>
    <button onclick="topFunction()" id="goto_top_btn" title="ไปยังบนสุด"><i class="mdi mdi-arrow-up-bold"></i></button>
    <section class="miri-ui-kit-section">
        <div class="container">
            <div class="card text-center">
                <div class="card-header" style="background-color: white;">
                    <ul class="nav nav-pills  card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true"><i class="mdi mdi-receipt"></i>ผู้เรียน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="coupon-tab3" data-toggle="tab" href="#coupon3" role="tab" aria-controls="coupon3" aria-selected="false"><i class="mdi mdi-receipt"></i>ติวเตอร์</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content mb-5">
                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                    <div data-aos="zoom-in">
                        <h5>ผู้เรียนสามารถหาติวเตอร์ที่ใช้ได้ 2 วิธี ดังนี้</h5>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-5 grid-margin" style="padding-bottom:50px">
                            <div class="col-md-12 d-flex flex-column justify-content-center">
                                <div>
                                    <div data-aos="zoom-in" class="ex2">
                                        ประกาศหาติวเตอร์
                                    </div>
                                    <hr class="new2">
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">1</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">สร้างประกาศหาติวเตอร์</div>
                                            <div class="ex4">
                                                • กำหนดรายละเอียดเนื้อหาที่คุณสนใจ
                                                <br>
                                                • กำหนดราคาตามที่ต้องการ
                                                <br>
                                                • กำหนดวันเวลาที่ใช่
                                                <br>
                                                • กำหนดรูปแบบช่องทางการเรียนที่ชอบ
                                                <br>
                                                • ติวเดี่ยวหรือกลุ่ม เลือกได้ตามใจ
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">2</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รับข้อเสนอจากติวเตอร์</div>
                                            <div class="ex4">
                                                ติวเตอร์ที่สนใจจะยื่นข้อเสนในประกาศของคุณ
                                                <br>
                                                ข้อเสนออาจมีการเปลี่ยนแปลงตามติวเตอร์ผู้เสนอสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">3</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">เลือกติวเตอร์</div>
                                            <div class="ex4">
                                                หลังจากได้ข้อเสนอที่ต้องการ
                                                <br>
                                                กดสนใจเพื่อแจ้งให้ติวเตอร์ทราบ
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">4</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">ติดต่อหาติวเตอร์</div>
                                            <div class="ex4">
                                                ติดต่อหาติวเตอร์ผ่านโซเชียลมิเดีย
                                                <br>
                                                เช่น Line, Facebook เพื่อเริ่มการเรียนการสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">5</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รีวิวติวเตอร์หลังการสอน</div>
                                            <div class="ex4">เขียนรีวิวและให้คะแนนติวเตอร์หลังการสอน</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 grid-margin d-md-flex main-ct" style="padding-bottom:50px">
                            <div class="fixed-ct">
                                <img src="assets/images/tutor.png" alt="about 1" class="card-img">
                            </div>
                        </div>

                        <div class="col-lg-7 grid-margin d-md-flex main-ct2" style="padding-bottom:50px">
                            <div class="fixed-ct2">
                                <img src="assets/images/tutor2.png" alt="about 1" class="card-img">
                            </div>
                        </div>

                        <div class="col-lg-5 grid-margin" style="padding-bottom:50px">
                            <div class="col-md-12 d-flex flex-column justify-content-center">
                                <div>
                                    <div data-aos="zoom-in" class="ex2">
                                        ค้นหาติวเตอร์
                                    </div>
                                    <hr class="new2">
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">1</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">ประกาศหาติวเตอร์</div>
                                            <div class="ex4">
                                                ผู้เรียนเลือกงานที่สนใจจากประกาศรับงานสอนของติวเตอร์
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">2</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รับข้อเสนอจากติวเตอร์</div>
                                            <div class="ex4">
                                                ยื่นข้อเสนอในประกาศของติวเตอร์
                                                <br>
                                                ผู้เรียนสามารถยื่นข้อเสนอใหม่ให้ติวเตอร์พิจารณาได้
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">3</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">เลือกติวเตอร์</div>
                                            <div class="ex4">
                                                ติดต่อหาติวเตอร์ผ่านโซเชียลมิเดีย
                                                <br>
                                                เช่น Line, Facebook เพื่อเริ่มการเรียนการสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">4</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รีวิวติวเตอร์หลังการสอน</div>
                                            <div class="ex4">
                                                เขียนรีวิวและให้คะแนนติวเตอร์หลังการสอน
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="coupon3" role="tabpanel" aria-labelledby="coupon-tab3">
                    <div data-aos="zoom-in">
                        <h5>ติวเตอร์สามารถหางานที่ใช้ได้ 2 วิธี ดังนี้</h5>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-5 grid-margin" style="padding-bottom:50px">
                            <div class="col-md-12 d-flex flex-column justify-content-center">
                                <div>
                                    <div data-aos="zoom-in" class="ex2">
                                        เพิ่มงานสอน
                                    </div>
                                    <hr class="new2">
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">1</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">สร้างประกาศงานสอน</div>
                                            <div class="ex4">
                                                • กำหนดรายละเอียดเนื้อหาที่คุณสอน
                                                <br>
                                                • กำหนดราคาตามที่ต้องการ
                                                <br>
                                                • กำหนดวันเวลาที่ใช่
                                                <br>
                                                • กำหนดรูปแบบช่องทางการเรียนที่ชอบ
                                                <br>
                                                • ติวเดี่ยวหรือกลุ่ม เลือกได้ตามใจ
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">2</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รับข้อเสนอจากผู้เรียน</div>
                                            <div class="ex4">
                                                ผู้เรียนที่สนใจจะยื่นข้อเสนในประกาศของคุณ
                                                <br>
                                                ข้อเสนออาจมีการเปลี่ยนแปลงตามผู้เรียนเสนอให้คุณสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">3</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">เลือกข้อเสนอจากผู้เรียน</div>
                                            <div class="ex4">
                                                หลังจากได้ข้อเสนอที่ต้องการ
                                                <br>
                                                กดสนใจเพื่อแจ้งให้ผู้เรียนทราบ
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">4</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รอผู้เรียนติดต่อกลับ</div>
                                            <div class="ex4">
                                                ผู้เรียนติดต่อหาผู้สอนผ่านโซเชียลมิเดีย
                                                <br>
                                                เช่น Line, Facebook เพื่อเริ่มการเรียนการสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">5</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รีวิวผู้เรียนหลังการสอน</div>
                                            <div class="ex4">รีวิวผู้เรียนหลังการสอน</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 grid-margin d-md-flex main-ct" style="padding-bottom:50px">
                            <div class="fixed-ct">
                                <img src="assets/images/tutor3.png" alt="about 1" class="card-img">
                            </div>
                        </div>

                        <div class="col-lg-7 grid-margin d-md-flex main-ct2" style="padding-bottom:50px">
                            <div class="fixed-ct2">
                                <img src="assets/images/tutor4.png" alt="about 1" class="card-img">
                            </div>
                        </div>

                        <div class="col-lg-5 grid-margin" style="padding-bottom:50px">
                            <div class="col-md-12 d-flex flex-column justify-content-center">
                                <div>
                                    <div data-aos="zoom-in" class="ex2">
                                        ค้นหางานที่สนใจ
                                    </div>
                                    <hr class="new2">
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">1</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">เลือกงานจากผู้เรียน</div>
                                            <div class="ex4">
                                                ติวเตอร์เลือกงานที่สนใจจากประกาศรับติวเตอร์ของผู้เรียน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">2</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">ยื่นข้อเสนอให้ผู้เรียน</div>
                                            <div class="ex4">
                                                ยื่นข้อเสนอในประกาศของผู้เรียน
                                                <br>
                                                ติวเตอร์สามารถยื่นข้อเสนอใหม่ให้ผู้เรียนพิจารณาได้
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">3</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รอผู้เรียนติดต่อกลับ</div>
                                            <div class="ex4">
                                                ผู้เรียนติดต่อหาผู้สอนผ่านโซเชียลมิเดีย
                                                <br>
                                                เช่น Line, Facebook เพื่อเริ่มการเรียนการสอน
                                            </div>
                                        </div>
                                    </div>
                                    <div data-aos="fade-up" class="row">
                                        <div class="col-md-2 ex1 big">4</div>
                                        <div class="col-md-10 ex1">
                                            <div class="ex3">รีวิวผู้เรียนหลังการสอน</div>
                                            <div class="ex4">
                                                เขียนรีวิวให้ผู้เรียนหลังการสอน
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <?php include "layout/footer.php" ?>

    <script src="assets/js/floating-btn.js"></script>
    <!-- Big Added -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/logout.js"></script>
    <script>
        $(document).ready(function() {
 		if ("<?= $username ?>" != "") {
			getNotify();
		}

            AOS.init();

            let scrollRef = 0;
            $(window).on("resize scroll", function() {
                // increase value up to 10, then refresh AOS
                scrollRef <= 10 ? scrollRef++ : AOS.refresh();
            });

        });
    </script>

    <!--  -->

    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="src/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="src/js/miri-ui-kit.js"></script>
</body>

</html>