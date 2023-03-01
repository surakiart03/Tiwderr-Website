<?php
require_once("../../connection/connect_db.php");
session_start();

$post_id = $_POST['post_id'];
$offer_id = $_POST['offer_id'];

$sql_post = "SELECT * FROM `tbl_post`
        WHERE `id` = $post_id";
$result_post = mysqli_query($conn, $sql_post);

$sql_offer = "SELECT A.*, B.profile_name, B.profile_pic FROM `tbl_offer` A
        INNER JOIN `tbl_user_info` B
        ON A.create_by = B.username
        WHERE A.id = $offer_id AND A.post_id = $post_id";
$result_offer = mysqli_query($conn, $sql_offer);

if (mysqli_num_rows($result_offer) != 0) {
    while ($row = mysqli_fetch_assoc($result_offer)) {
        $post_id = $row['post_id'];
        $cf_subject = $row['cf_subject'];
        $rm_subject = $row['rm_subject'];
        $cf_level = $row['cf_level'];
        $rm_level = $row['rm_level'];
        $cf_purpose = $row['cf_purpose'];
        $rm_purpose = $row['rm_purpose'];
        $cf_price = $row['cf_price'];
        $rm_price = $row['rm_price'];
        $cf_channel = $row['cf_channel'];
        $rm_channel = $row['rm_channel'];
        $cf_gtype = $row['cf_group_type'];
        $rm_gtype = $row['rm_group_type'];
        $cf_day = $row['cf_day'];
        $rm_day = $row['rm_day'];
        $cf_time = $row['cf_time'];
        $rm_time = $row['rm_time'];
        $offer_descrip = $row['offer_descrip'];
        $create_by = $row['create_by'];
        $created_time = $row['created_time'];
        $profile_name = $row['profile_name'];
        $profile_pic = $row['profile_pic'];
    }
}
?>

<div class="modal fade" id="modal_offer_detail" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_offer_detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="mdi mdi-message-text m-0 mr-1" style="font-size: 1.25rem;"></i>การเสนอสอน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="mbd_offer_detail" class="modal-body" style="background-color:  #e0efff;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <div class="row pt-3 px-3 justify-content-end">
                        <span class="text-secondary"><?= $created_time ?></span>
                    </div>
                    <div class="row px-3 pb-1">
                        <div class="d-flex flex-column justify-content-center align-items-center hover-pointer" onclick="window.open('profile.php?username=<?= $create_by ?>', '_blank');">
                            <figure class="d-inline-block mr-3">
                                <img src="./assets/images/avatar/<?= $profile_pic ?>" alt="img" width="60rem" height="60rem" class="rounded-circle">
                            </figure>
                        </div>
                        <div class="d-flex flex-column hover-pointer" onclick="window.open('profile.php?username=<?= $create_by ?>', '_blank');">
                            <span class="card-head h5 p-0 m-0 mouse-hover"><?= $profile_name ?></span>
                            <span class="card-subhead text-secondary"><?= $create_by ?></span>
                        </div>
                    </div>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th width="20%">

                                </th>
                                <th width="30%">
                                    เงื่อนไขผู้เรียน
                                </th>
                                <th width="10%">
                                    การตกลง
                                </th>
                                <th width="50%">
                                    คำอธิบาย
                                </th>
                            </tr>
                        </thead>
                        <?php
                        if (mysqli_num_rows($result_post) != 0) {
                            while ($row = mysqli_fetch_assoc($result_post)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder">หมวดวิชา:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark"><?= $row['subject'] ?></span>
                                        </td>
                                        <td>

                                            <?= ($cf_subject == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_subject ? $rm_subject : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder">ระดับชั้น:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">
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
                                            </span>
                                        </td>
                                        <td>

                                            <?= ($cf_level == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_level ? $rm_level : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder">เป้าหมายการเรียน:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">
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
                                        </td>
                                        <td>

                                            <?= ($cf_purpose == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_purpose ? $rm_purpose : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder">ช่องทางการเรียน:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark"><?= $row['channel'] ?></span>
                                        </td>
                                        <td>

                                            <?= ($cf_channel == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_channel ? $rm_channel : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder">ติวแบบ:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark"><?= $row['group_type'] ?></span>
                                        </td>
                                        <td>

                                            <?= ($cf_gtype == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_gtype ? $rm_gtype : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder mr-3">วันที่ติว:</span>
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>

                                            <?= ($cf_day == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_day ? $rm_day : "-") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder mr-3">ช่วงเวลา:</span>
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>

                                            <?= ($cf_time == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_time ? $rm_time : "-") ?></span>
                                        </td>
                                        </re>
                                    <tr>
                                        <td>
                                            <span class="text-dark font-weight-bolder mr-3">ราคาต่อชั่วโมง:</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">ไม่เกิน <?= $row['price'] ?> บาท</span>
                                        </td>
                                        <td>

                                            <?= ($cf_price == "yes" ? "<span class='text-success'>ตกลง</span>" : "<span class='text-danger'>ไม่ตกลง</span>") ?>
                                        </td>
                                        <td>

                                            <span class="text-dark"><?= ($rm_price ? $rm_price : "-") ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                        <?php
                            }
                        }
                        ?>
                    </table>
                    <div class="row p-3 pb-1">
                        <span class="text-dark font-weight-bolder mr-3">รายละเอียดเพิ่มเติมจากติวเตอร์</span>
                    </div>
                    <div class="row px-3">
                        <?= ($offer_descrip ? $offer_descrip : "- ไม่มีรายละเอียดเพิ่มเติม -") ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });
</script>