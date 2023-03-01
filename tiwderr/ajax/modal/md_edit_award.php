<?php
session_start();
?>
<div class="modal fade" id="modal_edit_award" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_award" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขผลงานหรือรางวัลที่เคยได้รับ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-secondary">อาทิ คะแนนสอบ, รางวัลการแข่งขัน, นักเรียนแลกเปลี่ยน, เข้าค่ายวิชาการ ฯลฯ</p>
                        </div>
                    </div>
                    <form id="edit_award_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_title" class="form-label ">ชื่อผลงานหรือรางวัล: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_title" maxlength="200" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_org" class="form-label ">หน่วยงานที่มอบให้: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_org" maxlength="500">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_detail" class="form-label ">รายละเอียด: </label>
                                    <textarea class="form-control form-control-sm text-dark mr-3" id="edit_detail" maxlength="300" rows="5"></textarea>
                                    <div id="edit_detail_count" class="text-secondary">
                                        <span id="edit_detail_current">0</span>
                                        <span id="edit_detail_max">/ 300</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end px-3">
                            <button class="btn btn-sm btn-success" type="button" onclick="submitaward();">เพิ่ม</button>
                        </div>
                    </form>
                    <div class="row">
                        <h6>รายการผลงานหรือรางวัลของฉัน</h6>
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
        showAwardList();
    });


    $('#edit_detail').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#edit_detail_current'),
            maximum_count = $('#edit_detail_max'),
            count = $('#edit_detail_count');
        current_count.text(characterCount);
    });

    function showAwardList() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_edit_award_list.php",
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

    function submitaward() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_title').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุชื่อผลงานหรือรางวัล";
            $('#edit_title').focus();
        } else {
            var award_data = {
                'username': "<?= $_SESSION['username'] ?>",
                'title': $('#edit_title').val(),
                'org': $('#edit_org').val(),
                'detail': $('#edit_detail').val().replace(/\n\r?/g, '<br />'),
            };
            $.ajax({
                type: "POST",
                url: "ajax/action/add_award.php",
                data: award_data,
                success: function(response) {
                    console.log('res: ' + response);

                    showAwardList();
                    showTutorAward()
                    Swal.fire({
                        icon: 'success',
                        title: 'อัปเดตผลงานของคุณแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#edit_award_form")[0].reset();
                    $('#edit_detail_current').text("0");

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