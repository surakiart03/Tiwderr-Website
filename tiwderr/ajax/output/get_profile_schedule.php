<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT * FROM `tbl_tutor_schedule` 
        WHERE `username` = '$username'
        ORDER BY `day`;";
$result = mysqli_query($conn, $sql);

$mon = array();
$tue = array();
$wed = array();
$thu = array();
$fri = array();
$sat = array();
$sun = array();

?>
<div class="card mt-3">
    <div class="card-body p-3">
        <?php

        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                //print_r($row);
                if ($row['day'] == "1-mon") {
                    $mon = $row['day'];
                } else if ($row['day'] == "2-tue") {
                    $tue = $row['day'];
                } else if ($row['day'] == "3-wed") {
                    $wed = $row['day'];
                } else if ($row['day'] == "4-thu") {
                    $thu = $row['day'];
                } else if ($row['day'] == "5-fri") {
                    $fri = $row['day'];
                } else if ($row['day'] == "6-sat") {
                    $sat = $row['day'];
                } else if ($row['day'] == "7-sun") {
                    $sun = $row['day'];
                }
            }
        }
        ?>
        <h6 class="text-primary">
            ตารางเวลา
        </h6>
        <p>คลิกวันเพื่อดูรายละเอียด</p>
        <div class="mt-3 mb-0 row justify-content-center px-3">
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $mon ? "#f12459" : "#cccccc" ?>; color: <?= $mon ? "#000000" : "#ffffff" ?>;" <?= $mon ? 'data-toggle="collapse" data-target="#scd_day1" aria-expanded="false" aria-controls="scd_day1"' : "" ?>>จ.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $tue ? "#f12459" : "#cccccc" ?>; color: <?= $tue ? "#000000" : "#ffffff" ?>;" <?= $tue ? 'data-toggle="collapse" data-target="#scd_day2" aria-expanded="false" aria-controls="scd_day2"' : "" ?>>อ.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $wed ? "#f12459" : "#cccccc" ?>; color: <?= $wed ? "#000000" : "#ffffff" ?>;" <?= $wed ? 'data-toggle="collapse" data-target="#scd_day3" aria-expanded="false" aria-controls="scd_day3"' : "" ?>>พ.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $thu ? "#f12459" : "#cccccc" ?>; color: <?= $thu ? "#000000" : "#ffffff" ?>;" <?= $thu ? 'data-toggle="collapse" data-target="#scd_day4" aria-expanded="false" aria-controls="scd_day4"' : "" ?>>พฤ.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $fri ? "#f12459" : "#cccccc" ?>; color: <?= $fri ? "#000000" : "#ffffff" ?>;" <?= $fri ? 'data-toggle="collapse" data-target="#scd_day5" aria-expanded="false" aria-controls="scd_day5"' : "" ?>>ศ.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $sat ? "#f12459" : "#cccccc" ?>; color: <?= $sat ? "#000000" : "#ffffff" ?>;" <?= $sat ? 'data-toggle="collapse" data-target="#scd_day6" aria-expanded="false" aria-controls="scd_day6"' : "" ?>>ส.</div>
            <div class="col text-center hover-pointer" style="border: 1px solid; border-color: white; background-color: <?= $sun ? "#f12459" : "#cccccc" ?>; color: <?= $sun ? "#000000" : "#ffffff" ?>;" <?= $sun ? 'data-toggle="collapse" data-target="#scd_day7" aria-expanded="false" aria-controls="scd_day7"' : "" ?>>อา.</div>
        </div>
        <?php
        if (mysqli_num_rows($result) != 0) {
            foreach ($result as $row) {
                $daynum = "";
                if ($row['day'] == "1-mon") {
                    $row['day'] = "จันทร์";
                    $daynum = "scd_day1";
                } else if ($row['day'] == "2-tue") {
                    $row['day'] = "อังคาร";
                    $daynum = "scd_day2";
                } else if ($row['day'] == "3-wed") {
                    $row['day'] = "พุธ";
                    $daynum = "scd_day3";
                } else if ($row['day'] == "4-thu") {
                    $row['day'] = "พฤหัสบดี";
                    $daynum = "scd_day4";
                } else if ($row['day'] == "5-fri") {
                    $row['day'] = "ศุกร์";
                    $daynum = "scd_day5";
                } else if ($row['day'] == "6-sat") {
                    $row['day'] = "เสาร์";
                    $daynum = "scd_day6";
                } else if ($row['day'] == "7-sun") {
                    $row['day'] = "อาทิตย์";
                    $daynum = "scd_day7";
                }
        ?>
                <div class="collapse mt-3 mb-0 row justify-content-start px-3" id="<?= $daynum ?>">
                    <span>วัน<?= $row['day'] ?></span>
                    <textarea class="form-control form-control-sm text-dark mr-3" rows="5" placeholder="" readonly style="background-color:#FFF !important;"><?= $row['detail'] ?></textarea>
                </div>
            <?php
            }
        }

        if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {
            ?>
            <p class="mt-3 mb-0 d-flex flex-row justify-content-center">
            <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-outline-primary" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalEditSchedule();"' : 'onclick="alertApprove();"') ?>>แก้ไขตารางเวลา</button>
            </p>
        <?php
        }
        ?>
    </div>
</div>
<script>
    function showModalEditSchedule() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_schedule.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_schedule").modal("toggle");
            }
        });
    }
</script>