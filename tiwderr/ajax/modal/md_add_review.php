<?php
session_start();

$review_type = $_POST['review_type'];
$item = $_POST['item'];
?>
<div class="modal fade" id="modal_add_review" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_review" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>เขียนรีวิวของคุณ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <form id="add_review_form">
                        <div class="row">

                            <div class="col-md-12">
                                <i id="star1" class="mdi mdi-star text-warning" style="font-size: 2.5rem;" onclick="starFunction(1);"></i>
                                <i id="star2" class="mdi mdi-star text-warning" style="font-size: 2.5rem;" onclick="starFunction(2);"></i>
                                <i id="star3" class="mdi mdi-star text-warning" style="font-size: 2.5rem;" onclick="starFunction(3);"></i>
                                <i id="star4" class="mdi mdi-star text-warning" style="font-size: 2.5rem;" onclick="starFunction(4);"></i>
                                <i id="star5" class="mdi mdi-star text-warning" style="font-size: 2.5rem;" onclick="starFunction(5);"></i>
                                <span id="rating" class="text-warning ml-3 pb-3" style="font-size: 1rem;">ยอดเยี่ยม</span>
                                <input type="hidden" value="5" id="add_score" />
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <textarea id="add_message" class="form-control form-control-sm text-dark" rows="10" cols="100%" placeholder="บอกเล่าประสบการณ์ของคุณ" maxlength="500"></textarea>
                                    <div id="add_message_count" class="text-secondary">
                                        <span id="add_message_current">0</span>
                                        <span id="add_message_max">/ 500</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 mt-3">
                                    <input class="form-group-input" type="checkbox" value="1" id="check_show_user" name="check_show_user" checked onclick="showUserFunction();">
                                    <label class="form-group-label " for="check_show_user">แสดงชื่อผู้ใช้</label><span class="ml-3" id="show_user"><?= $_SESSION['username'] ?></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" form="add_review_form" class="btn btn-primary btn-sm" onclick="submitReview();">ส่งรีวิว</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".summernote-review").summernote({
            placeholder: 'บอกเล่าประสบการณ์ของคุณ',
            disableDragAndDrop: true,
            disableResizeEditor: true,
            //tabsize: 2,
            height: 150,
            toolbar: false,
        });
        $(".note-statusbar").hide();
    });

    $('#add_message').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#add_message_current'),
            maximum_count = $('#add_message_max'),
            count = $('#add_message_count');
        current_count.text(characterCount);
    });

    function starFunction(num) {
        for (var i = 1; i <= 5; i++) {
            if (i > num) {
                $("#star" + i).removeClass("mdi-star");
                $("#star" + i).addClass("mdi-star-outline");
            } else {
                $("#star" + i).removeClass("mdi-star-outline");
                $("#star" + i).addClass("mdi-star");
            }
        }

        if (num == 1) {
            $("#rating").text("แย่");
        } else if (num == 2) {
            $("#rating").text("พอใช้");
        } else if (num == 3) {
            $("#rating").text("ปานกลาง");
        } else if (num == 4) {
            $("#rating").text("ดี");
        } else {
            $("#rating").text("ยอดเยี่ยม");
        }

        $("#add_score").val(num);
    }

    function showUserFunction() {
        var username = "<?= $_SESSION['username'] ?>";
        var val = $("#check_show_user").val();

        //console.log(username);
        if (val == 1) {
            $("#show_user").text(username.substring(0, 1) + "*****" + username.substring(username.length - 1, username.length));
            $("#check_show_user").val("0");
        } else {
            $("#show_user").text(username);
            $("#check_show_user").val("1");
        }
    }

    function submitReview() {
        var review_data = {
            'review_type': "<?= $review_type ?>",
            'review_to': "<?= $item ?>",
            'score': $("#add_score").val(),
            'message': $("#add_message").val().replace(/\n\r?/g, '<br />'),
            'show_user': $("#check_show_user").val(),
            'create_by': "<?= $_SESSION['username'] ?>",
        };

        Swal.fire({
            title: 'คุณต้องการส่งรีวิวของคุณ ?',
            text: "คุณไม่สามารถแก้ไขการรีวิวได้ในภายหลัง",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ส่งรีวิว',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "ajax/action/add_review.php",
                    data: review_data,
                    // processData: false,
                    // dataType: "json",
                    //encode: true,
                    success: function(response) {
                        console.log('res: ' + response);
                        $("#modal_add_review").modal("toggle");
                        Swal.fire({
                            icon: 'success',
                            title: 'ส่งรีวิวของคุณแล้ว',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        //showReviewList();
                        if ("<?= $review_type ?>" == "course") {
                            showCourseDetail();
                        } else {
                            showMyReview();
                            showProfileCard();
                        }
                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        });
    }
</script>