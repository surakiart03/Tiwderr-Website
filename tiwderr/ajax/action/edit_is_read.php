<?php
require_once("../../connection/connect_db.php");

session_start();

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$type = $_POST['type'];
$row_id = $_POST['row_id'];
$src = $_POST['src'];
$owner = $_POST['owner'];
$status = $_POST['status'];
$option = $_POST['option'];

// update for sudent
$std_review_student = "UPDATE `tbl_review_student`
                SET `is_read` = $status
                WHERE `student` = '$username'" . ($status == 1 ? " AND `is_read` = 0" : "")  . ($status == 2 ? " AND `is_read` = 1" : "");

$std_offer = "UPDATE `tbl_offer` AS offer
                        INNER JOIN `tbl_post` AS post
                        ON offer.post_id = post.id
                    SET
                        offer.is_read = $status
                    WHERE post.create_by = '$username'" . ($status == 1 ? " AND offer.is_read = 0" : "") . ($status == 2 ? " AND offer.is_read = 1" : "");

$std_offer_reply = "UPDATE `tbl_offer_reply` AS reply
                        INNER JOIN `tbl_offer` AS offer
                        ON reply.offer_id = offer.id
                        INNER JOIN `tbl_post` AS post
                        ON offer.post_id = post.id
                    SET
                        reply.is_read = $status
                    WHERE post.create_by = '$username' AND reply.create_by != '$username'" . ($status == 1 ? " AND reply.is_read = 0" : "") . ($status == 2 ? " AND reply.is_read = 1" : "");

$sql_std = array($std_review_student, $std_offer, $std_offer_reply);

// update for tutor
$tutor_review_course = "UPDATE `tbl_review_course` AS review
                    INNER JOIN `tbl_course` AS course
                    ON review.course = course.id
                SET
                    review.is_read = $status
                WHERE course.create_by = '$username'" . ($status == 1 ? " AND review.is_read = 0" : "") . ($status == 2 ? " AND review.is_read = 1" : "");

$tutor_offer_reply = "UPDATE `tbl_offer_reply` AS reply
                        INNER JOIN `tbl_offer` AS offer
                        ON reply.offer_id = offer.id
                    SET
                        reply.is_read = $status
                    WHERE offer.create_by = '$username' AND reply.create_by != '$username'" . ($status == 1 ? " AND reply.is_read = 0" : "") . ($status == 2 ? " AND reply.is_read = 1" : "");

$sql_tutor = array($tutor_review_course, $tutor_offer_reply);

if ($option == "all") {
    if ($role == "student") {
        foreach ($sql_std as $sql) {
            $result = mysqli_query($conn, $sql);
        }
    } else {
        foreach ($sql_tutor as $sql) {
            $result = mysqli_query($conn, $sql);
        }
    }

    if ($result) {
        echo "Update tbl_course success ^-^";
    } else {
        echo "Update row in tbl_post failed T^T";
    }

} else {
    if ($role == "student") {
        if ($type == "review_student") {
            $sql = $std_review_student . " AND `id` = $row_id";
            $result = mysqli_query($conn, $sql);
            $page = "profile.php?username=" . $username;
        } else if ($type == "offer") {
            $sql = $std_offer . " AND offer.id = $row_id";
            $result = mysqli_query($conn, $sql);
            $page = "post_detail.php?post=" . $src . "&student=" . $username ;
        } else if ($type == "offer_reply") {
            $sql = $std_offer_reply . " AND reply.id = $row_id";
            $result = mysqli_query($conn, $sql);
            $page = "post_detail.php?post=" . $src . "&student=" . $username ;
        }
    } else {
        if ($type == "review_course") {
            $sql = $tutor_review_course . " AND review.id = $row_id";
            $result = mysqli_query($conn, $sql);
            $page = "course_detail.php?course=" . $src . "&tutor=" . $username;
        } else if ($type == "offer_reply") {
            $sql = $tutor_offer_reply . " AND reply.id = $row_id";
            $result = mysqli_query($conn, $sql);
            $page = "post_detail.php?post=" . $src . "&student=" . $owner;
        }
    }

    if ($result) {
        echo $page;
    } else {
        echo "Update row in tbl_post failed T^T\n" . $sql;
    }
}
