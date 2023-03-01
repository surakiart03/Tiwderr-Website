<?php
require_once("../../connection/connect_db.php");
session_start();

$course_id = $_POST['course_id'];
$tutor = $_POST['tutor'];

$sql = "SELECT A.*, B.profile_pic, B.profile_name, B.bio, B.gender, C.location FROM `tbl_course` A
        INNER JOIN `tbl_user_info` B
        ON A.create_by = B.username
	LEFT JOIN `tbl_location` C
	ON A.create_by = C.username
        WHERE A.id = $course_id;";
$result = mysqli_query($conn, $sql);

$sql_course_of_tutor = "SELECT COUNT(id) AS num_of_course FROM `tbl_course` WHERE `create_by` = '$tutor';";
$result_course_of_tutor = mysqli_query($conn, $sql_course_of_tutor);

$num_of_course = 0;
if (mysqli_num_rows($result_course_of_tutor) != 0) {
    foreach ($result_course_of_tutor as $row) {
        $num_of_course = $row['num_of_course'];
    }
}

$sql_rating = "SELECT SUM(`score`) AS sum_score, COUNT(`course`) as total_review FROM `tbl_review_course` WHERE `course` = $course_id";
$result_rating = mysqli_query($conn, $sql_rating);

$rating = 0;
if (mysqli_num_rows($result_rating) != 0) {
    foreach ($result_rating as $row) {
        $sum_score = $row['sum_score'];
        $total_review = $row['total_review'];
    }
    if ($total_review != 0) {
        $rating = round($sum_score / $total_review, 1);
    }
}

$sql_rating_tutor = "SELECT SUM(A.score) AS sum_score, COUNT(course) AS total_review 
                    FROM `tbl_review_course` A 
                    INNER JOIN `tbl_course` B 
                    ON A.course=B.id 
                    WHERE B.create_by = '$tutor'";
$result_rating_tutor = mysqli_query($conn, $sql_rating_tutor);

$rating_tutor = 0;
if (mysqli_num_rows($result_rating_tutor) != 0) {
    foreach ($result_rating_tutor as $row) {
        $sum_score_tutor = $row['sum_score'];
        $total_review_tutor = $row['total_review'];
    }
    if ($total_review_tutor != 0) {
        $rating_tutor = round($sum_score_tutor / $total_review_tutor, 1);
    }
}

$btn_like = "btn-outline-secondary";
$btn_like_text = "ถูกใจ";
$btn_like_val = 0;
if (isset($_SESSION['username'])) {
    $sql_fav = "SELECT * FROM `tbl_like_course` WHERE `username` = '$_SESSION[username]' AND `course_id` = $course_id";
    $result_fav = mysqli_query($conn, $sql_fav);

    if (mysqli_num_rows($result_fav) != 0) {
        $btn_like = "btn-danger";
        $btn_like_text = "ถูกใจแล้ว";
        $btn_like_val = 1;
    }
}

