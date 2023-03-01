<?php
include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");
session_start();

$username = $_SESSION['username'];

function get_time_ago($time)
{
    // $time = "2023-02-05 18:37:18";
     date_default_timezone_set("Asia/Bangkok");
    $time_difference = time() - $time;

    // if ($time_difference < 1) {
    //     // return 'เมื่อสักครู่';
    //     return time() . " " . $time . " " . $time_difference;
    // }

    $condition = array(
        12 * 30 * 24 * 60 * 60 =>  'ปี',
        30 * 24 * 60 * 60       =>  'เดือน',
        24 * 60 * 60            =>  'วัน',
        60 * 60                 =>  'ชั่วโมง',
        60                      =>  'นาที',
        1                       =>  'วินาที',
        -3600                   => 'วินาที'
    );

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return $time . " " . $t . ' ' . $str . 'ที่แล้ว';
        }
    }
}

function timeago($oldTime)
{
    date_default_timezone_set("Asia/Bangkok");
    $timeCalc = time() - strtotime($oldTime);
    if ($timeCalc >= (60 * 60 * 24 * 30 * 12 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " years ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 12)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " year ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " months ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " month ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24) . " days ago";
    } else if ($timeCalc >= (60 * 60 * 24)) {
        $timeCalc = " Yesterday";
    } else if ($timeCalc >= (60 * 60 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " hours ago";
    } else if ($timeCalc >= (60 * 60)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " hour ago";
    } else if ($timeCalc >= 60 * 2) {
        $timeCalc = intval($timeCalc / 60) . " minutes ago";
    } else if ($timeCalc >= 60) {
        $timeCalc = intval($timeCalc / 60) . " minute ago";
    } else if ($timeCalc > 0) {
        $timeCalc .= " seconds ago";
    }
    return $timeCalc;
}

$sql = "(SELECT
        'review_student' AS type
        ,review.id AS row_id
        ,review.student AS src
        ,'-' AS title
        ,review.student AS noti_to
        ,review.create_by AS noti_from
        ,user.profile_pic
        ,review.created_time
        ,review.is_read
        FROM tbl_review_student AS review
        INNER JOIN tbl_user_info AS user
        ON review.create_by = user.username
        WHERE review.student = '$username' AND review.is_read != 2)
        UNION
        (SELECT
        'review_course' AS type
        ,review.id AS row_id
        ,review.course AS src
        ,course.title AS title
        ,course.create_by AS noti_to
        ,review.create_by AS noti_from
        ,user.profile_pic
        ,review.created_time
        ,review.is_read
        FROM tbl_review_course AS review
        INNER JOIN tbl_course AS course
        ON review.course = course.id
        INNER JOIN tbl_user_info AS user
        ON review.create_by = user.username
        WHERE course.create_by = '$username'  AND review.is_read != 2)
        UNION
        (SELECT
        'offer' AS type
        ,offer.id AS row_id
        ,offer.post_id AS src
        ,post.title AS title
        ,post.create_by AS noti_to
        ,offer.create_by AS noti_from
        ,user.profile_pic
        ,offer.created_time
        ,offer.is_read
        FROM tbl_offer AS offer
        JOIN tbl_post AS post
        ON offer.post_id = post.id
        JOIN tbl_user_info AS user
        ON user.username = offer.create_by
        WHERE post.create_by = '$username'  AND offer.is_read != 2)
        UNION
        (SELECT
        'offer_reply' AS type
        ,reply.id AS row_id
        ,reply.post_id AS src
        ,post.title AS title
        ,CASE WHEN offer.create_by != reply.create_by THEN offer.create_by ELSE post.create_by END AS noti_to
        ,reply.create_by AS noti_from
        ,user.profile_pic
        ,reply.created_time
        ,reply.is_read
        FROM tbl_offer_reply AS reply
        INNER JOIN tbl_offer AS offer
        ON reply.offer_id = offer.id
        INNER JOIN tbl_post AS post
        ON offer.post_id = post.id
        INNER JOIN tbl_user_info AS user
        ON reply.create_by = user.username
        WHERE (CASE WHEN offer.create_by != reply.create_by THEN offer.create_by = '$username' ELSE post.create_by = '$username' END)
        AND reply.is_read != 2)
        ORDER BY created_time DESC
        ";
// print_r($sql);
$result = mysqli_query($conn, $sql);
// $result_no_read = mysqli_query($conn, $sql . " AND is_read = 0");

// if (mysqli_num_rows($result_no_read) != 0) {
//     foreach ($result_no_read as $row) {
//         $last_noti = $row['created_time'];
//     }
// }
$no_read = 0;
if (mysqli_num_rows($result) != 0) {
    foreach ($result as $row) {
        $no_read += ($row['is_read'] == 0 ? 1 : 0);
        $noti_from = $row['noti_from'];
        if ($row['type'] == "offer_reply") {
            $type = " ได้ตอบกลับข้อเสนอใน: ";
        } else if ($row['type'] == "offer") {
            $type = " ได้เสนอสอนใน: ";
        } else if ($row['type'] == "review_course") {
            $type = " ได้รีวิวงานสอนของคุณใน: ";
        } else if ($row['type'] == "review_student") {
            $type = " ได้เขียนรีวิวถึงคุณ: ";
        }
        $title = ($row['title'] != "-" ? $row['title'] : "");
        // $txt = $noti_from  . $type . $title;

        if (utf8_strlen($title) > 50) {
            $title = mb_substr($title, 0, 50, 'UTF-8') . "...";
        }

        if ($row['is_read'] == 0) {
            $txt = "<b>$noti_from</b>" . $type . "<b>" . $title . "</b>";
        } else {
            $txt = $noti_from . $type . $title;
        }

?>
        <!-- <a href="" class=""> -->
        <div class="row px-3 py-1 mouse-hover-bg" onclick="setReadNoti('<?= $row['type'] ?>', '<?= $row['row_id'] ?>', '<?= $row['src'] ?>', '<?= $row['noti_to'] ?>');">
            <div class="col-2 p-0 justify-content-center align-items-center">

                <figure class="d-inline-block mr-3">
                    <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                </figure>
            </div>
            <div class="col-9 p-0">
                <span class="p-0 m-0 text-dark"><?= $txt ?></span><br />
                <span class="p-0 m-0 <?= $row['is_read'] == 0 ? "text-primary font-weight-bolder" : "text-secondary" ?>"><?= timeago($row['created_time']) ?></span>
            </div>
            <div class="col-1 p-0">
                <?= $row['is_read'] == 0 ? '<i class="mdi mdi-circle text-primary" style="font-size: 0.75rem;"></i>' : '' ?>
            </div>
        </div>
        <!-- </a> -->
    <?php
    }
} else {
    ?>
    <div class="d-flex flex-row justify-content-center my-3">
        <h6 class="text-secondary">คุณไม่มีการแจ้งเตือน</h6>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {

        var noti_badge = $("#num_noti").text();
        if (noti_badge == "") {
            num_noti_badge = 0;
        } else {
            num_noti_badge = parseInt(noti_badge);
        }

        var num_noti = <?= $no_read ?>;

        // console.log('noti_badge: ' + noti_badge);
        // console.log('num_noti: ' + num_noti);

        if (num_noti == 0) {
            $("#num_noti").text("");
        } else {
            $("#num_noti").text(num_noti);
            if (num_noti > num_noti_badge && noti_badge != "") {
                playNoti();
            }

        }

    });
</script>