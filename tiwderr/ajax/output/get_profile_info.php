<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT DATE_FORMAT(A.created_time, '%Y-%m-%d') AS created_time, A.is_verified, A.is_approved, B.coppied_id
        FROM `tbl_user` A INNER JOIN `tbl_user_info` B ON A.username = B.username
        WHERE A.username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);
    $created_time = $row['created_time'];
    $email = $row['is_verified'];
    $idcard = $row['is_approved'];
    $coppied = $row['coppied_id'];
}
?>
<div class="card mt-3">
    <div class="card-body p-3">
        <h6 class="text-primary">
            ข้อมูลเบื้องต้น
        </h6>
        <p class="mb-0 d-flex flex-row justify-content-between">
            <span>เข้าร่วมเมื่อ</span>
            <span><?= $created_time ? $created_time : "-" ?></span>
        </p>
        <!-- <p class="mb-0 d-flex flex-row justify-content-between">
            <span>จำนวนเข้าชมโปรไฟล์</span>
            <span>0 ครั้ง</span>
        </p>
        <p class="mb-0 d-flex flex-row justify-content-between">
            <span>จำนวนเข้าชม<?= $role === "tutor" ? "งานสอน" : "โพสต์" ?></span>
            <span>0 ครั้ง</span>
        </p> -->
        <p class="mb-0 d-flex flex-row justify-content-between">
            <span>ยืนยันตัวตน</span>
            <span>
                <img src="assets/images/icons/mail<?= $email == 1 ? "-danger" : "" ?>.png" class="hover-pointer" style="width: 30px; height: 30px;" title="<?= $email == 1 ? "ยืนยันอีเมลแล้ว" : "ยังไม่ยืนยันอีเมล" ?>">
                <?php
                if ($role === "tutor") {
                ?>
                    <img src="assets/images/icons/card<?= $idcard == 1 ? "-danger" : "" ?>.png" class="hover-pointer" style="width: 30px; height: 30px;" title="<?= $idcard == 1 ? "ยืนยันบัตรประชาชนแล้ว" : "ยังไม่ยืนยันบัตรประชาชน" ?>">
                <?php
                }
                ?>
            </span>
        </p>
        <?php
        if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {
            if ($_SESSION['is_approved'] == 0) {
                if ($coppied == "") {
                    echo '<p class="mt-3 mb-0 d-flex flex-row justify-content-center">
                    <button class="btn btn-sm btn-outline-primary" style="width:100%;" onclick="showModalAddVerify();">เพิ่มการยืนยันตัวตน</button>
                </p>';
                } else {
                    echo '<p class="mt-3 mb-0 d-flex flex-row justify-content-center">
                    <button class="btn btn-sm btn-secondary" style="width:100%;" disabled>รอการตรวจสอบ</button>
                </p>';
                }
            }
        }
        ?>
    </div>

</div>
<script type="text/javascript">
    function showModalAddVerify() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_add_verify.php",
            data: {
                
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_add_verify").modal("toggle");
            }
        });
    }
</script>