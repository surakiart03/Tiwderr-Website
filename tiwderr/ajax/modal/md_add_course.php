<?php
session_start();
require_once("../../connection/connect_db.php");
?>
<div class="modal fade" id="modal_add_course" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_course" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="mdi mdi-script m-0 mr-1" style="font-size: 1.25rem;"></i>เพิ่มงานสอนพิเศษ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="unlinkFile();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #e0efff;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <form id="add_course_form">
                        <div class="row">
			    <div class="col-2">
			    </div>
			    <div class="col-8 mb-3">
                                <div class="form-group m-0 p-0">
                                    <img src="./assets/images/cover_course/tiwderr1.jpg" id="add_cover" alt="Image placeholder" width="50%" class="card-img-top" style="padding-top: 10px;">
                                    <form method="post">
                                        <input type="file" name="image-2" class="image" id="upload_cover" accept="image/*" style="display:none; visibility:hidden;">
                                    </form>
                                    <div class="d-flex flex-row justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="change_cover"><i class="mdi mdi-image-area mr-1"></i>เปลี่ยนรูปหน้าปก</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm mt-2 ml-3 d-none" id="reset_cover" onclick="resetCover();"><i class="mdi mdi-replay mr-1"></i>รีเซต</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group m-0 p-0">
                                    <label for="add_title" class="col-form-label font-weight-bolder">หัวเรื่อง: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm text-dark " id="add_title" maxlength="100" value="">
                                    <div id="add_title_count" class="text-secondary">
                                        <span id="add_title_current">0</span>
                                        <span id="add_title_max">/ 100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group m-0 p-0">
                                    <label for="add_title" class="col-form-label font-weight-bolder">แนะนำรายวิชาแบบสั้น ๆ: <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-sm text-dark " rows="3" id="add_intro" maxlength="255"></textarea>
                                    <div id="add_intro_count" class="text-secondary">
                                        <span id="add_intro_current">0</span>
                                        <span id="add_intro_max">/ 255</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="add_subject" class="col-form-label font-weight-bolder">หมวดวิชา: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="add_subject">
                                        <option value="" selected>- เลือก -</option>
                                        <?php
                                        $sql_subject = "SELECT subject FROM tbl_subjects ORDER BY subject";
                                        $result_subject = mysqli_query($conn, $sql_subject);
                                        foreach ($result_subject as $row) {
                                            echo "<option value='$row[subject]' >$row[subject]</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3  mb-3">
                                <div class="form-group">
                                    <label for="add_level" class="col-form-label font-weight-bolder">ระดับชั้น: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="add_level">
                                        <option value="" selected>- เลือก -</option>
                                        <option value="0">อนุบาล</option>
                                        <option value="1">ประถมศึกษา</option>
                                        <option value="2">มัธยมศึกษาต้น</option>
                                        <option value="3">มัธยมศึกษาตอนปลาย</option>
                                        <option value="4">มหาวิทยาลัย</option>
                                        <option value="5">บุคคลทั่วไป</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="add_purpose" class="col-form-label font-weight-bolder">เป้าหมายการสอน: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="add_purpose">
                                        <option value="" selected>- เลือก -</option>
                                        <option value="0">ความรู้ในงานประจำ</option>
                                        <option value="1">งานอดิเรก</option>
                                        <option value="2">เพื่อการแข่งขัน</option>
                                        <option value="3">เพื่อการแสดง</option>
                                        <option value="4">เพิ่มเกรด</option>
                                        <option value="5">เพิ่มทักษะ/เสริมความรู้ความเข้าใจ</option>
                                        <option value="6">ทำการบ้าน</option>
                                        <option value="7">ทำข้อสอบเข้าเรียน</option>
                                        <option value="8">ทำข้อสอบวัดระดับ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="add_price" class="col-form-label font-weight-bolder font-weight-bolder">ราคาต่อชั่วโมง (บาท): <span class="text-danger">*</span></label>
                                    <input type="number" id="add_price" class="form-control form-control-sm text-dark " min="0" step="50">
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0" id="select_channel">
                                        <label for="select_channel" class="font-weight-bolder">ช่องทางการสอน: <span class="text-danger">*</span></label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="ออนไลน์" id="add_channel_1" name="add_channel">
                                            <label class="form-group-label " for="add_channel_1">ออนไลน์</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input text-primary" type="checkbox" value="ตัวต่อตัว" id="add_channel_2" name="add_channel">
                                            <label class="form-group-label " for="add_channel_2">ตัวต่อตัว</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0" id="select_gtype">
                                        <label for="select_gtype" class="font-weight-bolder">ติวแบบ: <span class="text-danger">*</span></label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ติวเดี่ยว" id="add_gtype_1" name="add_gtype">
                                            <label class="form-group-label " for="add_gtype_1">ติวเดี่ยว</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="กลุ่ม 2-5 คน" id="add_gtype_2" name="add_gtype">
                                            <label class="form-group-label " for="add_gtype_2">กลุ่ม 2-5 คน</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="กลุ่ม 6-10 คน" id="add_gtype_3" name="add_gtype">
                                            <label class="form-group-label " for="add_gtype_3">กลุ่ม 6-10 คน</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="กลุ่ม 11 คนขึ้นไป" id="add_gtype_4" name="add_gtype">
                                            <label class="form-group-label " for="add_gtype_4">กลุ่ม 11 คนขึ้นไป</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ไม่จำกัด" id="add_gtype_5" name="add_gtype">
                                            <label class="form-group-label " for="add_gtype_5">ไม่จำกัด</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0">
                                        <label class="font-weight-bolder">วันที่สอน: <span class="text-danger">*</span></label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="mon" id="add_day_mon" name="add_day">
                                            <label class="form-group-label " style="color:gold; " for="add_day_mon">จันทร์</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="tue" id="add_day_tue" name="add_day">
                                            <label class="form-group-label " style="color:pink; " for="add_day_tue">อังคาร</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="wed" id="add_day_wed" name="add_day">
                                            <label class="form-group-label " style="color:yellowgreen; " for="add_day_wed">พุธ</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="thu" id="add_day_thu" name="add_day">
                                            <label class="form-group-label " style="color:orange; " for="add_day_thu">พฤหัสบดี</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="fri" id="add_day_fri" name="add_day">
                                            <label class="form-group-label " style="color:blue; " for="add_day_fri">ศุกร์</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="sat" id="add_day_sat" name="add_day">
                                            <label class="form-group-label " style="color:purple; " for="add_day_sat">เสาร์</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="sun" id="add_day_sun" name="add_day">
                                            <label class="form-group-label " style="color:red; " for="add_day_sun">อาทิตย์</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0" id="add_time">
                                        <label for="add_time" class="font-weight-bolder">ช่วงเวลา: <span class="text-danger">*</span></label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="เช้า-เที่ยง" id="add_time1" name="add_time">
                                            <label class="form-group-label " for="add_time1">ช่วงเช้า-เที่ยง</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="บ่าย-เย็น" id="add_time2" name="add_time">
                                            <label class="form-group-label " for="add_time2">ช่วงบ่าย-เย็น</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="checkbox" value="ค่ำ" id="add_time3" name="add_time">
                                            <label class="form-group-label " for="add_time3">ช่วงค่ำ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-0 mb-3">
                                <div class="form-group m-0">
                                    <label for="message-text" class="col-form-label font-weight-bolder">รายละเอียดเพิ่มเติม:</label>
                                    <textarea id="add_course_descrip" class="summernote"></textarea>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="unlinkFile();">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitPost();">โพสต์</button>
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

    $('#add_title').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#add_title_current'),
            maximum_count = $('#add_title_max'),
            count = $('#add_title_count');
        current_count.text(characterCount);
    });

    $('#add_intro').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#add_intro_current'),
            maximum_count = $('#add_intro_max'),
            count = $('#add_intro_count');
        current_count.text(characterCount);
    });

    $("#change_cover").click(function() {
        $("#upload_cover").click();
    });

    var $modal2 = $('#modal_cropper');
    var image2 = document.getElementById('sample_cover');
    var cropper2;
    var temp_cover = "";

    //$("body").on("change", ".image", function(e){
    $('#upload_cover').change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image2.src = url;
            $modal2.modal('show');
        };
        //var reader;
        //var file;
        //var url;

        if (files && files.length > 0) {
            /*file = files[0];
      		if(URL)
      		{
        		done(URL.createObjectURL(file));
      		}
      		else if(FileReader)
      		{*/
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
            //}
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
            //url = URL.createObjectURL(blob);
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
                        $('#add_cover').attr('src', 'temp/images/' + response);
                        $("#reset_cover").removeClass("d-none");
                    }
                });

            }
        });
    });

    function submitPost() {
        console.log('click submit');
        var empty_input = 0;
        var text_alert = "";
        if (!$('#add_title').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหัวเรื่อง";
            $("#add_title").focus();
            //$("#add_title").css({'background-color': 'red'});
        } else if (!$('#add_intro').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุคำแนะนำรายวิชา";
            $("#add_intro").focus();
        } else if (!$('#add_subject').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหมวดวิชา";
            $("#add_subject").focus();
        } else if (!$('#add_level').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุระดับชั้น";
            $("#add_level").focus();
        } else if (!$('#add_purpose').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุเป้าหมายการสอน";
            $(!"#add_purpose").focus();
        } else if (!$('#add_price').val() || $('#add_price').val() < 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุราคาต่อชั่วโมง ตั้งแต่ 0 บาทขึ้นไป";
            $("#add_price").focus();
        } else if ($('input[name="add_channel"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่องทางการสอน";
            $('input[name="add_channel"]').focus();
        } else if (!$("input[name='add_gtype']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรูปแบบการติว";
            $("#add_gtype").focus();
        } else if ($('input[name="add_day"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุวันที่สอน";
            $('input[name="add_day"]').focus();
        } else if ($('input[name="add_time"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่วงเวลา";
            $('input[name="add_time"]').focus();
        } else {
            var channel = new Array();
            $("input[name='add_channel']:checked").each(function() {
                channel.push($(this).val());
            });
            var day = new Array();
            $("input[name='add_day']:checked").each(function() {
                day.push($(this).val());
            });
            var time = new Array();
            $("input[name='add_time']:checked").each(function() {
                time.push($(this).val());
            });

            var course_data = {
                'title': $('#add_title').val(),
                'intro': $('#add_intro').val(),
                'subject': $('#add_subject').val(),
                'level': $('#add_level').val(),
                'purpose': $('#add_purpose').val(),
                'price': $('#add_price').val(),
                'channel': JSON.stringify(channel),
                'gtype': $("input[name='add_gtype']:checked").val(),
                'day': JSON.stringify(day),
                'time': JSON.stringify(time),
                'descrip': $('#add_course_descrip').val(),
                'cover': temp_cover,
            };

            Swal.fire({
                title: 'คุณต้องการเพิ่มงานสอน ?',
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
                        url: "ajax/action/add_course.php",
                        data: course_data,
                        // processData: false,
                        // dataType: "json",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);
                            $("#modal_add_course").modal("toggle");
                            Swal.fire({
                                icon: 'success',
                                title: 'เพิ่มงานสอนของคุณแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            showCourse();
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
            path = ['temp/images/' + temp_cover];
            $.ajax({
                url: "ajax/action/unlink_file.php",
                type: "POST",
                data: {
                    path: JSON.stringify(path),
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
        $('#add_cover').attr('src', './assets/images/cover_course/tiwderr1.jpg');
        temp_cover = "";
    }
</script>