if (mysqli_num_rows($result) != 0) {
    foreach ($result as $row) {
?>
        <div class="card shadow-sm ">
            <div class="card-body">
                <?php
                if (isset($_SESSION['username']) && $tutor == $_SESSION['username']) {
                ?>
                    <div class="nav-item dropdown d-flex flex-row justify-content-end m-0 p-0">
                        <a href="#" class="p-0" data-toggle="dropdown">
                            <i class="mdi mdi-dots-horizontal" style="font-size:1.5rem;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right ">
                            <button class="dropdown-item" onclick="showModalEditCourse();"><i class="dropdown-item-icon mdi mdi-pencil"></i>แก้ไขงานสอน</button>
                            <!-- <button  class="dropdown-item" onclick=""><i class="dropdown-item-icon mdi mdi-shape-plus"></i>เพิ่มตัวอย่างการสอน</button> -->
                            <button class="dropdown-item" onclick="settingCourseStatus();"><i class="dropdown-item-icon mdi mdi-lock-open-outline"></i>เปิดรับ/ปิดรับ</button>
                            <button class="dropdown-item" onclick="deleteCourse();"><i class="dropdown-item-icon mdi mdi-delete"></i>ลบงานสอน</button>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <img class="card-img-top" src="assets/images/cover_course/<?= $row['cover'] ?>" alt="Card image cap">
                        <?php
                        if (isset($_SESSION['username']) && $_SESSION['role'] == "student") {
                        ?>
                            <div class="row m-0 mt-3">
                                <button class="btn <?= $btn_like ?> btn-sm" style="width: 100%;" id="btn_like" value="<?= $btn_like_val ?>" onclick="changeFavorite();"><i class="mdi mdi-heart mr-1 mdi-xl"></i><span id="btn_like_text"><?= $btn_like_text ?></span></button>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row m-0 mt-3">
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">หมวดวิชา</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['subject'] ?></span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ระดับชั้น</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark">
                                    <?php
                                    if ($row['level'] == 0) {
                                        echo 'อนุบาล';
                                    } else if ($row['level'] == 1) {
                                        echo 'ประถมศึกษา';
                                    } else if ($row['level'] == 2) {
                                        echo 'มัธยมศึกษาตอนต้น';
                                    } else if ($row['level'] == 3) {
                                        echo 'มัธยมศึกษาตอนปลาย';
                                    } else if ($row['level'] == 4) {
                                        echo 'มหาวิทยาลัย';
                                    } else if ($row['level'] == 5) {
                                        echo 'บุคคลทั่วไป';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">เป้าหมาย</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark">
                                    <?php
                                    if ($row['purpose'] == 0) {
                                        echo 'ความรู้ในงานประจำ';
                                    } else if ($row['purpose'] == 1) {
                                        echo 'งานอดิเรก';
                                    } else if ($row['purpose'] == 2) {
                                        echo 'เพื่อการแข่งขัน';
                                    } else if ($row['purpose'] == 3) {
                                        echo 'เพื่อการแสดง';
                                    } else if ($row['purpose'] == 4) {
                                        echo 'เพิ่มเกรด';
                                    } else if ($row['purpose'] == 5) {
                                        echo 'เพิ่มทักษะ/เสริมความรู้ความเข้าใจ';
                                    } else if ($row['purpose'] == 6) {
                                        echo 'ทำการบ้าน';
                                    } else if ($row['purpose'] == 7) {
                                        echo 'ทำข้อสอบเข้าเรียน';
                                    } else if ($row['purpose'] == 8) {
                                        echo 'ทำข้อสอบวัดระดับ';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ช่องทาง</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['channel'] ?></span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ติวแบบ</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['group_type'] ?>

                                </span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">วันที่ติว</span></div>
                            <div class="col-8 m-0 p-0">
                                <?php
                                $day = explode(",", $row['day']);

                                if (count($day) != 0) {
                                    for ($i = 0; $i < count($day); $i++) {
                                        if ($day[$i] == "mon") {
                                            echo '<span class="text-white" style="background-color: gold;">จ. </span>';
                                        } else if ($day[$i] == "tue") {
                                            echo '<span class="text-white" style="background-color: hotpink;">อ. </span>';
                                        } else if ($day[$i] == "wed") {
                                            echo '<span class="text-white" style="background-color: green;">พ. </span>';
                                        } else if ($day[$i] == "thu") {
                                            echo '<span class="text-white" style="background-color: orange;">พฤ. </span>';
                                        } else if ($day[$i] == "fri") {
                                            echo '<span class="text-white" style="background-color: blue;">ศ. </span>';
                                        } else if ($day[$i] == "sat") {
                                            echo '<span class="text-white" style="background-color: purple;">ส. </span>';
                                        } else if ($day[$i] == "sun") {
                                            echo '<span class="text-white" style="background-color: red;">อา. </span>';
                                        } else {
                                            echo '-';
                                        }
                                    }
                                } else {
                                    echo "-";
                                }
                                ?>
                            </div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ช่วงเวลา</span></div>
                            <div class="col-8 m-0 p-0">
                                <?php
                                $time = explode(",", $row['time']);

                                if (count($time) != 0) {
                                    for ($i = 0; $i < count($time); $i++) {
                                        if ($time[$i] == "เช้า-เที่ยง") {
                                            echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-sunny"></i>ช่วงเช้า-เที่ยง</span><br>';
                                        } else if ($time[$i] == "บ่าย-เย็น") {
                                            echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-sunset"></i>ช่วงบ่าย-เย็น</span><br>';
                                        } else if ($time[$i] == "ค่ำ") {
                                            echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-night"></i>ช่วงค่ำ</span><br>';
                                        } else if ($time[$i] == "เต็มวัน") {
                                            echo '<span class="text-dark"><i class="mr-1 mdi mdi-clock"></i>เต็มวัน (เช้า-เย็น)</span><br>';
                                        } else {
                                            echo '-';
                                        }
                                    }
                                } else {
                                    echo "-";
                                }
                                ?>

                            </div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ราคาต่อชั่วโมง</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['price'] ?> บาท</span></div>
                        </div>
                        <div class="row m-0 my-3">
                            <!--<div class="col-12 m-0 p-0"><span class="text-secondary">จำนวนเข้าชม 256,875 ครั้ง</span></div>-->
                            <div class="col-12 m-0 p-0"><span class="text-secondary">สร้างเมื่อ <?= $row['created_time'] ?> น.</span></div>
                            <div class="col-12 m-0 p-0"><span class="text-secondary">อัปเดตล่าสุด <?= $row['last_update'] ?  $row['last_update'] . " น." : "-"  ?></span></div>
                        </div>


                    </div>
                    <div class="col-md-8">
                        <h3 class="font-weight-bolder"><?= $row['title'] ?></h3>
                        <p class="m-0 text-warning mt-3 "><span class="font-weight-bolder" style="font-size:1.5rem;"><?= $rating ?>/5 </span>
                            <?php
                            if ($rating != 0) {
                                for ($star = 0; $star < floor($rating); $star++) {
                                    echo '<i class="mdi mdi-star text-warning" style="font-size:1.5rem;"></i>';
                                }
                                if (fmod($rating, floor($rating)) != 0) {
                                    echo '<i class="mdi mdi-star-half text-warning" style="font-size:1.5rem;"></i>';
                                }
                                for ($star = 0; $star < 5 - ceil($rating); $star++) {
                                    echo '<i class="mdi mdi-star-outline text-warning" style="font-size:1.5rem;"></i>';
                                }
                            } else {
                                for ($star = 0; $star < 5; $star++) {
                                    echo '<i class="mdi mdi-star-outline text-warning" style="font-size:1.5rem;"></i>';
                                }
                            }

                            ?>

                            <span class="text-secondary">(<?= $total_review ?>)</span>
                        </p>
                        <p class="m-0 mt-3 ">
                            <?= $row['intro'] ?>
                        </p>
                        <div class="d-flex flex-row justify-content-between mt-3 ">
                            <p class="m-0" style="text-align:right; " id="course_status">
                                <?php if ($row['course_status'] == 1) {
                                ?>
                                    <span class="badge badge-pill badge-success" name="course_status">เปิดรับ</span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-pill badge-danger" name="course_status">ปิดรับ</span>
                                <?php
                                }
                                ?>
                            </p>
                            <p class="m-0" style="text-align:right; ">
                                <span class="text-dark h5 mr-1">฿<?= $row['price'] ?></span><span class="">/ชั่วโมง</span>
                            </p>
                        </div>
                        <div class="tabset mt-3">
                            <!-- Tab 1 -->
                            <input type="radio" name="tabset" id="tab1" aria-controls="tab1" checked>
                            <label for="tab1"><i class="mr-1 mdi mdi-book-open"></i>รายละเอียด</label>
                            <!-- Tab 2 -->
                            <!-- <input type="radio" name="tabset" id="tab2" aria-controls="tab2">
                            <label for="tab2"><i class="mr-1 mdi mdi-library"></i>ตัวอย่างการสอน</label> -->
                            <!-- Tab 3 -->
                            <input type="radio" name="tabset" id="tab3" aria-controls="tab3">
                            <label for="tab3"><i class="mr-1 mdi mdi-account-box"></i>ติวเตอร์</label>
                            <!-- Tab 4 -->
                            <input type="radio" name="tabset" id="tab4" aria-controls="tab4">
                            <label for="tab4"><i class="mr-1 mdi mdi-star-circle"></i>รีวิว</label>

                            <div class="tab-panels">
                                <section id="tab1" class="tab-panel">
                                    <div class="container p-10">
                                        <?= $row['course_descrip'] ?>
                                    </div>
                                </section>
                                <!-- <section id="tab2" class="tab-panel">
                                </section> -->
                                <section id="tab3" class="tab-panel">
                                    <div class="container p-10">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-4 text-center">
                                                <figure class="d-inline-block">
                                                    <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" width="150" height="150" alt="demo" class="img-rounded">
                                                </figure>
                                                <p><a href="#" class="btn btn-outline-primary btn-sm" onclick="(window.location.href='profile.php?username=<?= $row['create_by'] ?>')">ดูโปรไฟล์</a></p>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-8">
                                                <h5 class="mb-0"><?= $row['profile_name'] ?>
                                                    <?php
                                                    if ($row['gender'] == 'ไม่ระบุ') {
                                                        echo '<i class="mx-1 mdi mdi-gender-transgender text-info" style="font-size:1.5rem;"></i>';
                                                    } else if ($row['gender'] == 'ชาย') {
                                                        echo '<i class="mx-1 mdi mdi-gender-male text-primary" style="font-size:1.5rem;"></i>';
                                                    } else if ($row['gender'] == 'หญิง') {
                                                        echo '<i class="mx-1 mdi mdi-gender-female text-danger" style="font-size:1.5rem;"></i>';
                                                    } else if ($row['gender'] == 'lgbtq+') {
                                                        echo '<span class="mx-1 text-secondary" style="font-size:1.5rem;">?</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </h5>
                                                <p><span class="text-secondary"><?= $row['create_by'] ?></span></p>
                                                <p><i class="mx-1 mdi mdi-star text-dark" style="font-size:1rem;"></i><?= $rating_tutor ?> คะแนน
                                                    <i class="mx-1 mdi mdi-comment-text text-dark" style="font-size:1rem;"></i><?= $total_review_tutor ?> รีวิว
                                                    <i class="mx-1 mdi mdi-book-multiple text-dark" style="font-size:1rem;"></i><?= $num_of_course ?> งานสอน
                                                <p>
					            <?php if ($row['location'] != "") {
					                echo '<p><i class="mdi mdi-map-marker mr-2"></i>' . $row['location'] . '</p>';
					            }
					            ?>

                                                <p><?= $row['bio'] ?></p>

                                                <?php
                                                $sql_contact = "SELECT * FROM `tbl_tutor_contact` WHERE `username` = '$row[create_by]' ORDER BY `type` ";
                                                $result_contact = mysqli_query($conn, $sql_contact);

                                                if (mysqli_num_rows($result_contact) != 0) {
                                                    foreach ($result_contact as $row_contact) {
                                                        if ($row_contact['type'] == "1-Phone") {
                                                            echo '<p><img src="assets/images/icons/b-phone.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "2-Email") {
                                                            echo '<p><img src="assets/images/icons/b-mail.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "3-Facebook") {
                                                            echo '<p><img src="assets/images/icons/b-facebook.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "4-Instagram") {
                                                            echo '<p><img src="assets/images/icons/b-ig.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "5-Line") {
                                                            echo '<p><img src="assets/images/icons/b-line.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "6-Twitter") {
                                                            echo '<p><img src="assets/images/icons/b-twitter.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else if ($row_contact['type'] == "7-WhatsApp") {
                                                            echo '<p><img src="assets/images/icons/b-whatsapp.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row_contact['contact'] . '</span></p>';
                                                        } else {
                                                            echo '-';
                                                        }
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section id="tab4" class="tab-panel">
                                    <div class="container p-10">
                                        <div class="row">
                                            <div class="col-4 col-xl-3">
                                                <span class="text-warning h1"><?= $rating ?>/5</span>
                                                <p><span class="text-secondary">จาก <?= $total_review ?> รีวิว</span></p>
                                            </div>
                                            <?php
                                            $sql_review = "SELECT score
                                                            , COUNT(*) AS `num` 
                                                            FROM `tbl_review_course` 
                                                            WHERE `course` = $course_id
                                                            GROUP BY `score`";
                                            $result_review = mysqli_query($conn, $sql_review);

                                            $num_score1 = 0;
                                            $num_score2 = 0;
                                            $num_score3 = 0;
                                            $num_score4 = 0;
                                            $num_score5 = 0;

                                            if (mysqli_num_rows($result_review) != 0) {

                                                foreach ($result_review as $row_review) {
                                                    if ($row_review['score'] == 1) {
                                                        $num_score1 = $row_review['num'];
                                                    } else if ($row_review['score'] == 2) {
                                                        $num_score2 = $row_review['num'];
                                                    } else if ($row_review['score'] == 3) {
                                                        $num_score3 = $row_review['num'];
                                                    } else if ($row_review['score'] == 4) {
                                                        $num_score4 = $row_review['num'];
                                                    } else if ($row_review['score'] == 5) {
                                                        $num_score5 = $row_review['num'];
                                                    } else {
                                                    }
                                                }
                                            }
                                            ?>

                                            <div class="col-8 col-xl-9">
                                                <p class="m-0 text-warning ">
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i><span class="text-secondary ml-1">(<?= $num_score5 ?>)</span>
                                                </p>
                                                <p class="m-0 text-warning ">
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i><span class="text-secondary ml-1">(<?= $num_score4 ?>)</span>
                                                </p>
                                                <p class="m-0 text-warning ">
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i><span class="text-secondary ml-1">(<?= $num_score3 ?>)</span>
                                                </p>
                                                <p class="m-0 text-warning ">
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i><span class="text-secondary ml-1">(<?= $num_score2 ?>)</span>
                                                </p>
                                                <p class="m-0 text-warning ">
                                                    <i class="mdi mdi-star text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i>
                                                    <i class="mdi mdi-star-outline text-warning" style="font-size:1rem;"></i><span class="text-secondary ml-1">(<?= $num_score1 ?>)</span>
                                                </p>
                                            </div>

                                            <?php
                                            if (isset($_SESSION['username']) && $_SESSION['role'] == "student") {
                                            ?>
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-sm" onclick="showModalAddReview(<?= $course_id ?>);"><i class="mr-1 mdi mdi-pencil"></i>เขียนรีวิวของคุณ</button>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-12 mt-3 p-0 m-0">
                                                <div class="row p-0 m-0">
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(0);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_all" autocomplete="off" checked>
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_all">ทั้งหมด</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(5);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_5" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_5">5 ดาว</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(4);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_4" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_4">4 ดาว</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(3);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_3" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_3">3 ดาว</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(2);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_2" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_2">2 ดาว</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                                                        <div class="button-radio" onclick="selectScore(1);">
                                                            <input type="radio" class="btn-check" name="star_options" id="star_1" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm" for="star_1">1 ดาว</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="forReviewList">

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<script>
    var score = 0;
    var username = "<?= isset($_SESSION['username']) ? $_SESSION['username'] : ""?>";
    $(document).ready(function() {
        showReviewList();
    });

    function selectScore(num) {
        score = num;
        showReviewList();
    }

    function showReviewList() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_review_course.php",
            data: {
                course_id: <?= $course_id ?>,
                score: score,
            },
            success: function(response) {
                $("#forReviewList").html(response);
            }
        });
    }

    function changeFavorite() {
        var stat = $("#btn_like").val();
        if (stat == 0) {
            var url = "add_like_course.php";
        } else {
            var url = "delete_like_course.php";
        }

        $.ajax({
            type: "POST",
            url: "ajax/action/" + url,
            data: {
                course_id: <?= $course_id ?>,
                username: username
            },
            success: function(response) {
                console.log('res: ' + response);
                if (stat == 0) {
                    $("#btn_like").val(1);
                    $("#btn_like_text").text("ถูกใจแล้ว");
                    $("#btn_like").removeClass("btn-outline-secondary");
                    $("#btn_like").addClass("btn-danger");
                } else {
                    $("#btn_like").val(0);
                    $("#btn_like_text").text("ถูกใจ");
                    $("#btn_like").removeClass("btn-danger");
                    $("#btn_like").addClass("btn-outline-secondary");
                }
            }
        });


    }

    function showModalAddReview(item) {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_add_review.php",
            data: {
                review_type: 'course',
                item: item,
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_add_review").modal("toggle");
            }
        });
    }

    function showModalEditCourse() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_course.php",
            data: {
                id: <?= $course_id ?>,
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_course").modal("toggle");
            }
        });
    }

    function settingCourseStatus() {
        var status = $("[name=course_status]").text();
        if (status == "เปิดรับ") {
            var change = "ปิดรับ";
            var val = 0;
        } else {
            var change = "เปิดรับ";
            var val = 1;
        }

        Swal.fire({
            title: 'เปลี่ยนสถานะเป็น' + change + ' ?',
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
                    url: "ajax/action/edit_course_status.php",
                    data: {
                        id: <?= $course_id ?>,
                        status_val: val,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        Swal.fire({
                            icon: 'success',
                            title: 'เปลี่ยนสถานะเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (status == "เปิดรับ") {
                            $("#course_status").html('<span class="badge badge-pill badge-danger" name="course_status">ปิดรับ</span>');
                        } else {
                            $("#course_status").html('<span class="badge badge-pill badge-success" name="course_status">เปิดรับ</span>')
                        }
                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }

    function deleteCourse() {

        Swal.fire({
            title: 'คุณต้องการลบงานสอน ?',
            text: "ไม่สามารถแก้ไขได้ในภายหลัง",
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
                    url: "ajax/action/delete_course.php",
                    data: {
                        id: <?= $course_id ?>,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบงานสอนเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });

                       window.location.href = 'profile.php?username=' + username;

                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }
</script>