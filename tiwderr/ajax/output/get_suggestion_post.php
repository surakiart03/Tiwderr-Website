<?php
session_start();
$username = $_SESSION['username'];

$sort_by = $_POST['sort_by'];
$updown = $_POST['updown'];

include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");

$sql_attention = "SELECT * FROM `tbl_attention`
        WHERE `username` = '$username'";
$result_attention = mysqli_query($conn, $sql_attention);

$Wh = "";
if ($result_attention) {
    $row = mysqli_fetch_assoc($result_attention);
    $Wh = ($row['subject'] ? "`subject` in ('" . str_replace(",", "','", $row['subject']) . "')" : $Wh);
    $Wh = ($row['level'] ? ($Wh ? $Wh . " AND `level` in (" . $row['level'] . ")" : "`level` in (" . $row['level'] . ")") : $Wh);
    $Wh = ($row['purpose'] ? ($Wh ? $Wh . " AND `purpose` in (" . $row['purpose'] . ")" : "`purpose` in (" . $row['purpose'] . ")") : $Wh);
    $Wh = ($row['channel'] ? ($Wh ? $Wh . " AND (`channel` LIKE '%" . str_replace(",", "%' OR `channel` LIKE '%", $row['channel']) . "%')" : " (`channel` LIKE '%" . str_replace(",", "%' OR `channel` LIKE '%", $row['channel']) . "%')") : $Wh);
    $Wh = ($row['group_type'] ? ($Wh ? $Wh . " AND (`group_type` LIKE '%" . str_replace(",", "%' OR `group_type` LIKE '%", $row['group_type']) . "%')" : " (`group_type` LIKE '%" . str_replace(",", "%' OR `group_type` LIKE '%", $row['group_type']) . "%')") : $Wh);
    $Wh = ($row['gender'] ? ($Wh ? $Wh . " AND `gender` in ('" . str_replace(",", "','", $row['gender']) . "')" : "`gender` in ('" . str_replace(",", "','", $row['gender']) . "')") : $Wh);
}
// print_r($Wh);

$sql = "SELECT A.*, B.profile_name, B.profile_pic, B.gender FROM tbl_post A 
        LEFT JOIN tbl_user_info B ON A.create_by = B.username"
    . ($Wh ? " WHERE " . $Wh : "") . " ORDER BY $sort_by $updown";
$result = mysqli_query($conn, $sql);

// print_r($sql);

?>
<div class="container">
    <div class="row justify-content-center">
        <?php
        if (mysqli_num_rows($result) == 0) {
        ?>
            <div class="col-md-12 text-center">
                <div class="row p-0 m-0 justify-content-center">
                    <img src="assets/images/no_search.jpg" alt="image" width="500px" />
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <span class="h5 text-center">ดูเหมือนว่ายังไม่มีรายการใดตรงกับความสนใจของคุณ</span>
                    <span class="h5 text-center">ไปที่การค้นหาทั้งหมด</span>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-danger btn-pill btn-block mdi mdi-account-search-outline" type="button" onclick="window.location='tutor_finder.php'"> ค้นหาติวเตอร์</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-pill btn-block mdi mdi-table-search" type="button" onclick="window.location='announcement_post.php'"> ค้นหาประกาศ</button>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-12 text-center mb-3">
                <span class="h5 font-weight-light">- ค้นพบ <?= mysqli_num_rows($result) ?> รายการ -</span>
            </div>
            <?php
            foreach ($result as $row) {
            ?>

                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100 mb-3 shadow-sm raise-on-hover" onclick="gotoPostDetail(<?= $row['id'] ?>, '<?= $row['create_by'] ?>');">
                        <div class="card-header pb-0" style="background-color: #ffffff;">
                            <div class="row px-3">
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
                                <li class="list-group-item">
                                    <?php
                                    $card_txt_title = $row['title'];
                                    ?>
                                    <h5 class="card-title m-0 mouse-hover-italic" title="<?= $card_txt_title ?>">
                                        <?php
                                        if (utf8_strlen($card_txt_title) > 100) {
                                            echo mb_substr($card_txt_title, 0, 100, 'UTF-8') . "...";
                                        } else {
                                            echo $card_txt_title;
                                        }
                                        ?>
                                    </h5>
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
                                    <p class="m-0 text-primary"><span class="text-secondary">เป้าหมายการเรียน </span>
                                        <span class="">
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
                                        </span>
                                    </p>
                                    <p class="m-0 text-primary"><span class="text-secondary">ช่องทางการเรียน </span><span class=""><?= $row['channel'] ?></span></p>
                                    <p class="m-0 text-primary"><span class="text-secondary">ติวแบบ </span><span class=""><?= $row['group_type'] ?></span></p>
                                    <p class="m-0 text-primary"><span class="text-secondary">วันเรียน </span>
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
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer" style="background-color: #ffffff;">
                            <div class="d-flex flex-row justify-content-between">
                                <p class="m-0" style="text-align:right; ">
                                    <?php if ($row['post_status'] == 1) {
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
                                    <span class="text-secondary mr-1">ไม่เกิน</span><span class="text-dark h5 mr-1">฿<?= $row['price'] ?></span><span class="">/ชั่วโมง</span>
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

    function gotoPostDetail(id, student) {
        window.open('post_detail.php?student=' + student + '&post=' + id, '_blank');
    }
</script>