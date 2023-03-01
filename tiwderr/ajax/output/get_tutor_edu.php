<?php
session_start();


require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT * FROM `tbl_tutor_edu` 
        WHERE `username` = '$username';";
$result = mysqli_query($conn, $sql);
?>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">ประวัติการศึกษา</h6>
    </div>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <?php
        foreach ($result as $row) {
        ?>
            <div class="col-1">
                <i class="mdi mdi-school"></i>
            </div>
            <div class="col-2 p-0 m-0">
                <span><?= $row['level'] ?></span>
            </div>
            <div class="col-7">
                <span><b><?= $row['institute'] ?></b></span><br />
                <span class="text-dark"><?= $row['fac_maj'] ? $row['fac_maj'] . "<br />" : "" ?></span>
                <span class="text-dark"><?= $row['diploma'] ? $row['diploma'] . "<br />" : "" ?></span>
                <span class="text-dark"><?= $row['gpax'] && $row['gpax'] != "0.00" ? "เกรดเฉลี่ย " . $row['gpax'] . "<br />" : "" ?></span>
                <span class="text-secondary"><?= $row['period_year'] ? "ช่วงปีที่ศึกษา " . $row['period_year'] : "" ?></span>
            </div>
            <div class="col-2 p-0 m-0">
                <span><em><?= $row['edu_stat'] ?></em></span>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="col-md-12 pb-0">
            ไม่มีข้อมูลประวัติการศึกษา
        </div>
    <?php
    }
    ?>
    <hr />
</div>