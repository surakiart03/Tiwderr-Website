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
<div class="modal fade" id="modal_manage_approve" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_manage_approve" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="fas fa-user-shield mr-1"></i>ตรวจสอบการยืนยันตัวตน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <iframe <?= ($coppied_id ? 'src="../uploads/user_coppied_id/' . $coppied_id . '"' : '') ?> width="100%" height="400px">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="mr-3 text-dark">ตรวจสอบ</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="status1" name="status" value="P" onchange="handleChange(this);"><span class="text-success">ผ่าน</span>
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="status2" name="status" value="F" onchange="handleChange(this);"><span class="text-danger">ไม่ผ่าน</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control from-control-sm d-none" id="remark">
                                            <option value="เอกสารไม่ตรงกับข้อมูลลงทะเบียน">เอกสารไม่ตรงกับข้อมูลลงทะเบียน</option>
                                            <option value="เอกสารไม่ชัดเจน">เอกสารไม่ชัดเจน</option>
                                            <option value="การเซ็นสำเนาไม่ถูกต้อง">การเซ็นสำเนาไม่ถูกต้อง</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm  " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitApprove();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#app_id_card').inputmask('9-99-99-99999-99-9');
    });

    function handleChange(src) {
        if (src.value == "F") {
            $("#remark").removeClass("d-none");
        } else {
            $("#remark").addClass("d-none");
        }
    }

    function submitApprove() {
        var empty_input = 0;
        var text_title = "ไม่สามารถบันทึกได้ !"
        var text_alert = "";

        if ("<?= $coppied_id ?>" == "") {
            empty_input += 1;
            text_alert = "เนื่องจากผู้ใช้ไม่ได้อัปโหลดเอกสาร";
        } else if (!$("input[name='status']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกสถานะตรวจสอบ";
        } else {
            var remark = "";
            if ($("input[name='status']:checked").val() == "F") {
                remark = $("#remark").val();
            }

            var approve_data = {
                'username': $("#app_username").val(),
                'email': $("#app_email").val(),
                'id_card': "<?= $id_card ?>",
                'coppied_id': "<?= $coppied_id ?>",
                'status': $("input[name='status']:checked").val(),
                'remark': remark,
                'action_by': "<?= $_SESSION['username'] ?>",
            };

            Swal.fire({
                title: 'อัปเดตการตรวจสอบ ?',
                text: "ระบบจะแจ้งการตรวจสอบไปยังอีเมลของผู้ใช้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "ajax/action/add_approve.php",
                        data: approve_data,
                        success: function(response) {
                            console.log('res: ' + response);
                            Swal.fire({
                                icon: 'success',
                                title: 'อัปเดตการตรวจสอบแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal_manage_approve").modal("toggle");
                            showTableUser();
                            showTableUserNum();
                        },
                        error: function(error) {
                            console.log('AJAX Error: ' + error);
                        }
                    });
                }
            });
        }

        if (empty_input != 0) {
            console.log('check submit');
            Swal.fire({
                title: text_title,
                text: text_alert,
                icon: 'error',
                //showCancelButton: true,
                confirmButtonColor: '#3085d6',
                //cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง'
            })
        }
    }
</script>