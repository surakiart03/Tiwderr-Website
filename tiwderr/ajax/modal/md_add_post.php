<?php
require_once("../../connection/connect_db.php");
?>
<div class="modal fade" id="modal_add_post" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_add_course" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white"><i class="mdi mdi-script m-0 mr-1" style="font-size: 1.25rem;"></i>เพิ่มประกาศหาติวเตอร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #d4fff7;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <div class="row p-3">
                        <h5><i class="mdi mdi-alert-circle mr-1"></i>โปรดทราบ</h5>
                        <ol>
                            <li>เมื่อคุณโพสต์ประกาศหาติวเตอร์แล้ว <span class="text-danger">จะไม่สามารถแก้ไขได้</span> (ยกเว้น เนื้อหารายละเอียดเพิ่มเติม)</li>
                            <li>โปรดระมัดระวังในการเพิ่มข้อมูลส่วนบุคคล</li>
                        </ol>

                    </div>
                    <hr class="m-0">
                    <form id="add_post_form">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group m-0 p-0">
                                    <label for="add_title" class="col-form-label font-weight-bolder">หัวเรื่อง:</label>
                                    <input type="text" class="form-control form-control-sm text-dark " id="add_title" maxlength="100">
                                    <div id="add_title_count" class="text-secondary">
                                        <span id="add_title_current">0</span>
                                        <span id="add_title_max">/ 100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="add_subject" class="col-form-label font-weight-bolder">หมวดวิชา:</label>
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
                                    <label for="add_level" class="col-form-label font-weight-bolder">ระดับชั้น:</label>
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
                                    <label for="add_purpose" class="col-form-label font-weight-bolder">เป้าหมายการเรียน:</label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="add_purpose">
                                        <option value="" selected>- เลือก -</option>
                                        <option value="0">ความรู้ในงานประจำ</option>
                                        <option value="1">งานอดิเรก</option>
                                        <option value="2">เพื่อการแข่งขัน</option>
                                        <option value="3">เพื่อการแสดง</option>
                                        <option value="4">เพิ่มเกรด</option>
                                        <option value="5">เพิ่มทักษะ/เสริมความรู้ความเข้าใจ</option>
                                        <option value="0">ทำการบ้าน</option>
                                        <option value="6">ทำข้อสอบเข้าเรียน</option>
                                        <option value="7">ทำข้อสอบวัดระดับ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="add_price" class="col-form-label font-weight-bolder">ราคาต่อชั่วโมง:</label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="add_price">
                                        <option value="" selected>- เลือก -</option>
                                        <option value="100">ไม่เกิน 100 บาท</option>
                                        <option value="150">ไม่เกิน 150 บาท</option>
                                        <option value="200">ไม่เกิน 200 บาท</option>
                                        <option value="250">ไม่เกิน 250 บาท</option>
                                        <option value="300">ไม่เกิน 300 บาท</option>
                                        <option value="350">ไม่เกิน 350 บาท</option>
                                        <option value="500">ไม่เกิน 500 บาท</option>
                                        <option value="1000">ไม่เกิน 1000 บาท</option>
                                        <option value="1500">ไม่เกิน 1500 บาท</option>
                                        <option value="2000">ไม่เกิน 2000 บาท</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0" id="select_channel">
                                        <label for="select_channel" class=" font-weight-bolder">ช่องทางการเรียน:</label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ออนไลน์" id="add_channel_1" name="add_channel">
                                            <label class="form-group-label " for="add_channel_1">ออนไลน์</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input text-primary" type="radio" value="ตัวต่อตัว" id="add_channel_2" name="add_channel">
                                            <label class="form-group-label " for="add_channel_2">ตัวต่อตัว</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input text-primary" type="radio" value="ตัวต่อตัว,ออนไลน์" id="add_channel_3" name="add_channel">
                                            <label class="form-group-label " for="add_channel_3">สะดวกทั้งสองช่องทาง</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0" id="select_gtype">
                                        <label for="select_gtype" class=" font-weight-bolder">ติวแบบ:</label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ติวเดี่ยว" id="add_gtype_1" name="add_gtype" onclick="channelFunction(0);">
                                            <label class="form-group-label " for="add_gtype_1">ติวเดี่ยว</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ติวกลุ่ม" id="add_gtype_2" name="add_gtype" onclick="channelFunction(1);">
                                            <label class="form-group-label " for="add_gtype_2">ติวกลุ่ม</label>
                                        </div>
                                        <div class="form-group m-0 ml-3" id="div_add_gtype_num" style="display: none;">
                                            <div class="d-flex flex-row" style="width: 130px;">
                                                <label class="form-group-label mr-1" for="add_gtype_num">จำนวน</label>
                                                <input type="number" class="form-control form-control-sm text-dark mr-1" id="add_gtype_num" min="2" step="1" value="2">
                                                <span>คน</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex flex-row m-0">
                                        <label class=" font-weight-bolder">วันเรียนที่สะดวก:</label>
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
                                        <label for="add_time" class=" font-weight-bolder">ช่วงเวลา:</label>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="เช้า-เที่ยง" id="add_time_1" name="add_time">
                                            <label class="form-group-label " for="add_time_1">ช่วงเช้า-เที่ยง</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="บ่าย-เย็น" id="add_time_2" name="add_time">
                                            <label class="form-group-label " for="add_time_2">ช่วงบ่าย-เย็น</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="ค่ำ" id="add_time_3" name="add_time">
                                            <label class="form-group-label " for="add_time_3">ช่วงค่ำ</label>
                                        </div>
                                        <div class="form-group m-0 ml-3">
                                            <input class="form-group-input" type="radio" value="เต็มวัน" id="add_time_4" name="add_time">
                                            <label class="form-group-label " for="add_time_4">เต็มวัน (เช้า-เย็น)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-0 mb-3">
                                <div class="form-group m-0">
                                    <label for="message-text" class="col-form-label  font-weight-bolder">รายละเอียดเพิ่มเติม:</label>
                                    <textarea id="add_post_descrip" class="summernote"></textarea>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success btn-sm" onclick="submitPost();">โพสต์</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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

    function channelFunction(num) {
        if (num == 0) {
            $('#div_add_gtype_num').hide();
        } else {
            $('#div_add_gtype_num').show();
        }
    }

    function submitPost() {
        console.log('click submit');
        var empty_input = 0;
        var text_alert = "";
        if (!$('#add_title').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุหัวเรื่อง";
            $("#add_title").focus();
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
            text_alert = "กรุณาระบุเป้าหมายการเรียน";
            $(!"#add_purpose").focus();
        } else if (!$('#add_price').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุราคาต่อชั่วโมง";
            $("#add_price").focus();
        } else if (!$("input[name='add_channel']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่องทางการเรียน";
            $('input[name="add_channel"]').focus();
        } else if (!$("input[name='add_gtype']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุรูปแบบการติว";
            $("#add_gtype").focus();
        } else if ($("input[name='add_gtype']:checked").val() == "ติวกลุ่ม" && (!$('#add_gtype_num').val() || $('#add_gtype_num').val() < 2)) {
            empty_input += 1;
            text_alert = "กรุณาระบุจำนวนผู้เรียนสำหรับติวกลุ่ม ตั้งแต่ 2 คนขึ้นไป";
            $("#add_gtype_num").focus();
        } else if ($('input[name="add_day"]:checked').length == 0) {
            empty_input += 1;
            text_alert = "กรุณาระบุวันเรียนที่สะดวก";
            $('input[name="add_day"]').focus();
        } else if (!$("input[name='add_time']:checked").val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุช่วงเวลา";
            $('input[name="add_time"]').focus();
        } else {
            var day = new Array();
            $("input[name='add_day']:checked").each(function() {
                day.push($(this).val());
            });

            var gtype = "";
            if ($("input[name='add_gtype']:checked").val() == "ติวกลุ่ม") {
                gtype = "ติวกลุ่ม (" + $('#add_gtype_num').val() + " คน)";
            } else {
                gtype = "ติวเดี่ยว";
            }

            var post_data = {
                'title': $('#add_title').val(),
                'subject': $('#add_subject').val(),
                'level': $('#add_level').val(),
                'purpose': $('#add_purpose').val(),
                'price': $('#add_price').val(),
                'channel': $("input[name='add_channel']:checked").val(),
                'gtype': gtype,
                'day': JSON.stringify(day),
                'time': $("input[name='add_time']:checked").val(),
                'descrip': $('#add_post_descrip').val(),
            };

            console.log(post_data);

            Swal.fire({
                title: 'คุณต้องการเพิ่มประกาศหาติวเตอร์ ?',
                text: "ประกาศของคุณจะถูกบันทึกและผู้ใช้ซึ่งเป็นสมาชิกในเว็บไซต์สามารถมองเห็นได้",
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
                        url: "ajax/action/add_post.php",
                        data: post_data,
                        // processData: false,
                        // dataType: "json",
                        //encode: true,
                        success: function(response) {
                            console.log('res: ' + response);
                            $("#modal_add_post").modal("toggle");
                            showPost();
                            Swal.fire({
                                icon: 'success',
                                title: 'เพิ่มประกาศหาติวเตอร์ของคุณแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
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