<?php
require_once("../../connection/connect_db.php");
session_start();

$course_id = $_POST['id'];

$sql = "SELECT * FROM `tbl_course` 
        WHERE `id` = $course_id;";
$result = mysqli_query($conn, $sql);

?>
<div class="modal fade" id="modal_edit_course" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_course" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขงานสอนพิเศษ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="unlinkFile();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0efff;">
                <?php
                if (mysqli_num_rows($result) != 0) {
                    foreach ($result as $row) {

                ?>
                        <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                            <form id="edit_course_form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group m-0 p-0">
                                            <?php $cover = $row['cover']; ?>
                                            <img src="./assets/images/cover_course/<?= $row['cover'] ?>" id="edit_cover" alt="Image placeholder" width="50%" class="card-img-top" style="padding-top: 10px;">
                                            <form method="post">
                                                <input type="file" name="image-2" class="image" id="upload_cover" accept="image/*" style="display:none; visibility:hidden;">
                                            </form>
                                            <div class="d-flex flex-row justify-content-center">
                                                <button type="button" class="btn btn-secondary btn-sm mt-2" id="change_cover"><i class="mdi mdi-image-area mr-1"></i>เปลี่ยนรูปหน้าปก</button>
                                                <button type="button" class="btn btn-secondary btn-sm mt-2 ml-3 d-none" id="reset_cover" onclick="resetCover();"><i class="mdi mdi-replay mr-1"></i>รีเซต</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group m-0 p-0">
                                            <label for="edit_title" class="col-form-label font-weight-bolder">หัวเรื่อง: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm text-dark " id="edit_title" maxlength="100" value="<?= $row['title'] ?>">
                                            <div id="edit_title_count" class="text-secondary">
                                                <span id="edit_title_current">0</span>
                                                <span id="edit_title_max">/ 100</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group m-0 p-0">
                                            <label for="edit_title" class="col-form-label font-weight-bolder">แนะนำรายวิชาแบบสั้น ๆ: <span class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-sm text-dark " rows="3" id="edit_intro" maxlength="255"><?= $row['intro'] ?></textarea>
                                            <div id="edit_intro_count" class="text-secondary">
                                                <span id="edit_intro_current">0</span>
                                                <span id="edit_intro_max">/ 255</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="edit_subject" class="col-form-label font-weight-bolder">หมวดวิชา: <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm text-dark mr-3" id="edit_subject">
                                                <option value="" <?= $row['subject'] == "" ? "selected" : "" ?>>- เลือก -</option>
                                                <?php
                                                $sql_subject = "SELECT subject FROM tbl_subjects ORDER BY subject";
                                                $result_subject = mysqli_query($conn, $sql_subject);
                                                foreach ($result_subject as $row_subject) {
                                                    echo "<option value='$row_subject[subject]'" . ( $row_subject['subject'] == $row['subject'] ? "selected" : "") . ">$row_subject[subject]</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-3">
                                        <div class="form-group">
                                            <label for="edit_level" class="col-form-label font-weight-bolder">ระดับชั้น: <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm text-dark mr-3" id="edit_level">
                                                <option value=""  <?= !$row['level'] ? "selected" : "" ?>>- เลือก -</option>
                                                <option value="0" <?= $row['level'] == 0 ? "selected" : "" ?>>อนุบาล</option>
                                                <option value="1" <?= $row['level'] == 1 ? "selected" : "" ?>>ประถมศึกษา</option>
                                                <option value="2" <?= $row['level'] == 2 ? "selected" : "" ?>>มัธยมศึกษาต้น</option>
                                                <option value="3" <?= $row['level'] == 3 ? "selected" : "" ?>>มัธยมศึกษาตอนปลาย</option>
                                                <option value="4" <?= $row['level'] == 4 ? "selected" : "" ?>>มหาวิทยาลัย</option>
                                                <option value="5" <?= $row['level'] == 5 ? "selected" : "" ?>>บุคคลทั่วไป</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="edit_purpose" class="col-form-label font-weight-bolder">เป้าหมายการสอน: <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm text-dark mr-3" id="edit_purpose">
                                                <option value=""  <?= !$row['purpose']  ? "selected" : "" ?>>- เลือก -</option>
                                                <option value="0" <?= $row['purpose'] == 0 ? "selected" : "" ?>>ความรู้ในงานประจำ</option>
                                                <option value="1" <?= $row['purpose'] == 1 ? "selected" : "" ?>>งานอดิเรก</option>
                                                <option value="2" <?= $row['purpose'] == 2 ? "selected" : "" ?>>เพื่อการแข่งขัน</option>
                                                <option value="3" <?= $row['purpose'] == 3 ? "selected" : "" ?>>เพื่อการแสดง</option>
                                                <option value="4" <?= $row['purpose'] == 4 ? "selected" : "" ?>>เพิ่มเกรด</option>
                                                <option value="5" <?= $row['purpose'] == 5 ? "selected" : "" ?>>เพิ่มทักษะ/เสริมความรู้ความเข้าใจ</option>
                                                <option value="6" <?= $row['purpose'] == 6 ? "selected" : "" ?>>ทำการบ้าน</option>
                                                <option value="7" <?= $row['purpose'] == 7 ? "selected" : "" ?>>ทำข้อสอบเข้าเรียน</option>
                                                <option value="8" <?= $row['purpose'] == 8 ? "selected" : "" ?>>ทำข้อสอบวัดระดับ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="edit_price" class="col-form-label font-weight-bolder font-weight-bolder">ราคาต่อชั่วโมง (บาท): <span class="text-danger">*</span></label>
                                            <input type="number" id="edit_price" class="form-control form-control-sm text-dark " min="0" step="50" value="<?= $row['price'] ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <div class="d-flex flex-row m-0" id="select_channel">
                                                <label for="select_channel" class="font-weight-bolder">ช่องทางการสอน: <span class="text-danger">*</span></label>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="ออนไลน์" id="edit_channel_1" name="edit_channel" <?= ( str_contains($row['channel'], "ออนไลน์") ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_channel_1">ออนไลน์</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input text-primary" type="checkbox" value="ตัวต่อตัว" id="edit_channel_2" name="edit_channel" <?= ( str_contains($row['channel'], "ตัวต่อตัว") ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_channel_2">ตัวต่อตัว</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <div class="d-flex flex-row m-0" id="select_gtype">
                                                <label for="select_gtype" class="font-weight-bolder">ติวแบบ: <span class="text-danger">*</span></label>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="radio" value="ติวเดี่ยว" id="edit_gtype_1" name="edit_gtype" <?= ( $row['group_type'] = "ติวเดี่ยว" ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_gtype_1">ติวเดี่ยว</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="radio" value="กลุ่ม 2-5 คน" id="edit_gtype_2" name="edit_gtype" <?= ( $row['group_type'] = "กลุ่ม 2-5 คน" ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_gtype_2">กลุ่ม 2-5 คน</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="radio" value="กลุ่ม 6-10 คน" id="edit_gtype_3" name="edit_gtype" <?= ( $row['group_type'] = "กลุ่ม 6-10 คน" ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_gtype_3">กลุ่ม 6-10 คน</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="radio" value="กลุ่ม 11 คนขึ้นไป" id="edit_gtype_4" name="edit_gtype" <?= ( $row['group_type'] = "กลุ่ม 11 คนขึ้นไป" ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_gtype_4">กลุ่ม 11 คนขึ้นไป</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="radio" value="ไม่จำกัด" id="edit_gtype_5" name="edit_gtype" <?= ( $row['group_type'] = "ไม่จำกัด" ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_gtype_5">ไม่จำกัด</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <?php print_r($row['day'])?>
                                        <div class="form-group">
                                            <div class="d-flex flex-row m-0">
                                                <label class="font-weight-bolder">วันที่สอน: <span class="text-danger">*</span></label>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="mon" id="edit_day_mon" name="edit_day" <?= ( str_contains($row['day'], "mon") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:gold; " for="edit_day_mon">จันทร์</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="tue" id="edit_day_tue" name="edit_day" <?= ( str_contains($row['day'], "tue") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:pink; " for="edit_day_tue">อังคาร</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="wed" id="edit_day_wed" name="edit_day" <?= ( str_contains($row['day'], "wed") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:yellowgreen; " for="edit_day_wed">พุธ</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="thu" id="edit_day_thu" name="edit_day" <?= ( str_contains($row['day'], "thu") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:orange; " for="edit_day_thu">พฤหัสบดี</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="fri" id="edit_day_fri" name="edit_day" <?= ( str_contains($row['day'], "fri") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:blue; " for="edit_day_fri">ศุกร์</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="sat" id="edit_day_sat" name="edit_day" <?= ( str_contains($row['day'], "sat") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:purple; " for="edit_day_sat">เสาร์</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="sun" id="edit_day_sun" name="edit_day" <?= ( str_contains($row['day'], "sun") ? "checked" : "") ?>>
                                                    <label class="form-group-label " style="color:red; " for="edit_day_sun">อาทิตย์</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <div class="d-flex flex-row m-0" id="edit_time">
                                                <label for="edit_time" class="font-weight-bolder">ช่วงเวลา: <span class="text-danger">*</span></label>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="เช้า-เที่ยง" id="edit_time1" name="edit_time" <?= ( str_contains($row['time'], "เช้า-เที่ยง") ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_time1">ช่วงเช้า-เที่ยง</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="บ่าย-เย็น" id="edit_time2" name="edit_time" <?= ( str_contains($row['time'], "บ่าย-เย็น") ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_time2">ช่วงบ่าย-เย็น</label>
                                                </div>
                                                <div class="form-group m-0 ml-3">
                                                    <input class="form-group-input" type="checkbox" value="ค่ำ" id="edit_time3" name="edit_time" <?= ( str_contains($row['time'], "ค่ำ") ? "checked" : "") ?>>
                                                    <label class="form-group-label " for="edit_time3">ช่วงค่ำ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-0 mb-3">
                                        <div class="form-group m-0">
                                            <label for="message-text" class="col-form-label font-weight-bolder">รายละเอียดเพิ่มเติม:</label>
                                            <textarea id="edit_course_descrip" class="summernote"><?= $row['course_descrip'] ?></textarea>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="unlinkFile();">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="updatePost();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_cropper" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-a modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ครอปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" class="img_m" id="sample_cover" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview" id="preview2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="crop_2" class="btn btn-primary btn-sm">ตัด</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".summernote").summernote({
                        placeholder: 'ระบุรายละเอียดงานสอนของคุณ',
                        tabsize: 2,
                        height: 400,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
			    ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            //['insert', ['link']],
                            ['insert', ['link', 'picture']],
                            // ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
    });

    $('#edit_title_current').text($('#edit_title').val().length);

    $('#edit_title').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#edit_title_current'),
            maximum_count = $('#edit_title_max'),
            count = $('#edit_title_count');
        current_count.text(characterCount);
    });

    $('#edit_intro_current').text($('#edit_intro').val().length);

    $('#edit_intro').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#edit_intro_current'),
            maximum_count = $('#edit_intro_max'),
            count = $('#edit_intro_count');
        current_count.text(characterCount);
    });

    $("#change_cover").click(function() {
        $("#upload_cover").click();
    });

    var $modal2 = $('#modal_cropper');
    var image2 = document.getElementById('sample_cover');
    var cropper2;
    var temp_cover = "";
    var cover_old = "<?= $cover ?>";

    
    $('#upload_cover').change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image2.src = url;
            $modal2.modal('show');
        };
      
        if (files && files.length > 0) {
           
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
            
        }
    });

    $modal2.on('shown.bs.modal', function() {
        cropper2 = new Cropper(image2, {
            aspectRatio: 16 / 9,
            viewMode: 3,
            preview: '#preview2'
        });
    }).on('hidden.bs.modal', function() {
        cropper2.destroy();
        cropper2 = null;
    });

    $("#crop_2").click(function() {
        canvas2 = cropper2.getCroppedCanvas({
            width: 500,
            height: 400,
        });

        canvas2.toBlob(function(blob) {
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data2 = reader.result;

                unlinkFile();
                $.ajax({
                    url: "ajax/action/upload_image.php",
                    method: "POST",
                    data: {
                        image: base64data2
                    },
                    success: function(response) {
                        temp_cover = response;
                        console.log(temp_cover);
                        $modal2.modal('hide');
                        $('#edit_cover').attr('src', 'temp/images/' + response);
                        $("#reset_cover").removeClass("d-none");
                    }
                });

            }
        });
    });

    function updatePost() {
        console.log('click update');
        var empty_input = 0;
        var text_alert = "";
        if (!$('#edit_title').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหัวเรื่อง";
            $("#edit_title").focus();
        } else if (!$('#edit_intro').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุคำแนะนำรายวิชา";
            $("#edit_intro").focus();
        } else if (!$('#edit_subject').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหมวดวิชา";
            $("#edit_subject").focus();
        } else if (!$('#edit_level').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุระดับชั้น";
            $("#edit_level").focus();
        } else if (!$('#edit_purpose').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุเป้าหมายการสอน";
            $(!"#edit_purpose").focus();
        } else if (!$('#edit_price').val() || $('#edit_price').val() < 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุราคาต่อชั่วโมง ตั้งแต่ 0 บาทขึ้นไป";
            $("#edit_price").focus();
        } else if ($('input[name="edit_channel"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่องทางการสอน";
            $('input[name="edit_channel"]').focus();
        } else if (!$("input[name='edit_gtype']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรูปแบบการติว";
            $("#edit_gtype").focus();
        } else if ($('input[name="edit_day"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุวันที่สอน";
            $('input[name="edit_day"]').focus();
        } else if ($('input[name="edit_time"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่วงเวลา";
            $('input[name="edit_time"]').focus();
        } else {
            var channel = new Array();
            $("input[name='edit_channel']:checked").each(function() {
                channel.push($(this).val());
            });
            var day = new Array();
            $("input[name='edit_day']:checked").each(function() {
                day.push($(this).val());
            });
            var time = new Array();
            $("input[name='edit_time']:checked").each(function() {
                time.push($(this).val());
            });

            var course_data = {
                'username': "<?= $_SESSION['username'] ?>",
                'id': <?= $course_id ?>,
                'title': $('#edit_title').val(),
                'intro': $('#edit_intro').val(),
                'subject': $('#edit_subject').val(),
                'level': $('#edit_level').val(),
                'purpose': $('#edit_purpose').val(),
                'price': $('#edit_price').val(),
                'channel': JSON.stringify(channel),
                'gtype': $("input[name='edit_gtype']:checked").val(),
                'day': JSON.stringify(day),
                'time': JSON.stringify(time),
                'descrip': $('#edit_course_descrip').val(),
                'cover_old': cover_old,
                'cover_new': temp_cover,
            };

            Swal.fire({
                title: 'คุณต้องการอัปเดตงานสอน ?',
                text: "งานสอนของคุณจะถูกบันทึกและแสดงเป็นสาธารณะ",
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
                        url: "ajax/action/edit_course.php",
                        data: course_data,
                        // processData: false,
                        // dataType: "json",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);
                            $("#modal_edit_course").modal("toggle");
                            Swal.fire({
                                icon: 'success',
                                title: 'อัปเดตงานสอนแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            showCourseDetail();
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

    function unlinkFile() {
        if (temp_cover) {
            $.ajax({
                url: "ajax/action/unlink_file.php",
                type: "POST",
                data: {
                    path: 'temp/images/' + temp_cover,
                },
                success: function(response) {
                    console.log('unlink: ' + response);
                }
            });
        }
    }

    function resetCover() {
        unlinkFile();
        $("#reset_cover").addClass("d-none");
        $('#edit_cover').attr('src', './assets/images/cover_course/' + cover_old);
        temp_cover = "";
    }
</script>