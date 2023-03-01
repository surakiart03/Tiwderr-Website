<?php
include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");
if (isset($_POST['check']) && $_POST['check'] != "No") {
    // echo "Check if 0 : " . $_POST['check'];
    
    $filterData = [
        'subject' => $_POST['subject'],
        'level' => $_POST['level'],
        'purpose' => $_POST['purpose'],
        'min_range' => $_POST['min_range'],
        'max_range' => $_POST['max_range'],
        'channel' => $_POST['channel'],
        'gtype' => $_POST['gtype'],
        'gender' => $_POST['gender'],
        'day' => $_POST['day'],
        'rate' => $_POST['rate'],
        'range' => $_POST['range'],
        'check_range' => $_POST['check_range'],
        'lat_U' => $_POST['lat_U'],
        'lon_U' => $_POST['lon_U'],
        'search_ads' => $_POST['search_ads']
    ];

    foreach ($filterData as &$i) {
        if ($i === '') {
            $i = '%';
        }
    }

    if (count($filterData['channel']) == 1 && $filterData['channel'][0] == "ออนไลน์") {
        $filterData['channel'][0] = "ออนไลน์%";
    } else if (count($filterData['channel']) == 1 && $filterData['channel'][0] == "ตัวต่อตัว") {
        $filterData['channel'][0] = "%ตัวต่อตัว";
    }
    $filterData['channel'] = implode("%' OR channel LIKE '%", $filterData['channel']);
    $filterData['gender'] = implode("%' OR gender LIKE '%", $filterData['gender']);

    if (count($filterData['day']) == 1 && $filterData['day'][0] == "mon") {
        $filterData['day'][0] = "mon%";
    } else if (count($filterData['day']) == 1 && $filterData['day'][0] == "sun") {
        $filterData['day'][0] = "%sun";
    } else if (count($filterData['day']) == 1 && $filterData['day'][0] != "mon" && $filterData['day'][0] != "sun") {
        $filterData['day'][0] = "%" . $filterData['day'][0] . "%";
    }
    $filterData['day'] = implode("%' OR day LIKE '%", $filterData['day']);

    if ($filterData['search_ads'] != "%") {
        $wh3 = " c.username LIKE '%$filterData[search_ads]%' OR a.title LIKE '%$filterData[search_ads]%' OR b.profile_name LIKE '%$filterData[search_ads]%'";
        if ($filterData['min_range'] == 0 && $filterData['max_range'] == 0) {
            $wh2 = "AND price BETWEEN '0' AND '9999999'";
        } else {
            $wh2 = "AND price BETWEEN '$filterData[min_range]' AND '$filterData[max_range]'";
        }
    } else {
        $wh3 = "";
        if ($filterData['min_range'] == 0 && $filterData['max_range'] == 0) {
            $wh2 = " price BETWEEN '0' AND '9999999'";
        } else {
            $wh2 = " price BETWEEN '$filterData[min_range]' AND '$filterData[max_range]'";
        }
    }

    if ($filterData['rate'] != 0) {
        $wh1 = "AND sum_score/total_review >= '$filterData[rate]'";
    } else {
        $wh1 = "";
    }

    if ($filterData['check_range'] == "true") {
        $wh = "AND (((acos(sin(('$filterData[lat_U]' * pi() / 180)) * sin((c.t_lattitude * pi() / 180)) + cos(('$filterData[lat_U]' * pi() / 180)) * cos((c.t_lattitude * pi() / 180)) * cos((('$filterData[lon_U]' - c.t_longitude) * pi() / 180)))) * 180 / pi()) * 60 * 1.1515 * 1.609344) <= '$filterData[range]'";
    } else {
        $wh = "";
    }


    if ($filterData['day'] != '%') {
        $aw1 = "AND day LIKE '$filterData[day]'";
    } else {
        $aw1 = "";
    }

    if ($filterData['gtype'] != '%') {
        $aw2 = "AND group_type LIKE '$filterData[gtype]'";
    } else {
        $aw2 = "";
    }

    if ($filterData['gender'] != '%') {
        $aw3 = "AND gender LIKE '$filterData[gender]'";
    } else {
        $aw3 = "";
    }

    if ($filterData['channel'] != '%') {
        $aw4 = "AND channel LIKE '$filterData[channel]'";
    } else {
        $aw4 = "";
    }

    if ($filterData['subject'] != '%') {
        $aw5 = "AND subject LIKE '$filterData[subject]'";
    } else {
        $aw5 = "";
    }

    if ($filterData['level'] != '%') {
        $aw6 = "AND level LIKE '$filterData[level]'";
    } else {
        $aw6 = "";
    }

    if ($filterData['purpose'] != '%') {
        $aw7 = "AND purpose LIKE '$filterData[purpose]'";
    } else {
        $aw7 = "";
    }


    $sql = "SELECT a.*, b.profile_name, b.profile_pic, c.username , d.sum_score, d.total_review, c.t_lattitude, c.t_longitude  FROM tbl_course a 
        LEFT JOIN tbl_user_info b ON a.create_by = b.username 
        LEFT JOIN tbl_location c ON b.username = c.username 
        LEFT JOIN (SELECT course, SUM(score) AS sum_score, COUNT(course) as total_review 
        FROM tbl_review_course GROUP BY course) d ON a.create_by = b.username AND d.course = a.id AND a.id = d.course
        WHERE 
        $wh3
        $wh2
        $wh1
        $wh
        $aw1
        $aw2
        $aw3
        $aw4
        $aw5
        $aw6
        $aw7
        ORDER BY created_time DESC;";
    $result = mysqli_query($conn, $sql);
} else if (!isset($_POST['search'])) {
    // echo "No key:check, No key:search";
    $sql = "SELECT a.*, b.profile_name, b.profile_pic, c.username , d.sum_score, d.total_review, c.t_lattitude, c.t_longitude FROM tbl_course a 
        LEFT JOIN tbl_user_info b ON a.create_by = b.username 
        LEFT JOIN tbl_location c ON b.username = c.username 
        LEFT JOIN (SELECT course, SUM(score) AS sum_score, COUNT(course) as total_review 
        FROM tbl_review_course GROUP BY course) d ON a.create_by = b.username AND d.course = a.id AND a.id = d.course
        ORDER BY a.created_time DESC;";
    $result = mysqli_query($conn, $sql);
}

