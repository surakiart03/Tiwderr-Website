<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT * FROM `tbl_tutor_award` 
        WHERE `username` = '$username';";
$result = mysqli_query($conn, $sql);
?>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">ผลงานหรือรางวัลที่เคยได้รับ</h6>
    </div>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-1">
                <i class="mdi mdi-trophy-award"></i>
            </div>
            <div class="col-md-11">
                <span><b><?= $row['title'] ?></b></span><br />
                <span class="text-secondary"><?= $row['org'] ? "โดย " . $row['org'] : "" ?></span>
                <p><?= $row['detail'] ? $row['detail'] : "" ?></p>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="col-md-12">
            ไม่มีข้อมูลผลงานหรือรางวัล
        </div>
    <?php
    }
    ?>
</div>