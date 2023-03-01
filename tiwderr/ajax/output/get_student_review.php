<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql_rating = "SELECT SUM(score) AS sum_score, COUNT(student) AS total_review 
                    FROM `tbl_review_student`
                    WHERE `student` = '$username'";

$result_rating = mysqli_query($conn, $sql_rating);

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
?>
<div class="container p-10">
    <div class="row">
        <div class="col-3">
            <span class="text-warning h1"><?= $rating ?>/5</span>
            <p><span class="text-secondary">จาก <?= $total_review ?> รีวิว</span></p>
        </div>
        <?php
        $sql_review = "SELECT score
                , COUNT(*) AS `num` 
                FROM `tbl_review_student`
                WHERE `student` = '$username'
                GROUP BY score";
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

        <div class="col-9">
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
        if ($_SESSION['role'] == "tutor") {
        ?>
            <div class="col-12">
                <button class="btn btn-primary btn-sm" onclick="showModalAddReview('<?= $username ?>');"><i class="mr-1 mdi mdi-pencil"></i>เขียนรีวิวของคุณ</button>
            </div>
        <?php
        }
        ?>
        <div class="col-12 mt-3 p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-4 col-sm-2">
                    <div class="button-radio" onclick="selectScore(0);">
                        <input type="radio" class="btn-check" name="star_options" id="star_all" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary btn-sm" for="star_all">ทั้งหมด</label>
                    </div>
                </div>
                <div class="col-4 col-sm-2">
                    <div class="button-radio" onclick="selectScore(5);">
                        <input type="radio" class="btn-check" name="star_options" id="star_5" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="star_5">5 ดาว</label>
                    </div>
                </div>
                <div class="col-4 col-sm-2">
                    <div class="button-radio" onclick="selectScore(4);">
                        <input type="radio" class="btn-check" name="star_options" id="star_4" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="star_4">4 ดาว</label>
                    </div>
                </div>
                <div class="col-4 col-sm-2">
                    <div class="button-radio" onclick="selectScore(3);">
                        <input type="radio" class="btn-check" name="star_options" id="star_3" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="star_3">3 ดาว</label>
                    </div>
                </div>
                <div class="col-4 col-sm-2">
                    <div class="button-radio" onclick="selectScore(2);">
                        <input type="radio" class="btn-check" name="star_options" id="star_2" autocomplete="off">
                        <label class="btn btn-outline-secondary btn-sm" for="star_2">2 ดาว</label>
                    </div>
                </div>
                <div class="col-4 col-sm-2">
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
<script>
    var score = 0;

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
            url: "ajax/output/get_review_list_student.php",
            data: {
                student: '<?= $username ?>',
                score: score,
            },
            success: function(response) {
                $("#forReviewList").html(response);
            }
        });
    }

    function showModalAddReview(item) {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_add_review.php",
            data: {
                review_type: 'student',
                item: item,
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_add_review").modal("toggle");
            }
        });
    }
</script>