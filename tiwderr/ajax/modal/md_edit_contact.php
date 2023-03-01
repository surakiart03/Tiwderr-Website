<?php
session_start();
?>
<div class="modal fade" id="modal_edit_contact" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_contact" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขช่องทางการติดต่อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="edit_contact_form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_type" class="form-label ">ประเภท: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="edit_type" required>
                                        <option value="">เลือก</option>
                                        <option value="1-Phone">โทรศัพท์</option>
                                        <option value="2-Email">Email</option>
                                        <option value="3-Facebook">Facebook</option>
                                        <option value="4-Instagram">Instagram</option>
                                        <option value="5-Line">Line</option>
                                        <option value="6-Twitter">Twitter</option>
                                        <option value="7-WhatsApp">WhatsApp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_contact" class="form-label ">ช่องทางติดต่อ: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm text-dark mr-3" id="edit_contact" maxlength="255" required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end px-3">
                            <button class="btn btn-sm btn-success" type="button" onclick="submitContact();">เพิ่ม</button>
                        </div>
                    </form>
                    <div class="row">
                        <h6>รายการข้อมูลติดต่อของฉัน <i class="mdi mdi-alert-circle" title="ระบบจะจัดเรียงลำดับโดยอัตโนมัติ"></i></h6>
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
        showContactList();
    });

    function showContactList() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_edit_contact_list.php",
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

    function submitContact() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_type').val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกประเภท";
            $('#edit_type').focus();
        } else if (!$('#edit_contact').val().trim()) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่องทางการติดต่อ";
            $('#edit_contact').focus();
        } else {
            var contact_data = {
                'username': "<?= $_SESSION['username'] ?>",
                'type': $('#edit_type').val(),
                'contact': $('#edit_contact').val(),
            };
            $.ajax({
                type: "POST",
                url: "ajax/action/add_contact.php",
                data: contact_data,
                success: function(response) {
                    console.log('res: ' + response);

                    showContactList();
                    showContactCard();
                    Swal.fire({
                        icon: 'success',
                        title: 'อัปเดตข้อมูลติดต่อของคุณแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#edit_contact_form")[0].reset();

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