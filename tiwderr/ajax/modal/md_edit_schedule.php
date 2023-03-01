<?php
session_start();
?>
<div class="modal fade" id="modal_edit_schedule" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_schedule" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขตารางเวลา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="edit_schedule_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_day" class="form-label ">วัน: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="edit_day" required>
                                        <option value="">เลือก</option>
                                        <option value="1-mon">จันทร์</option>
                                        <option value="2-tue">อังคาร</option>
                                        <option value="3-wed">พุธ</option>
                                        <option value="4-thu">พฤหัสบดี</option>
                                        <option value="5-fri">ศุกร์</option>
                                        <option value="6-sat">เสาร์</option>
                                        <option value="7-sun">อาทิตย์</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_detail" class="form-label ">รายละเอียด: <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-sm text-dark mr-3" rows="5" id="edit_detail" placeholder="ระบุรายละเอียด เช่น ช่วงเวลา" maxlength="300" required></textarea>
                                    <div id="edit_detail_count" class="text-secondary">
                                        <span id="edit_detail_current">0</span>
                                        <span id="edit_detail_max">/ 300</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end px-3">
                            <button class="btn btn-sm btn-success" type="button" onclick="submitSchedule();">เพิ่ม</button>
                        </div>
                    </form>
                    <div class="row">
                        <h6>รายการตารางเวลาของฉัน</h6>
                    </div>
                    <div id="forList">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        showScheduleList();
    });

    $('#edit_detail').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#edit_detail_current'),
            maximum_count = $('#edit_detail_max'),
            count = $('#edit_detail_count');
        current_count.text(characterCount);
    });

    function showScheduleList() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_edit_schedule_list.php",
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

    function submitSchedule() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_day').val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกวัน";
            $('#edit_day').focus();
        } else if (!$('#edit_detail').val().trim()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรายละเอียด";
            $('#edit_detail').focus();
        } else {
            var schedule_data = {
                'username': "<?= $_SESSION['username'] ?>",
                'day': $('#edit_day').val(),
                'detail': $('#edit_detail').val(),
            };
            $.ajax({
                type: "POST",
                url: "ajax/action/add_schedule.php",
                data: schedule_data,
                // processData: false,
                // dataType: "text",
                //encode: true,
                success: function(response) {
                    console.log('res: ' + response);

                    if (response == "data exist") {
                        Swal.fire({
                            title: 'วันที่เลือกถูกำหนดแล้ว !',
                            text: 'ไม่สามารถเพิ่มวันซ้ำได้ กรุณาเลือกวันใหม่',
                            icon: 'warning',
                            //showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            //cancelButtonColor: '#d33',
                            confirmButtonText: 'ตกลง'
                        })
                    } else {
                        if (response === "success") {
                            showScheduleList();
                            showScheduleCard();
                            Swal.fire({
                                icon: 'success',
                                title: 'อัปเดตตารางเวลาของคุณแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#edit_schedule_form")[0].reset();
                            $("#edit_detail_current").text("0");
                        }
                    }
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