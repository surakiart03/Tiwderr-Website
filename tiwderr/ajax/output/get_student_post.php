<?php
include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");

$Wh = ($_POST['username'] ? " WHERE A.create_by = '" . $_POST['username'] . "'" : "");
$sql = "SELECT A.*, B.profile_name, B.profile_pic FROM `tbl_post` A
        INNER JOIN `tbl_user_info` B
        ON A.create_by = B.username $Wh
        ORDER BY `created_time` DESC;";
$result = mysqli_query($conn, $sql);

?>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>ทั้งหมด <?= mysqli_num_rows($result) ?> ประกาศ</h5>
        </div>
    </div>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) != 0) {

            foreach ($result as $row) {
        ?>
                <div class="col-md-6 d-flex align-items-xl-stretch">
                    <div class="card w-100 mb-3 shadow-sm raise-on-hover" onclick="gotoPostDetail(<?= $row['id'] ?>, '<?= $row['create_by'] ?>');">
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