<?php
session_start();
?>
<div class="modal fade" id="modal_add_admin" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_admin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="fas fa-user-plus mr-1"></i>เพิ่มผู้ดูแลระบบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; ">
                <div class="container">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="add_username" class="form-label ">ชื่อบัญชี: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="add_username" value="" autofocus>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="add_email" class="form-label ">อีเมล: </label>
                                    <input type="email" class="form-control form-control-sm text-dark mr-3" id="add_email" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="add_password" class="form-label ">รหัสผ่าน: </label>
                                    <input type="password" class="form-control form-control-sm text-dark mr-3" id="add_password" value="">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm  " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitAddAdmin();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });

    function handleChange(src) {
        if (src.value == "F") {
            $("#remark").removeClass("d-none");
        } else {
            $("#remark").addClass("d-none");
        }
    }

    function submitAddAdmin() {
        var empty_input = 0;
        var text_title = "กรอกข้อมูลไม่ครบถ้วน !"
        var text_alert = "";

        if (!$("#add_username").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกชื่อบัญชี";
        } else if (!$("#add_email").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกอีเมล";
        } else if (!$("#add_password").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกรหัสผ่าน";
        } else {
            var admin_data = {
                'username': $("#add_username").val(),
                'email': $("#add_email").val(),
                'password': $("#add_password").val(),
                'create_by': "<?= $_SESSION['username']?>",
            };

            Swal.fire({
                title: 'เพิ่มผู้ดูแลระบบ ?',
                text: "",
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
                        url: "ajax/action/add_admin.php",
                        data: admin_data,
                        success: function(response) {
                            console.log('res: ' + response);
                            if (response == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ชื่อบัญชีและอีเมลนี้ถูกใช้แล้ว',
                                    text: 'กรุณากรอกชื่อบัญชีและอีเมลใหม่',
                                    showConfirmButton: true
                                });

                            } else if (response == 2) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ชื่อบัญชีนี้ถูกใช้แล้ว',
                                    text: 'กรุณากรอกชื่อบัญชีใหม่',
                                    showConfirmButton: true
                                });
                            } else if (response == 3) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'อีเมลนี้ถูกใช้แล้ว',
                                    text: 'กรุณากรอกชื่อบัญชีใหม่',
                                    showConfirmButton: true
                                });
                            } else if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มผู้ดูแลระบบแล้ว',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#modal_add_admin").modal("toggle");
                                showTableAdmin();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'มีบางอย่างผิดพลาด',
                                    text: 'ไม่สามารถเพิ่มบัญชีผู้ดูแลได้',
                                    showConfirmButton: true
                                });
                            }

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