if (isset($_POST['search']) && $_POST['check'] == "No") {
    // echo "Check if 2 : " . $_POST['check'];
    $sort = $_POST['sort'];
    $ud = $_POST['updown'];
    if ($sort == '0') {
        $sort = ' a.created_time ';
    } else if ($sort == '1') {
        $sort = ' a.price ';
    } else {
        $sort = ' sum_score/total_review ';
    }
    // echo $ud;
    $sql = "SELECT a.*, b.profile_name, b.profile_pic, c.username, d.sum_score, d.total_review, c.t_lattitude, c.t_longitude 
    FROM tbl_course a
        LEFT JOIN tbl_user_info b ON a.create_by = b.username 
        LEFT JOIN tbl_location c ON b.username = c.username 
        LEFT JOIN (
            SELECT course, SUM(score) AS sum_score, COUNT(course) AS total_review 
            FROM tbl_review_course 
            GROUP BY course
        ) d ON a.create_by = b.username AND d.course = a.id 
    WHERE a.create_by LIKE '%$_POST[search_some]%' OR a.title LIKE '%$_POST[search_some]%' OR b.profile_name LIKE '%$_POST[search_some]%'
    ORDER BY $sort $ud;";

    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
    }
}
?>
<div class="container">
    <div class="row">
        <?php
        $result = mysqli_query($conn, $sql);
        // if (!$result || mysqli_num_rows($result) != 0) {
        if (mysqli_num_rows($result) == 0) {
		// echo "In";
        ?>
            <div class="col-md-12 text-center">
                <span class="font-weight-light" style="font-size: 2rem;">- ไม่พบรายการ -</span>
            </div>
            <?php
        } else {
            foreach ($result as $row) {
            ?>
                <div class="col-sm-6 col-md-6 col-lg-4 d-flex align-items-xl-stretch">
                    <div class="card w-100 mb-3 shadow-sm raise-on-hover" onclick="gotoCourseDetail(<?= $row['id'] ?>, '<?= $row['create_by'] ?>');">
                        <div class="card-header pb-0" style="background-color: #ffffff;">
                            <div class="row px-3" class="">
                                <div class="d-flex flex-column justify-content-center align-items-center hover-pointer" onclick="(window.location.href='profile.php?username=<?= $row['create_by'] ?>')">
                                    <figure class="d-inline-block mr-3">
                                        <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                                    </figure>
                                </div>
                                <div class="d-flex flex-column hover-pointer" onclick="(window.location.href='profile.php?username=<?= $row['create_by'] ?>')">
                                    <span class="card-head h6 p-0 m-0 mouse-hover"><?= $row['profile_name'] ?></span>
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
        window.open('course_detail.php?tutor=' + tutor + '&course=' + id, '_blank');
    }
</script>