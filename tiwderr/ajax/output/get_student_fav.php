<?php
session_start();

include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");

$username = $_POST['username'];

$sql = "SELECT A.*, B.*, C.profile_name, C.profile_pic FROM `tbl_like_course` A
            INNER JOIN `tbl_course` B
            ON A.course_id = B.id
            INNER JOIN `tbl_user_info` C
            ON B.create_by = C.username
        WHERE A.username = '$username'
        ORDER BY A.created_time DESC;";
$result = mysqli_query($conn, $sql);
// print_r($sql);
?>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>ทั้งหมด <?= mysqli_num_rows($result) ?> ถูกใจ</h5>
        </div>
    </div>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) != 0) {

            foreach ($result as $row) {
        ?>
                <div class="col-md-6 d-flex align-items-xl-stretch">
                    <div class="card w-100  mb-3 shadow-sm raise-on-hover" onclick="gotoCourseDetail(<?= $row['course_id'] ?>, '<?= $row['create_by'] ?>');">
                        <div class="card-header pb-0" style="background-color: #ffffff;">
                            <div class="row px-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <figure class="d-inline-block mr-3">
                                        <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                                    </figure>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="card-head h6 p-0 m-0"><?= $row['profile_name'] ?></span>
                                    <span class="card-subhead text-secondary"><?= $row['create_by'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body m-0 p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0">
                                    <img class="card-img-top" src="assets/images/cover_course/<?= $row['cover'] ?>" alt="Card image cap">
                                </li>
                                <li class="list-group-item">
                                    <?php
                                    $card_txt_title = $row['title'];
                                    ?>
                                    <h5 class="card-title m-0 mouse-hover-italic" title="<?= $card_txt_title ?>">
                                        <?php
                                        if (utf8_strlen($card_txt_title) > 100) {
                                            echo mb_substr($card_txt_title, 0, 30, 'UTF-8') . "...";
                                        } else {
                                            echo $card_txt_title;
                                        }
                                        ?>
                                    </h5>
                                    <?php

                                    $sql_rating = "SELECT SUM(`score`) AS sum_score, COUNT(`course`) as total_review FROM `tbl_review_course` WHERE `course` = $row[id]";
                                    $result_rating = mysqli_query($conn, $sql_rating);

                                    $rating = 0;
                                    if (mysqli_num_rows($result_rating) != 0) {
                                        foreach ($result_rating as $row_rating) {
                                            $sum_score = $row_rating['sum_score'];
                                            $total_review = $row_rating['total_review'];
                                        }
                                        if ($total_review != 0) {
                                            $rating = round($sum_score / $total_review, 1);
                                        }
                                    }
                                    ?>
                                    <p class="m-0 text-warning "><span class="font-weight-bolder"><?= $rating ?>/5 </span>
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
                                    <p class="m-0 text-primary"><span class="text-secondary">หมวดวิชา </span><span class=""><?= $row['subject'] ?></span></p>
                                    <p class="m-0 text-primary"><span class="text-secondary">ระดับชั้น </span><span class="">
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

                                        </span></p>
                                    <p class="card-text m-0">
                                        <?php
                                        $card_txt_desc = $row['intro'];
                                        if (utf8_strlen($card_txt_desc) > 100) {
                                            echo mb_substr($card_txt_desc, 0, 100, 'UTF-8') . "...";
                                        } else {
                                            echo $card_txt_desc;
                                        }
                                        ?>
                                    </p>
                                </li>

                            </ul>
                        </div>
                        <div class="card-footer" style="background-color: #ffffff;">
                            <div class="d-flex flex-row justify-content-between">
                                <p class="m-0" style="text-align:right; ">
                                    <?php if ($row['course_status'] == 1) {
                                    ?>
                                        <span class="badge badge-pill badge-success">เปิดรับ</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-pill badge-danger">ปิดรับ</span>
                                    <?php
                                    }
                                    ?>
                                </p>
                                <p class="m-0" style="text-align:right; ">
                                    <span class="text-dark h5 mr-1">฿<?= $row['price'] ?></span><span class="">/ชั่วโมง</span>
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-outline-danger btn-sm" style="width:100%;" onclick="removeFav(<?= $row['course_id'] ?>);">เลิกถูกใจ</button>

                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {});

    function gotoCourseDetail(id, tutor) {
        window.location.href = 'course_detail.php?tutor=' + tutor + '&course=' + id;
    }

    function removeFav(item) {
        $.ajax({
            type: "POST",
            url: "ajax/action/delete_like_course.php",
            data: {
                course_id: item,
                username: "<?= $_SESSION['username'] ?>"
            },
            success: function(response) {
                console.log('res: ' + response);
                showMyFav();
            }
        });
    }
</script>