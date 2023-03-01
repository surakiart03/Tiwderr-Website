<?php
session_start();
require_once("../../connection/connect_db.php");

?>
<div class="modal left fade" id="modal_filter_course" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal_filter_course" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="width:380px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="mdi mdi-filter m-0 mr-1"></i>ตัวกรอง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-3 mt-2">
                            <!-- <span class="text-nowrap mr-3 pt-2">คำค้นหา</span> -->
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm text-dark" id="search_tutor_finder_ads" placeholder="ค้นหา" value="">
                                <div class="input-group-append">
                                    <span class="mdi mdi-magnify input-group-text" style="font-size:1.5rem;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">คะแนน</span>
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input text-primary" type="radio" value="5" id="rate_5" name="rate">
                                    <label class="form-check-label" for="rate_5">5 ดาวขึ้นไป</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="4" id="rate_4" name="rate">
                                    <label class="form-check-label" for="rate_4">4 ดาวขึ้นไป</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="3" id="rate_3" name="rate">
                                    <label class="form-check-label" for="rate_3">3 ดาวขึ้นไป</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input text-primary" type="radio" value="2" id="rate_2" name="rate">
                                    <label class="form-check-label" for="rate_2">2 ดาวขึ้นไป</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="1" id="rate_1" name="rate">
                                    <label class="form-check-label" for="rate_1">1 ดาวขึ้นไป</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">หมวดวิชา</span>
                            <select class="form-control form-control-sm text-dark mr-3" id="subject">
                                <option value="" selected>เลือก</option>
                                        <?php
                                        $sql_subject = "SELECT subject FROM tbl_subjects ORDER BY subject";
                                        $result_subject = mysqli_query($conn, $sql_subject);
                                        foreach ($result_subject as $row) {
                                            echo "<option value='$row[subject]' >$row[subject]</option>";
                                        }
                                        ?>

                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">ระดับชั้น</span>
                            <select class="form-control form-control-sm text-dark mr-3" id="level">
                                <option value="" selected>เลือก</option>
                                <option value="0">อนุบาล</option>
                                <option value="1">ประถมศึกษา</option>
                                <option value="2">มัธยมศึกษาต้น</option>
                                <option value="3">มัธยมศึกษาตอนปลาย</option>
                                <option value="4">มหาวิทยาลัย</option>
                                <option value="5">บุคคลทั่วไป</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">เป้าหมายการเรียน</span>
                            <select class="form-control form-control-sm text-dark mr-3" id="purpose">
                                <option value="" selected>เลือก</option>
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

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">ราคาต่อชั่วโมง</span>
                            <div class="d-flex flex-row">
                                <input type="number" class="form-control form-control-sm text-dark" value="0" min="0" step="50" size="3" id="min_range">
                                <span class="text-nowrap mx-3 pt-2">ถึง</span>
                                <input type="number" class="form-control form-control-sm text-dark" value="0" min="0" step="50" id="max_range">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">ช่องทางการเรียน</span>
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input text-primary" type="checkbox" value="ออนไลน์" id="channel_1" name="channel">
                                    <label class="form-check-label" for="channel_1">ออนไลน์</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="ตัวต่อตัว" id="channel_2" name="channel">
                                    <label class="form-check-label" for="channel_2">ตัวต่อตัว</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">รัศมีค้นหา</span>
                            <div class="form-group w-100">
                                <input type="range" class="form-control form-control-sm-range" id="formControlRange2" min="5" max="20" value="5" disabled>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="form-check mr-2">
                                    <input class="form-check-input " type="checkbox" name="check_slider" id="check_slider" >
                                    <label class="form-check-label text-nowrap" for="check_slider">จำกัด</label>
                                </div>
                                <div class="slider-container m-0 p-0">
                                    <input type="text" id="slider_gps" class="slider rs-selected text-center" value="5" disabled="disabled" />
                                    <span class="ml-2">กิโลเมตร</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">ติวแบบ</span>
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input text-primary" type="radio" value="ติวเดี่ยว" id="gtype_1" name="gtype">
                                    <label class="form-check-label" for="gtype_1">ติวเดี่ยว</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="กลุ่ม 2-5 คน" id="gtype_2" name="gtype">
                                    <label class="form-check-label" for="gtype_2">กลุ่ม 2-5 คน</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="กลุ่ม 6-10 คน" id="gtype_3" name="gtype">
                                    <label class="form-check-label" for="gtype_3">กลุ่ม 6-10 คน</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="กลุ่ม 11 คนขึ้นไป" id="gtype_4" name="gtype">
                                    <label class="form-check-label" for="gtype_4">กลุ่ม 11 คนขึ้นไป</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="ไม่จำกัด" id="gtype_5" name="gtype">
                                    <label class="form-check-label" for="gtype_5">ไม่จำกัด</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">เพศผู้สอน</span>
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ชาย" id="gender_m" name="gender">
                                    <label class="form-check-label" for="gender_m">ชาย</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="หญิง" id="gender_f" name="gender">
                                    <label class="form-check-label" for="gender_f">หญิง</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="LGBTQ+" id="gender_lgbtq" name="gender">
                                    <label class="form-check-label" for="gender_lgbtq">LGBTQ+</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="text-nowrap mr-3 pt-2">วันเรียน</span>
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mon" id="day_mon" name="day">
                                    <label class="form-check-label" style="color:gold; " for="day_mon">จันทร์</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="tue" id="day_tue" name="day">
                                    <label class="form-check-label" style="color:pink; " for="day_tue">อังคาร</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="wed" id="day_wed" name="day">
                                    <label class="form-check-label" style="color:yellowgreen;" for="day_wed">พุธ</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="thu" id="day_thu" name="day">
                                    <label class="form-check-label" style="color:orange; " for="day_thu">พฤหัสบดี</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="d-flex flex-row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="fri" id="day_fri" name="day">
                                    <label class="form-check-label" style="color:blue; " for="day_fri">ศุกร์</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="sat" id="day_sat" name="day">
                                    <label class="form-check-label" style="color:purple; " for="day_sat">เสาร์</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" value="sun" id="day_sun" name="day">
                                    <label class="form-check-label" style="color:red; " for="day_sun">อาทิตย์</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
	    <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="ClearValue();"><i class="mdi mdi-replay"></i><span class="ml-2">ล้างค่า</span></button>
                <button type="button" class="btn btn-primary btn-sm" name="search_tutor_advance" id="search_tutor_advance"><i class="mdi mdi-magnify"></i><span class="ml-2">ค้นหา</span></button>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var sort = $("#sort").val() ?? '0';
        showCourse();
        $('#formControlRange2').on('input', function(event) {
            var valSlider1 = $(this).val();
            $('#slider_gps').attr('value', valSlider1);
        });

        $("#check_slider").change(function() {
            var ckb_status = $("#check_slider").prop('checked');
            if (ckb_status) {
                document.getElementById('formControlRange2').disabled = !document.getElementById('formControlRange2').disabled;
            } else {
                document.getElementById('formControlRange2').disabled = !document.getElementById('formControlRange2').disabled;
                $('#slider_gps').attr('value', 5);
                $("#formControlRange2").val(5);
            }
        });

        $("#search_tutor_advance").click(function() {
            var check_range = $('#check_slider').is(':checked');
            var sort = $("#sort").val() ?? '0';
            console.log(check_range);
            if (check_range == true) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }

                function showPosition(position) {
                    var sort = $("#sort").val() ?? '0';
                    var lat_U = position.coords.latitude;
                    var lon_U = position.coords.longitude;
                    var subject = $("#subject").val();
                    var level = $("#level").val();
                    var purpose = $("#purpose").val();
                    var min_range = parseFloat($("#min_range").val());
                    var max_range = parseFloat($("#max_range").val());
                    var channel = [];
                    var gtype = $('input[name="gtype"]:checked').val() ?? '';
                    var gender = [];
                    var day = [];
                    var rate = $('input[name="rate"]:checked').val() ?? '0';
                    var range = $('#slider_gps').val();
                    var search_tutor_finder_ads = $('#search_tutor_finder_ads').val() ?? '';

                    $('input[name="channel"]:checked').each(function(i) {
                        channel[i] = $(this).val();
                    });
                    $('input[name="gender"]:checked').each(function(i) {
                        gender[i] = $(this).val();
                    });
                    $('input[name="day"]:checked').each(function(i) {
                        day[i] = $(this).val();
                    });
                    if (channel.length === 0) {
                        channel[0] = "%";
                    }
                    if (gender.length === 0) {
                        gender[0] = "%";
                    }
                    if (day.length === 0) {
                        day[0] = "%";
                    }

                    $.ajax({
                        url: "ajax/output/get_course.php",
                        method: "POST",
                        data: {
                            check: "Yes",
                            subject: subject,
                            level: level,
                            purpose: purpose,
                            min_range: min_range,
                            max_range: max_range,
                            channel: channel,
                            gtype: gtype,
                            gender: gender,
                            day: day,
                            rate: rate,
                            range: range,
                            check_range: check_range,
                            lat_U: lat_U,
                            lon_U: lon_U,
                            search_ads: search_tutor_finder_ads
                        },
                        success: function(response) {
                            // console.log(response);
                            $("#forCourse").html(response);
                        }
                    });

                }
            } else {
                var sort = $("#sort").val() ?? '0';
                var lat_U = '-';
                var lon_U = '-';
                var subject = $("#subject").val();
                var level = $("#level").val();
                var purpose = $("#purpose").val();
                var min_range = parseFloat($("#min_range").val());
                var max_range = parseFloat($("#max_range").val());
                var channel = [];
                var gtype = $('input[name="gtype"]:checked').val() ?? '';
                var gender = [];
                var day = [];
                var rate = $('input[name="rate"]:checked').val() ?? '0';
                var range = $('#slider_gps').val();
                var search_tutor_finder_ads = $('#search_tutor_finder_ads').val() ?? '';

                $('input[name="channel"]:checked').each(function(i) {
                    channel[i] = $(this).val();
                });
                $('input[name="gender"]:checked').each(function(i) {
                    gender[i] = $(this).val();
                });
                $('input[name="day"]:checked').each(function(i) {
                    day[i] = $(this).val();
                });
                if (channel.length === 0) {
                    channel[0] = "%";
                }
                if (gender.length === 0) {
                    gender[0] = "%";
                }
                if (day.length === 0) {
                    day[0] = "%";
                }

                $.ajax({
                    url: "ajax/output/get_course.php",
                    method: "POST",
                    data: {
                        check: "Yes",
                        subject: subject,
                        level: level,
                        purpose: purpose,
                        min_range: min_range,
                        max_range: max_range,
                        channel: channel,
                        gtype: gtype,
                        gender: gender,
                        day: day,
                        rate: rate,
                        range: range,
                        check_range: check_range,
                        lat_U: lat_U,
                        lon_U: lon_U,
                        search_ads: search_tutor_finder_ads
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#forCourse").html(response);
                    }
                });
            }

        });

        // $("#search_tutor_finder").on('input', function() {
        //     var search_some = $("#search_tutor_finder").val() ?? "";
        //     var sort = $("#sort").val() ?? '0';
        //     $.ajax({
        //         url: "ajax/output/get_course.php",
        //         method: "POST",
        //         data: {
        //             search: "search",
        //             check: "No",
        //             search_some: search_some,
        //             sort: sort
        //         },
        //         success: function(response) {
        //             console.log(response);
        //             $("#forCourse").html(response);
        //         }
        //     });
        // })

    });

    function ClearValue() {
        var search_tutor_finder_ads = '';
        var subject = '';
        var level = '';
        var purpose = '';
        var min_range = '';
        var max_range = '';
        var channel = [];
        var gtype = '';
        var gender = [];
        var day = [];
        var rate = '0';
        var range = '5';

        $("#search_tutor_finder_ads").val('');
        $("option:selected").prop("selected", false)
        $("#min_range").val(0);
        $("#max_range").val(0);
        $('input[name="channel"]').prop("checked", false);
        $('input[name="gtype"]').prop("checked", false);
        $('input[name="day"]').prop("checked", false);
        $('input[name="rate"]').prop("checked", false);
        $('input[name="gender"]').prop("checked", false);
        $('input[name="check_slider"]').prop("checked", false);
        $('#slider_gps').attr('value', 5);
        $("#formControlRange2").val(5);

        showCourse();
    }
</script>