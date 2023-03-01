<?php
session_start();


require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];

$sql = "SELECT * FROM `tbl_tutor_experience` 
        WHERE `username` = '$username';";
$result = mysqli_query($conn, $sql);

$id = "";
$experience = "";
$username = "";
$last_update = "";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $experience = $row['experience'];
    $username = $row['username'];
    $last_update = $row['last_update'];
}
?>
<div class="modal fade" id="modal_edit_experience" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_experience" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขประสบการณ์การสอน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="edit_experience_form">
                        <textarea id="edit_experience" class="summernote"><?= (mysqli_num_rows($result) > 0 ? $experience : "")  ?></textarea>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <button type="button" class="btn btn-danger btn-sm  mr-auto" onclick="deleteExperience(<?= $id ?>);">ลบ</button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-secondary btn-sm  " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitExperience();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".summernote").summernote({
            placeholder: '',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
		['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link']],
                 ['insert', ['link', 'picture']],
                // ['view', ['fullscreen', 'codeview', 'help']]
            ],
            disableDragAndDrop: true,
            disableResizeEditor: false,
        });
    });

    function submitExperience() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_experience').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรายละเอียดประสบการณ์การสอน";
            $('#edit_experience').focus();
        } else {
            var experience_data = {
                'experience': $('#edit_experience').val(),
                'username': "<?= $_SESSION['username'] ?>",
            };

            Swal.fire({
                title: 'คุณต้องการอัปเดตประสบการณ์ ?',
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
                        url: "ajax/action/add_experience.php",
                        data: experience_data,
                        // processData: false,
                        // dataType: "text",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);

                            if (response === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตประสบการณ์ของคุณแล้ว',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#modal_edit_experience").modal("toggle");
                                showTutorExperience();
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

    function deleteExperience(id) {
        Swal.fire({
            title: 'คุณต้องการลบประสบการณ์สอน ?',
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
                    url: "ajax/action/delete_experience.php",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        $("#modal_edit_experience").modal("toggle");
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบประสบการณ์สอนเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        showTutorExperience();
                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }
</script>