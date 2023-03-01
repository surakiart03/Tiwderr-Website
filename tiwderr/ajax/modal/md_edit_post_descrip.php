<?php
session_start();
require_once("../../connection/connect_db.php");

$id = $_POST['id'];

$sql = "SELECT * FROM `tbl_post` 
        WHERE `id` = $id;";
$result = mysqli_query($conn, $sql);

$id = "";
$post_descrip = "";

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $post_descrip = $row['post_descrip'];
    }
}

?>
<div class="modal fade" id="modal_edit_post_descrip" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_post_descrip" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขรายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px; ">
                    <form id="edit_descrip_form">
                        <textarea id="edit_post_descrip" class="summernote"><?= (mysqli_num_rows($result) > 0 ? $post_descrip : "")  ?></textarea>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                // if (mysqli_num_rows($result) > 0) {
                ?>
                <!-- <button type="button" class="btn btn-danger btn-sm  mr-auto" onclick="removePostDescrip(<?= $id ?>);">ลบ</button> -->
                <?php
                // }
                ?>
                <button type="button" class="btn btn-secondary btn-sm  " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="updatePostDescrip();">บันทึก</button>
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

    function updatePostDescrip() {
        var empty_input = 0;
        var text_alert = "";

        if (!$('#edit_post_descrip').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรายละเอียด";
            $('#edit_post_descrip').focus();
        } else {
            var post_data = {
                'id': "<?= $id ?>",
                'post_descrip': $('#edit_post_descrip').val(),
            };

            Swal.fire({
                title: 'คุณต้องการอัปเดตโพสต์ ?',
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
                        url: "ajax/action/edit_post_descrip.php",
                        data: post_data,
                        // processData: false,
                        // dataType: "text",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);

                            if (response === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตโพสต์ของคุณแล้ว',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            $("#modal_edit_post_descrip").modal("toggle");
                            showPostDetail();
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

    // function removePostDescrip(id) {
    //     Swal.fire({
    //         title: 'คุณต้องการลบราละเอียด ?',
    //         text: "",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'ตกลง',
    //         cancelButtonText: 'ยกเลิก'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 type: "POST",
    //                 url: "ajax/action/delete_post_descrip.php",
    //                 data: {
    //                     id: id,
    //                 },
    //                 success: function(response) {
    //                     console.log('res: ' + response);
    //                     $("#modal_edit_post").modal("toggle");
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'ลบรายละเอียดเรียบร้อย',
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     });
    //                     showTutorpost();
    //                 },
    //                 error: function(error) {
    //                     console.log('AJAX Error: ' + error);
    //                 }
    //             });

    //         }
    //     })
    // }
</script>