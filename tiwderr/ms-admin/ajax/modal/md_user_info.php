<?php
session_start();
require_once("../../../connection/connect_db.php");

$username = $_POST['username'];

$sql = "SELECT A.*, B.* FROM `tbl_user` A 
        INNER JOIN `tbl_user_info` B 
        ON A.username = B.username 
        WHERE A.username = '$username';";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$email = $row['email'];
$phone = $row['phone'];
$created_time = $row['created_time'];
$role = $row['role'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$dob = $row['dob'];
$gender = $row['gender'];
$id_card = $row['id_card'];
$is_verified = $row['is_verified'];
$is_approved = $row['is_approved'];
$coppied_id = $row['coppied_id'];

?>
<div class="modal fade" id="modal_user_info" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_user_info" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="far fa-file-alt mr-1"></i>ข้อมูลบัญชีผู้ใช้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="text-dark"><?= ($role == "tutor" ? '<i class="fas fa-chalkboard-teacher mr-1"></i>ติวเตอร์' : '<i class="fas fa-book-reader mr-1"></i>ผู้เรียน') ?></h3>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="app_username" class="form-label ">ชื่อบัญชี: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_username" value="<?= $username ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="app_email" class="form-label ">อีเมล: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_email" value="<?= $email ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="app_phone" class="form-label ">เบอร์โทรศัพท์: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_phone" value="<?= $phone ?>" readonly>
                                </div>
                            </div>
                            <?php
                            if ($role == "tutor") {
                            ?>
                                <div class="col-6">
                                    <div class="form-group m-0 p-0 mb-1">
                                        <label for="app_name" class="form-label ">ชื่อ: </label>
                                        <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_name" value="<?= $first_name ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-0 p-0 mb-1">
                                        <label for="app_lname" class="form-label ">นามสกุล: </label>
                                        <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_lname" value="<?= $last_name ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-0 p-0 mb-1">
                                        <label for="app_lname" class="form-label ">ดด/วว/ปปปป เกิด: </label>
                                        <input type="date" class="form-control form-control-sm text-dark mr-3" id="app_lname" value="<?= ($dob ? $dob : "") ?>" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="form-group m-0 p-0 mb-1">
                                        <label for="app_id_card" class="form-label ">เลขบัตรประจำตัวประชาชน: </label>
                                        <input type="text" class="form-control form-control-sm text-dark mr-3" id="app_id_card" value="<?= $id_card ?>" readonly>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div>


                    </form>
                    <div class="row mt-3">
                        <div class="col-4">
                            <span class="text-dark"><i class="fas fa-envelope mr-1"></i>การยืนยันอีเมล</span>
                        </div>
                        <div class="col-7">
                        <?= ($is_verified == 0 ? '<span class="text-danger"><i class="fa fa-exclamation mr-1"></i> ยังไม่ยืนยัน</span>' : '<span class="text-success"><i class="fa fa-check mr-1"></i> ยืนยันแล้ว</span>') ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

</script>