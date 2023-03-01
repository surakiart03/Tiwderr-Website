<?php
session_start();
?>
<div class="modal fade" id="modal_add_verify" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_verify" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>เพิ่มการยืนยันตัวตน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="add_verify_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mt-2">
                                    <label class="">หมายเลขบัตรประชาชน</label>
                                    <input type="text" name="id_card" id="id_card" class="form-control form-control-sm text-dark input-lg " placeholder="ระบุเลขบัตร ปชช." maxlength="18">

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mt-3">
                                    <label class="">สำเนาบัตรประชาชน</label>
                                    <input type="file" accept=".pdf" class=" text-dark " name="coppiedID" id="coppiedID">
                                </div><span class="text-muted">รองรับไฟล์ .pdf</span>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col">
                            <h5>ตัวอย่างสำเนา</h5>
                            <span class="text-danger mr-1">หมายเหตุ: </span><span>หากมีข้อมูลศาสนา กรุณาขีดเพื่อไม่แสดงข้อมูลดังกล่าว</span>
                            <img src="assets/images/coppied_sample.jpg" alt="sample" class="mt-3" width="100%" style=" border: 1px solid" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" form="add_review_form" class="btn btn-primary btn-sm" onclick="submitVerify();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#id_card').inputmask('9-99-99-99999-99-9');
    });

    function showContactList() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_add_verify_list.php",
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

    function submitVerify() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#id_card').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหมายเลขบัตรประชาชน";
            $('#id_card').focus();
        } else if (!$("#coppiedID").get(0).files[0]) {
            empty_input += 1;
            text_alert = "กรุณาแนบเอกสาร";
            $('#coppiedID').focus();
        } else {
            var formData = new FormData();
            formData.append("id_card", $("#id_card").val());
            formData.append("coppied_id", $("#coppiedID").get(0).files[0]);
            formData.append("username", "<?= $_SESSION['username'] ?>");

            Swal.fire({
                title: 'เพิ่มการยืนยันตัวตน ?',
                text: "เราจะตรวจสอบข้อมูลและแจ้งให้คุณทราบผ่านทางอีเมล",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "ajax/action/add_verify.php",
                        type: "POST",
                        cache: false,
                        data: formData,
                        contentType: false, // you can also use multipart/form-data replace of false
                        processData: false,
                        success: function(response) {
                            console.log("res: " + response);
                            Swal.fire({
                                title: 'เพิ่มการยืนยันตัวตนแล้ว !',
                                text: 'กรุณารอการตรวจสอบ',
                                icon: 'success',
                                //showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                //cancelButtonColor: '#d33',
                                confirmButtonText: 'ตกลง'
                            });
                            $("#modal_add_verify").modal("toggle");
                            showInfoCard();
                        }
                    });
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