<?php
session_start();
require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];
$sql = "SELECT * FROM `tbl_attention` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);

$subject = array();
$level = array();
$purpose = array();
$channel = array();
$gtype = array();
$gender = array();

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);
    $subject = ($row['subject'] ? explode(",", $row['subject']) : array());
    $level = ($row['level'] ? explode(",", $row['level']) : array());
    $purpose = ($row['purpose'] ? explode(",", $row['purpose']) : array());
    $channel = ($row['channel'] ? explode(",", $row['channel']) : array());
    $gtype = ($row['group_type'] ? explode(",", $row['group_type']) : array());
    $gender = ($row['gender'] ? explode(",", $row['gender']) : array());
}
?>
<div class="modal fade" id="modal_attention" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_attention" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขโปรไฟล์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="unlinkFile(3);">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="attention_form">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-1 pt-2">หมวดวิชา</span><span class="text-muted mr-3 pt-2" style="font-size:0.6rem;">เลือกไม่เกิน 5 รายการ</span>
                                <select class="form-control form-control-sm selectpicker text-dark btn-white mr-3" id="subject" title="เลือก" data-live-search="true" multiple data-max-options="5" data-size="7">
                                    <!-- <option value="" <?= (empty($subject) ? 'selected' : '') ?>>เลือก</option> -->
                                    <?php
                                    $sql_subject = "SELECT subject FROM tbl_subjects ORDER BY subject";
                                    $result_subject = mysqli_query($conn, $sql_subject);
                                    foreach ($result_subject as $row) {

                                        echo "<option value='" . $row['subject'] . "'" . (in_array($row['subject'], $subject) ? 'selected' : '') . ">$row[subject]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-1 pt-2">ระดับชั้น</span><span class="text-muted mr-3 pt-2" style="font-size:0.6rem;">เลือกไม่เกิน 3 รายการ</span>
                                <select class="form-control form-control-sm selectpicker text-dark mr-3" id="level" title="เลือก" data-live-search="true" multiple data-max-options="3" data-size="7">
                                    <!-- <option value="" <?= (empty($level) ? 'selected' : '') ?>>เลือก</option> -->
                                    <option value="0" <?= (in_array(0, $level) ? 'selected' : '') ?>>อนุบาล</option>
                                    <option value="1" <?= (in_array(1, $level) ? 'selected' : '') ?>>ประถมศึกษา</option>
                                    <option value="2" <?= (in_array(2, $level) ? 'selected' : '') ?>>มัธยมศึกษาต้น</option>
                                    <option value="3" <?= (in_array(3, $level) ? 'selected' : '') ?>>มัธยมศึกษาตอนปลาย</option>
                                    <option value="4" <?= (in_array(4, $level) ? 'selected' : '') ?>>มหาวิทยาลัย</option>
                                    <option value="5" <?= (in_array(5, $level) ? 'selected' : '') ?>>บุคคลทั่วไป</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-1 pt-2">เป้าหมายการเรียน</span><span class="text-muted mr-3 pt-2" style="font-size:0.6rem;">เลือกไม่เกิน 3 รายการ</span>
                                <select class="form-control form-control-sm selectpicker text-dark mr-3" id="purpose" title="เลือก" data-live-search="true" multiple data-max-options="3" data-size="7">
                                    <!-- <option value="" <?= (empty($purpose) ? 'selected' : '') ?>>เลือก</option> -->
                                    <option value="0" <?= (in_array(0, $purpose) ? 'selected' : '') ?>>ความรู้ในงานประจำ</option>
                                    <option value="1" <?= (in_array(1, $purpose) ? 'selected' : '') ?>>งานอดิเรก</option>
                                    <option value="2" <?= (in_array(2, $purpose) ? 'selected' : '') ?>>เพื่อการแข่งขัน</option>
                                    <option value="3" <?= (in_array(3, $purpose) ? 'selected' : '') ?>>เพื่อการแสดง</option>
                                    <option value="4" <?= (in_array(4, $purpose) ? 'selected' : '') ?>>เพิ่มเกรด</option>
                                    <option value="5" <?= (in_array(5, $purpose) ? 'selected' : '') ?>>เพิ่มทักษะ/เสริมความรู้ความเข้าใจ</option>
                                    <option value="6" <?= (in_array(6, $purpose) ? 'selected' : '') ?>>ทำการบ้าน</option>
                                    <option value="7" <?= (in_array(7, $purpose) ? 'selected' : '') ?>>ทำข้อสอบเข้าเรียน</option>
                                    <option value="8" <?= (in_array(8, $purpose) ? 'selected' : '') ?>>ทำข้อสอบวัดระดับ</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-3 pt-2">ช่องทางการเรียน</span>
                                <div class="d-flex flex-row">
                                    <div class="form-check">
                                        <input class="form-check-input text-primary" type="checkbox" value="ออนไลน์" id="channel_1" name="channel" <?= (in_array('ออนไลน์', $channel) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="channel_1">ออนไลน์</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" value="ตัวต่อตัว" id="channel_2" name="channel" <?= (in_array('ตัวต่อตัว', $channel) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="channel_2">ตัวต่อตัว</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-3 pt-2">ติวแบบ</span>
                                <div class="d-flex flex-row">
                                    <div class="form-check ">
                                        <input class="form-check-input text-primary" type="checkbox" value="เดี่ยว" id="gtype_1" name="gtype" <?= (in_array('เดี่ยว', $gtype) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gtype_1">ติวเดี่ยว</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" value="กลุ่ม" id="gtype_2" name="gtype" <?= (in_array('กลุ่ม', $gtype) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gtype_2">ติวกลุ่ม</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <span class="text-nowrap mr-3 pt-2">เพศผู้<?= $_SESSION['role'] == 'tutor' ? 'เรียน' : 'สอน' ?></span>
                                <div class="d-flex flex-row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ไม่ระบุ" id="gender_n" name="gender" <?= (in_array('ไม่ระบุ', $gender) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gender_n">ไม่ระบุ</label>
                                    </div>
                                    <div class="form-check  ml-3">
                                        <input class="form-check-input" type="checkbox" value="ชาย" id="gender_m" name="gender" <?= (in_array('ชาย', $gender) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gender_m">ชาย</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" value="หญิง" id="gender_f" name="gender" <?= (in_array('หญิง', $gender) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gender_f">หญิง</label>
                                    </div>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" value="LGBTQ+" id="gender_lgbtq" name="gender" <?= (in_array('LGBTQ+', $gender) ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="gender_lgbtq">LGBTQ+</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm mr-auto" onclick="clearForm();">ล้างค่า</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" form="add_review_form" class="btn btn-primary btn-sm" onclick="submitAttention();">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });

    function clearForm() {
        // $('#subject').val('');
        // $('#level').val('');
        // $('#purpose').val('');
        $("[name='channel']").prop('checked', false);
        $("input[name='gtype']").prop('checked', false);
        $("input[name='gender']").prop('checked', false);
        $(".selectpicker option:selected").prop("selected", false);
        $('.selectpicker').selectpicker('refresh');
    }

    function submitAttention() {

        var subject = "";
        var i = 0;
        $('#subject :selected').each(function() {
            if (i > 0) {
                subject = subject + "," + $(this).val();
            } else {
                subject = $(this).val();
            }

            i++;
        });

        var level = "";
        var i = 0;
        $('#level :selected').each(function() {
            if (i > 0) {
                level = level + "," + $(this).val();
            } else {
                level = $(this).val();
            }

            i++;
        });

        var purpose = "";
        var i = 0;
        $('#purpose :selected').each(function() {
            if (i > 0) {
                purpose = purpose + "," + $(this).val();
            } else {
                purpose = $(this).val();
            }

            i++;
        });

        
        var channel = "";
        var i = 0;
        $("input[name='channel']:checked").each(function() {

            if (i > 0) {
                channel = channel + "," + $(this).val();
            } else {
                channel = $(this).val();
            }

            i++;
        });

        
        var gtype = "";
        var i = 0;
        $("input[name='gtype']:checked").each(function() {

            if (i > 0) {
                gtype = gtype + "," + $(this).val();
            } else {
                gtype = $(this).val();
            }

            i++;
        });

        
        var gender = "";
        var i = 0;
        $("input[name='gender']:checked").each(function() {

            if (i > 0) {
                gender = gender + "," + $(this).val();
            } else {
                gender = $(this).val();
            }

            i++;
        });
        var attention_data = {
            'subject': subject,
            'level': level,
            'purpose': purpose,
            'channel': channel,
            'gtype': gtype,
            'gender': gender,
        };
        console.log(attention_data);
        Swal.fire({
            title: 'ต้องการบันทึกความสนใจ ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/action/edit_attention.php",
                    type: "POST",
                    data: attention_data,
                    success: function(response) {
                        console.log("res: " + response);
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกความสนใจของคุณแล้ว',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#modal_attention").modal("toggle");
                        getSuggestionCheck();
                    }
                });
            }
        });
    }
</script>