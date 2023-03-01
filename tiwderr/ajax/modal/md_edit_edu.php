<?php
session_start();
?>
<div class="modal fade" id="modal_edit_edu" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_edu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขประวัติการศึกษา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="edit_edu_form">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_level" class="form-label ">ระดับการศึกษา: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="edit_level" required>
                                        <option value="">เลือก</option>
                                        <option value="ประถมศึกษา">ประถมศึกษา</option>
                                        <option value="มัธยมศึกษาตอนต้น">มัธยมศึกษาตอนต้น</option>
                                        <option value="มัธยมศึกษาตอนปลาย">มัธยมศึกษาตอนปลาย</option>
                                        <option value="ปวช.">ปวช.</option>
                                        <option value="ปวส.">ปวส.</option>
                                        <option value="อนุปริญญา">อนุปริญญา</option>
                                        <option value="ปริญญาตรี">ปริญญาตรี</option>
                                        <option value="ปริญญาโท">ปริญญาโท</option>
                                        <option value="ปริญญาเอก">ปริญญาเอก</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_institute" class="form-label ">สถาบันการศึกษา: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_institute" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_facmaj" class="form-label ">คณะ/สาขา: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_facmaj" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_diploma" class="form-label ">วุฒิการศึกษา: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_diploma" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_gpax" class="form-label ">เกรดเฉลี่ย: </label>
                                    <input type="number" class="form-control form-control-sm text-dark mr-3" id="edit_gpax" step="0.01" min="0" max="4" pattern="^\d*(\.\d{0,2})?$">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_year" class="form-label ">ช่วงปีที่ศึกษา: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_year" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_state" class="form-label ">สถานะการศึกษา: <span class="text-danger">*</span></label>
                                    
                                    <div class="d-flex flex-row m-0" id="select_gtype">
                                        
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="กำลังศึกษา" id="edit_state_1" name="edit_state" checked>
                                            <label class="form-group-label " for="edit_state_1">กำลังศึกษา</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="จบการศึกษา" id="edit_state_2" name="edit_state">
                                            <label class="form-group-label " for="edit_state_2">จบการศึกษา</label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end px-3">
                            <button class="btn btn-sm btn-success" type="button" onclick="submitEdu();">เพิ่ม</button>
                        </div>
                    </form>
                    <div class="row">
                        <h6>รายการประวัติการศึกษาของฉัน</h6>
                    </div>
                    <div id="forList">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(document).ready(function() {

        showEduList();
    });
    
    function showEduList() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_edit_edu_list.php",
            data: {

            },
            success: function(response) {
                $("#forList").html(response);

            },
            error: function(error) {
                console.log('AJAX Error: ' + error);
            }
        });
    }

    function submitEdu() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_level').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุระดับการศึกษา";
            $('#edit_level').focus();
        } else if (!$('#edit_institute').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุสถาบันการศึกษา";
            $('#edit_institute').focus();
        } else if ($('input[name="edit_state"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาเลือกสถานะการศึกษา";
            $('#edit_state').focus();
        } else if ($('#edit_gpax').val() && ($('#edit_gpax').val() < 0) || $('#edit_gpax').val() > 4) {
            Swal.fire({
                title: 'กรอกข้อมูลไม่ถูกต้อง !',
                text: 'กรุณาระบุเกรดเฉลี่ยที่ถูกต้อง',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            })
            $('#edu_gpax').focus();
        } else {
            var edu_data = {
                'username': "<?= $_SESSION['username'] ?>",
                'level': $('#edit_level').val(),
                'institute': $('#edit_institute').val(),
                'facmaj': $('#edit_facmaj').val(),
                'diploma': $('#edit_diploma').val(),
                'gpax': $('#edit_gpax').val(),
                'year': $('#edit_year').val(),
                'state': $("input[name='edit_state']:checked").val(),
            };
            $.ajax({
                type: "POST",
                url: "ajax/action/add_edu.php",
                data: edu_data,
                success: function(response) {
                    console.log('res: ' + response);

                    showEduList();
                    showTutorEdu();

                    Swal.fire({
                        icon: 'success',
                        title: 'อัปเดตประวัติของคุณแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#edit_edu_form")[0].reset();
                    $("#edit_state_1").prop("checked", true);

                },
                error: function(error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        }

        if (empty_input != 0) {
            console.log('check submit');
            Swal.fire({
                title: 'กรอกข้อมูลไม่ครบถ้วน !',
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