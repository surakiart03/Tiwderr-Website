<?php
session_start();
require_once("../../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "SELECT * FROM `tbl_admin` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
}
?>
<div class="modal fade" id="modal_edit_admin" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_admin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="fas fa-user-edit mr-1"></i>แก้ไขผู้ดูแลระบบ</h5>
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
                                    <label for="edit_username" class="form-label ">ชื่อบัญชี: </label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_username" value="<?= $username ?>" autofocus>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_email" class="form-label ">อีเมล: </label>
                                    <input type="email" class="form-control form-control-sm text-dark mr-3" id="edit_email" value="<?= $email ?>">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group m-0 p-0 mb-1">
                                    <input type="checkbox" id="changePassword" name="changePassword"><label class="form-label ml-2 " for="changePassword">เปลี่ยนรหัสผ่าน </label>
                                    <input type="password" class="form-control form-control-sm text-dark mr-3 d-none" id="edit_password" value="">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm  " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitEditAdmin();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const checkbox = document.getElementById('changePassword')

        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                $("#edit_password").removeClass("d-none");
                $("#edit_password").focus();
            } else {
                $("#edit_password").addClass("d-none");
                $("#edit_password").val('');

            }
        })
    });



    function submitEditAdmin() {
        var empty_input = 0;
        var text_title = "กรอกข้อมูลไม่ครบถ้วน !"
        var text_alert = "";

        if (!$("#edit_username").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกชื่อบัญชี";
        } else if (!$("#edit_email").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกอีเมล";
        } else if ($('input[name="changePassword"]:checked').length != 0 && !$("#edit_password").val()) {
            empty_input += 1;
            text_alert = "กรุณากรอกรหัสผ่านใหม่";
        } else {
            var admin_data = {
                'username': $("#add_username").val(),
                'email': $("#add_email").val(),
                'password': $("#add_password").val(),
            };

            Swal.fire({
                title: 'แก้ไขผู้ดูแลระบบ ?',
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
                        url: "ajax/action/edit_admin.php",
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
                                    title: 'แก้ไขผู้ดูแลระบบแล้ว',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#modal_edit_admin").modal("toggle");
                                showTableAdmin();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'มีบางอย่างผิดพลาด',
                                    text: 'ไม่สามารถแก้ไขบัญชีผู้ดูแลได้',
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