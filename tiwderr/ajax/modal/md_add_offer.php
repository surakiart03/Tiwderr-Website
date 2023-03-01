<?php
require_once("../../connection/connect_db.php");
session_start();

$post_id = $_POST['post_id'];

$sql = "SELECT * FROM `tbl_post`
        WHERE `id` = $post_id;";
$result = mysqli_query($conn, $sql);

?>
<div class="modal fade" id="modal_add_offer" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_offer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white"><i class="mdi mdi-message-text m-0 mr-1" style="font-size: 1.25rem;"></i>ยื่นข้อเสนอการสอนของคุณ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffe0e8;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <div class="row p-3">
                        <h5><i class="mdi mdi-alert-circle mr-1"></i>โปรดทราบ</h5>
                        <ol>
                            <li>เมื่อส่งข้อเสนอแล้วจะ<span class="text-danger">ไม่สามารถแก้ไขได้</span></li>
                            <li>มีเพียงผู้เรียนเจ้าของโพสต์เท่านั้นที่สามารถมองเห็นและตอบกลับข้อเสนอของคุณได้</li>
                            <li><span class="text-danger">การยื่นข้อเสนอ ไม่ถือว่าเป็นการยืนยันรับบริการ</span> คุณและผู้เรียนจะต้องเจรจาทำข้อตกลงกันในภายหลัง</li>
                        </ol>
                    </div>
                    <hr class="m-0">
                    <?php
                    if (mysqli_num_rows($result) != 0) {
                        foreach ($result as $row) {
                    ?>

                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder">หมวดวิชา:</span>
                                    <span class="text-dark ml-3"><?= $row['subject'] ?></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_subject_yes" name="add_offer_subject">
                                                <label class="form-group-label" for="add_offer_subject_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_subject_no" name="add_offer_subject">
                                                <label class="form-group-label" for="add_offer_subject_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_subject_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder">ระดับชั้น:</span>
                                    <span class="text-dark ml-3">
                                        <?php
                                        if ($row['level'] == 0) {
                                            echo 'อนุบาล';
                                        } else if ($row['level'] == 1) {
                                            echo 'ประถมศึกษา';
                                        } else if ($row['level'] == 2) {
                                            echo 'มัธยมศึกษาตอนต้น';
                                        } else if ($row['level'] == 3) {
                                            echo 'มัธยมศึกษาตอนปลาย';
                                        } else if ($row['level'] == 4) {
                                            echo 'มหาวิทยาลัย';
                                        } else if ($row['level'] == 5) {
                                            echo 'บุคคลทั่วไป';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_level_yes" name="add_offer_level">
                                                <label class="form-group-label" for="add_offer_level_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_level_no" name="add_offer_level">
                                                <label class="form-group-label" for="add_offer_level_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_level_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder">เป้าหมายการเรียน:</span>
                                    <span class="text-dark ml-3">
                                        <?php
                                        if ($row['purpose'] == 0) {
                                            echo 'ความรู้ในงานประจำ';
                                        } else if ($row['purpose'] == 1) {
                                            echo 'งานอดิเรก';
                                        } else if ($row['purpose'] == 2) {
                                            echo 'เพื่อการแข่งขัน';
                                        } else if ($row['purpose'] == 3) {
                                            echo 'เพื่อการแสดง';
                                        } else if ($row['purpose'] == 4) {
                                            echo 'เพิ่มเกรด';
                                        } else if ($row['purpose'] == 5) {
                                            echo 'เพิ่มทักษะ/เสริมความรู้ความเข้าใจ';
                                        } else if ($row['purpose'] == 6) {
                                            echo 'ทำการบ้าน';
                                        } else if ($row['purpose'] == 7) {
                                            echo 'ทำข้อสอบเข้าเรียน';
                                        } else if ($row['purpose'] == 8) {
                                            echo 'ทำข้อสอบวัดระดับ';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_purpose_yes" name="add_offer_purpose">
                                                <label class="form-group-label" for="add_offer_purpose_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_purpose_no" name="add_offer_purpose">
                                                <label class="form-group-label" for="add_offer_purpose_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_purpose_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder">ช่องทางการเรียน:</span>
                                    <span class="text-dark ml-3"><?= $row['channel'] ?></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_channel_yes" name="add_offer_channel">
                                                <label class="form-group-label" for="add_offer_channel_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_channel_no" name="add_offer_channel">
                                                <label class="form-group-label" for="add_offer_channel_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_channel_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder">ติวแบบ:</span>
                                    <span class="text-dark ml-3"><?= $row['group_type'] ?></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_gtype_yes" name="add_offer_gtype">
                                                <label class="form-group-label" for="add_offer_gtype_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_gtype_no" name="add_offer_gtype">
                                                <label class="form-group-label" for="add_offer_gtype_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_gtype_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder mr-3">วันที่ติว:</span>
                                    <?php
                                    $day = explode(",", $row['day']);

                                    if (count($day) != 0) {
                                        for ($i = 0; $i < count($day); $i++) {
                                            if ($day[$i] == "mon") {
                                                echo '<span class="text-white" style="background-color: gold;">จ. </span>';
                                            } else if ($day[$i] == "tue") {
                                                echo '<span class="text-white" style="background-color: hotpink;">อ. </span>';
                                            } else if ($day[$i] == "wed") {
                                                echo '<span class="text-white" style="background-color: green;">พ. </span>';
                                            } else if ($day[$i] == "thu") {
                                                echo '<span class="text-white" style="background-color: orange;">พฤ. </span>';
                                            } else if ($day[$i] == "fri") {
                                                echo '<span class="text-white" style="background-color: blue;">ศ. </span>';
                                            } else if ($day[$i] == "sat") {
                                                echo '<span class="text-white" style="background-color: purple;">ส. </span>';
                                            } else if ($day[$i] == "sun") {
                                                echo '<span class="text-white" style="background-color: red;">อา. </span>';
                                            } else {
                                                echo '-';
                                            }
                                        }
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_day_yes" name="add_offer_day">
                                                <label class="form-group-label" for="add_offer_day_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_day_no" name="add_offer_day">
                                                <label class="form-group-label" for="add_offer_day_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_day_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder mr-3">ช่วงเวลา:</span>
                                    <?php
                                    $time = explode(",", $row['time']);

                                    if (count($time) != 0) {
                                        for ($i = 0; $i < count($time); $i++) {
                                            if ($time[$i] == "เช้า-เที่ยง") {
                                                echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-sunny"></i>ช่วงเช้า-เที่ยง</span><br>';
                                            } else if ($time[$i] == "บ่าย-เย็น") {
                                                echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-sunset"></i>ช่วงบ่าย-เย็น</span><br>';
                                            } else if ($time[$i] == "ค่ำ") {
                                                echo '<span class="text-dark"><i class="mr-1 mdi mdi-weather-night"></i>ช่วงค่ำ</span><br>';
                                            } else if ($time[$i] == "เต็มวัน") {
                                                echo '<span class="text-dark"><i class="mr-1 mdi mdi-clock"></i>เต็มวัน (เช้า-เย็น)</span><br>';
                                            } else {
                                                echo '-';
                                            }
                                        }
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_time_yes" name="add_offer_time">
                                                <label class="form-group-label" for="add_offer_time_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_time_no" name="add_offer_time">
                                                <label class="form-group-label" for="add_offer_time_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_time_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <span class="text-dark font-weight-bolder mr-3">ราคาต่อชั่วโมง:</span>
                                    <span class="text-dark">ไม่เกิน <?= $row['price'] ?> บาท</span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex flex-row m-0">
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input" type="radio" value="yes" id="add_offer_price_yes" name="add_offer_price">
                                                <label class="form-group-label" for="add_offer_price_yes">ตกลง</label>
                                            </div>
                                            <div class="form-group m-0 ml-3">
                                                <input class="form-group-input text-primary" type="radio" value="no" id="add_offer_price_no" name="add_offer_price">
                                                <label class="form-group-label" for="add_offer_price_no">ไม่ตกลง</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-dark font-weight-light" id="add_offer_price_remark" placeholder="เพิ่มคำอธิบาย (ไม่จำเป็น)" maxlength="500">
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="row p-3">
                        <div class="col-md-12 m-0">
                            <div class="form-group m-0">
                                <label for="message-text" class="col-form-label p-0 mb-3 font-weight-bolder">รายละเอียดเพิ่มเติม:</label>
                                <textarea id="add_offer_descrip" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="submitOffer();">ยื่นข้อเสนอ</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".summernote").summernote({
            disableDragAndDrop: true,
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
            // callbacks: {
            //     onImageUpload: function(image) {
            //         editor = $(this);
            //         myfile.push(image[0]);
            //         console.log(myfile);
            //         //uploadImageContent(image[0], editor);

            //     }
            // }
        });
    });

    function uploadImageContent(image, editor) {
        var data = new FormData();
        data.append("image", image);

        $.ajax({
            url: "src/images/img_summernote/upload.php",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                console.log(url);

                var image = $('<img>').attr('src', url);
                $(editor).summernote("insertNode", image[0]);

            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    function a() {
        var srcList = [];
        var rawHtml = $($('#add_offer_descrip').summernote('code'));
        rawHtml.find('img').each(function(i, data) {
            srcList.push(data.src);
        });
        console.log(rawHtml);

        // $(".summernote").summernote({
        //     callbacks: {
        //         onImageUpload: function(image) {
        //             editor = $(this);
        //             console.log(image[0]);
        //             uploadImageContent(image[0], editor);

        //         }
        //     }
        // });


    }

    function submitOffer() {
        console.log('click submit' + "");
        var empty_input = 0;
        var text_alert = "";
        if (!$("input[name='add_offer_subject']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับหมวดวิชา";
            $("[name='add_offer_subject']").focus();

        } else if (!$("input[name='add_offer_level']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับระดับชั้น";
            $("[name='add_offer_level']").focus();

        } else if (!$("input[name='add_offer_purpose']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับเป้าหมายการเรียน";
            $("[name='add_offer_purpose']").focus();

        } else if (!$("input[name='add_offer_channel']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับช่องทางการเรียน";
            $("[name='add_offer_channel']").focus();

        } else if (!$("input[name='add_offer_gtype']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับรูปแบบการติว";
            $("[name='add_offer_gtype']").focus();

        } else if (!$("input[name='add_offer_day']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับวันที่ติว";
            $("[name='add_offer_day']").focus();

        } else if (!$("input[name='add_offer_time']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับช่วงเวลา";
            $("[name='add_offer_time']").focus();

        } else if (!$("input[name='add_offer_price']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาเลือกข้อตกลงสำหรับราคาต่อชั่วโมง";
            $("[name='add_offer_price']").focus();

        } else {
            var offer_data = {
                'post_id': <?= $post_id ?>,
                'cf_subject': $("input[name='add_offer_subject']:checked").val(),
                'rm_subject': $("#add_offer_subject_remark").val(),
                'cf_level': $("input[name='add_offer_level']:checked").val(),
                'rm_level': $("#add_offer_level_remark").val(),
                'cf_purpose': $("input[name='add_offer_purpose']:checked").val(),
                'rm_purpose': $("#add_offer_purpose_remark").val(),
                'cf_price': $("input[name='add_offer_price']:checked").val(),
                'rm_price': $("#add_offer_price_remark").val(),
                'cf_channel': $("input[name='add_offer_channel']:checked").val(),
                'rm_channel': $("#add_offer_channel_remark").val(),
                'cf_gtype': $("input[name='add_offer_gtype']:checked").val(),
                'rm_gtype': $("#add_offer_gtype_remark").val(),
                'cf_day': $("input[name='add_offer_day']:checked").val(),
                'rm_day': $("#add_offer_day_remark").val(),
                'cf_time': $("input[name='add_offer_time']:checked").val(),
                'rm_time': $("#add_offer_time_remark").val(),
                'descrip': $('#add_offer_descrip').val(),
                'create_by': "<?= $_SESSION['username'] ?>",
            };

            console.log(offer_data);

            Swal.fire({
                title: 'คุณต้องการส่งข้อเสนอการสอน ?',
                text: "คุณไม่สามารถแก้ไขข้อเสนอได้ในภายหลัง",
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
                        url: "ajax/action/add_offer.php",
                        data: offer_data,
                        // processData: false,
                        // dataType: "json",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);
                            $("#modal_add_offer").modal("toggle");
                            Swal.fire({
                                icon: 'success',
                                title: 'ส่งข้อเสนอของคุณแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            showOffer();
                        },
                        error: function(error) {
                            console.log('AJAX Error: ' + error);
                        }
                    });

                }
            })
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