<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$role = $_POST['role'];

$sql_user = "SELECT A.*, B.location FROM `tbl_user_info` A
            LEFT JOIN `tbl_location` B
            ON A.username = B.username
            WHERE A.username = '$username'
            ";
$result_user = mysqli_query($conn, $sql_user);

if (mysqli_num_rows($result_user) != 0) {
    foreach ($result_user as $row) {
        $profile_name = $row['profile_name'];
        $profile_pic = $row['profile_pic'];
        $profile_cover = $row['profile_cover'];
        $bio = $row['bio'];
        $gender = $row['gender'];
        $location = $row['location'];
    }
}

if ($role === "tutor") {
    $sql_rating = "SELECT SUM(A.score) AS sum_score, COUNT(course) AS total_review 
                    FROM `tbl_review_course` A 
                    INNER JOIN `tbl_course` B 
                    ON A.course = B.id 
                    WHERE B.create_by = '$username'";

    $sql_post = "SELECT COUNT(id) AS num_of_post FROM `tbl_course` WHERE `create_by` = '$username';";
} else {
    $sql_rating = "SELECT SUM(score) AS sum_score, COUNT(student) AS total_review 
                    FROM `tbl_review_student`
                    WHERE student = '$username'";

    $sql_post = "SELECT COUNT(id) AS num_of_post FROM `tbl_post` WHERE `create_by` = '$username';";
}

$result_rating = mysqli_query($conn, $sql_rating);
$result_post = mysqli_query($conn, $sql_post);

$rating = 0;
$total_review = 0;
if (mysqli_num_rows($result_rating) != 0) {
    foreach ($result_rating as $row) {
        $sum_score = $row['sum_score'];
        $total_review = $row['total_review'];
    }
    if ($total_review != 0) {
        $rating = round($sum_score / $total_review, 1);
    }
}

$num_post = 0;
if (mysqli_num_rows($result_post) != 0) {
    foreach ($result_post as $row) {
        $num_post = $row['num_of_post'];
    }
}
?>
<div class="card card-profile">
    <img src="./assets/images/cover_profile/<?= $profile_cover ?>" height="150px" alt="image cover" class="card-img-top">
    <div class="row justify-content-center">
        <div class="col-4 col-lg-4 order-lg-2">
            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                <a href="javascript:;">
                    <img src="./assets/images/avatar/<?= $profile_pic ?>" alt="image profile" height="200px" height="200px" class="rounded-circle img-fluid border border-2 border-white">
                </a>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="text-center">
            <h5 class="mb-0">
                <?= $profile_name ?>
                <?php
                if ($gender == 'ไม่ระบุ') {
                   echo '<span class="mx-1 text-secondary" style="font-size:1.5rem;">?</span>';
                } else if ($gender == 'ชาย') {
                    echo '<i class="mx-1 mdi mdi-gender-male text-primary" style="font-size:1.5rem;"></i>';
                } else if ($gender == 'หญิง') {
                    echo '<i class="mx-1 mdi mdi-gender-female text-danger" style="font-size:1.5rem;"></i>';
                } else if ($gender == 'lgbtq+') {
                     echo '<i class="mx-1 mdi mdi-gender-transgender text-info" style="font-size:1.5rem;"></i>';
                } else {
                    echo '-';
                }
                ?>
            </h5>
            <h6 class="font-weight-light text-secondary">
                <?= $username ?>
            </h6>

            <p><?= $bio ?>
            </p>
            <?php
            if ($location != "") {
                echo '<p><i class="mdi mdi-map-marker mr-2"></i>' . $location . '</p>';
            }
            ?>
            <div class="d-flex flex-row justify-content-between px-5 mb-3">
                <div class="d-flex flex-column"><span>
                        <h5 class="m-0"><?= $rating ?>/5</h5>คะแนน
                    </span>
                </div>
                <div class="d-flex flex-column"><span>
                        <h5 class="m-0"><?= $total_review ?></h5>รีวิว
                    </span>
                </div>
                <div class="d-flex flex-column"><span>
                        <h5 class="m-0"><?= $num_post ?></h5><?= $role === "tutor" ? "งานสอน" : "ประกาศ" ?>
                    </span>
                </div>
            </div>
            <?php
            if (isset($_SESSION['username']) && $username === $_SESSION['username']) {
            ?>
                <button class="btn btn-outline-primary btn-sm" style="width:100%;" onclick="showModalEditProfile();">แก้ไขโปรไฟล์</button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });

    function showModalEditProfile() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_profile.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_profile").modal("toggle");
            }
        });
    }
</script>