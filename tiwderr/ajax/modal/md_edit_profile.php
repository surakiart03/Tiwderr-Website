<?php
require_once("../../connection/connect_db.php");

session_start();
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$sql = "SELECT A.*, B.* 
        FROM `tbl_user_info` A 
        LEFT JOIN `tbl_location` B 
        ON A.username = B.username 
        WHERE A.username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);

    $profile_name = $row['profile_name'];
    $profile_pic = $row['profile_pic'];
    $profile_cover = $row['profile_cover'];
    $gender = $row['gender'];
    $bio = $row['bio'];

    $location = $row['location'];
    $t_lat = $row['t_lattitude'];
    $t_long = $row['t_longitude'];
}
?>
<div class="modal fade" id="modal_edit_profile" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil m-0 mr-1" style="font-size: 1.25rem;"></i>แก้ไขโปรไฟล์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="unlinkFile(3);">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff;">
                <div class="container pb-5" style="background-color: #ffffff; border-radius: 10px">
                    <form id="edit_profile_form">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="./assets/images/cover_profile/<?= $profile_cover ?>" id="edit_cover" alt="Image placeholder" class="card-img-top">
                                <div class="row justify-content-center">
                                    <div class="col-4 col-lg-4 order-lg-2">
                                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                            <a href="javascript:;">
                                                <img src="./assets/images/avatar/<?= $profile_pic ?>" id="edit_avatar" alt="image profile" class="rounded-circle img-fluid border border-2 border-white">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="d-flex flex-row justify-content-center">
                                    <form method="post">
                                        <input type="file" name="image-1" class="image" id="upload_profile_image" style="display:none; visibility:hidden">
                                    </form>
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-3" id="change_profile"><i class="mdi mdi-account-circle mr-1"></i>เปลี่ยนรูปโปรไฟล์</button>


                                    <form method="post">
                                        <input type="file" name="image-2" class="image" id="upload_background_image" style="display:none; visibility:hidden">
                                    </form>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="change_background"><i class="mdi mdi-image-area mr-1"></i>เปลี่ยนรูปหน้าปก</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_name" class="form-label ">ชื่อ:</label>
                                    <input type="text" class="form-control form-control-sm text-dark " id="edit_name" minlength="1" maxlength="50" required value="<?= $profile_name ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_bio" class="form-label ">แนะนำตัว:</label>
                                    <textarea class="form-control form-control-sm text-dark " id="edit_bio" rows="4" maxlength="200" required><?= $bio ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-0 p-0 mb-1">
                                    <label for="edit_gender" class="form-label ">เพศ:</label>
                                    <select class="form-control form-control-sm text-dark mr-3" id="edit_gender" required>
                                        <option value="ไม่ระบุ" <?= ($gender == "ไม่ระบุ" ? "selected" : "") ?>>ไม่ระบุ</option>
                                        <option value="ชาย" <?= ($gender == "ชาย" ? "selected" : "") ?>>ชาย</option>
                                        <option value="หญิง" <?= ($gender == "หญิง" ? "selected" : "") ?>>หญิง</option>
                                        <option value="lgbtq+" <?= ($gender == "lgbtq+" ? "selected" : "") ?>>lgbtq+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
				<div class="row m-0 p-0 justify-content-between">
                                <div class="form-group m-0 p-0 col-9">
                                    <label for="edit_location" class="form-label">ตำแหน่งที่ตั้ง:</label>
                                    <input type="text" class="form-control form-control-sm text-dark " id="edit_location" disabled="disabled" value="<?= $location ?>">
                                    <input type="hidden" id="id_lat" name="id_lat" value="<?= $t_lat ?>">
                                    <input type="hidden" id="id_lon" name="id_lon" value="<?= $t_long ?>">
                                </div>
				<div class="form-group m-0 p-0 pt-4">
                                    <button type="button" class="btn btn-sm btn-outline-primary text-nowrap pb-1" style="width: 100%;" id="change_setting_location" ><i class="mdi mdi-map mr-1"></i>เลือก</button>
                                </div>
				</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="unlinkFile(3);">ยกเลิก</button>
                <button type="button" form="edit_profile_form" class="btn btn-primary btn-sm" onclick="submitProfile();">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <img src="" class="img_m" id="sample_image_1" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview" id="preview1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="unlinkFile(3);">ยกเลิก</button>
                <button type="button" id="crop_1" class="btn btn-primary btn-sm">ตัด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <img src="" class="img_m" id="sample_image_2" />
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

<div class="modal fade" id="forModa4" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-a modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ตำแหน่งปัจจุบันของคุณ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-0" style="height: 650px;">
                    <div class="lds-ring" id="spinner">
                        <div></div>
                    </div>
                    <div class="panel">
                        <input type="button" id="find_me" class="header" value="หาฉันสิ">
                    </div>
                    <div id="map" class="m-3"></div>
                    <input type="hidden" id="pause_lat" name="pause_lat" value="">
                    <input type="hidden" id="pause_lon" name="pause_lon" value="">
                    <input type="hidden" id="pause_locat" name="pause_locat" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="bitch" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="changed_location" class="btn btn-primary  btn-sm">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var temp_avatar = "";
    var temp_cover = "";

    $(document).ready(function() {

    });

    // Crop and upload avatar
    $("#change_profile").click(function() {
        $("#upload_profile_image").click();
    });

    var $modal1 = $('#modal1');
    var image1 = document.getElementById('sample_image_1');
    var cropper1;
    var temp_avatar = "";

    $('#upload_profile_image').change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image1.src = url;
            $modal1.modal('show');
        };


        if (files && files.length > 0) {

            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal1.on('shown.bs.modal', function() {
        cropper1 = new Cropper(image1, {
            aspectRatio: 1 / 1,
            viewMode: 3,
            preview: '#preview1'
        });
    }).on('hidden.bs.modal', function() {
        cropper1.destroy();
        cropper1 = null;
    });

    $("#crop_1").click(function() {
        canvas1 = cropper1.getCroppedCanvas({
            width: 500,
            height: 400,
        });

        canvas1.toBlob(function(blob) {
            //url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data1 = reader.result;

                unlinkFile(1);
                $.ajax({
                    url: "ajax/action/upload_image.php",
                    method: "POST",
                    data: {
                        image: base64data1
                    },
                    success: function(response) {
                        temp_avatar = response;
                        // console.log(temp_avatar);
                        $modal1.modal('toggle');
                        $('#edit_avatar').attr('src', 'temp/images/' + response);
                    }
                });

            }
        });
    });
    // End Crop and upload avatar

    // Crop and upload background
    $("#change_background").click(function() {
        $("#upload_background_image").click();
    });

    var $modal2 = $('#modal2');
    var image2 = document.getElementById('sample_image_2');
    var cropper2;
    var temp_cover = "";

    $('#upload_background_image').change(function(event) {
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
            aspectRatio: 21 / 9,
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

                unlinkFile(2);
                $.ajax({
                    url: "ajax/action/upload_image.php",
                    method: "POST",
                    data: {
                        image: base64data2
                    },
                    success: function(response) {
                        temp_cover = response;
                        // console.log(temp_cover);
                        $modal2.modal('toggle');
                        $('#edit_cover').attr('src', 'temp/images/' + response);
                    }
                });

            }
        });
    });
    // End Crop and upload background

    function unlinkFile(type) {
        path = [];
        if (type == 1) {
            path.push('temp/images/' + temp_avatar);
        } else if (type == 2) {
            path.push('temp/images/' + temp_cover);
        } else {
            if (temp_avatar) {
                path.push('temp/images/' + temp_avatar);
            }

            if (temp_cover) {
                path.push('temp/images/' + temp_cover);
            }
        }

        if (path.length != 0) {
            $.ajax({
                url: "ajax/action/unlink_file.php",
                type: "POST",
                data: {
                    path: JSON.stringify(path),
                },
                success: function(response) {
                    // console.log('unlink ' + type);
                }
            });

        }

        // console.log('path: ' + path);
        // console.log('type: ' + type);

    }
    // Get location //
    var lat_U;
    var lon_U;
    $("#forModa4").on('shown.bs.modal', function() {
        var lat = parseFloat($("#id_lat").val()) ?? 0;
        var lon = parseFloat($("#id_lon").val()) ?? 0;
        var locat;

        if (navigator.geolocation) {
            setTimeout(navigator.geolocation.getCurrentPosition(showPosition, showError), 4000);
            setTimeout(nostra.onready = function() {
                nostra.config.Language.setLanguage(nostra.language.L);
                setTimeout(initialize(), 4000);
            }, 4000);

            function initialize() {
                map = new nostra.maps.Map("map", {
                    id: "mapTest",
                    logo: false,
                    scalebar: true,
                    slider: true,
                    basemap: "StreetMap",
                    level: 15,
                    lat: lat_U,
                    lon: lon_U,
                    country: 'TH'
                });

                map.onLoad = function() {
                    spinner(false)
                    markerLayer = new nostra.maps.layers.GraphicsLayer(map, {
                        id: "markerLayer"
                    });
                    setTimeout(map.addLayer(markerLayer), 4000);
                    /* identify */
                    let identify = new nostra.services.Search.Identify({
                        lat: lat,
                        lon: lon,
                        country: "TH"
                    });

                    if (!isNaN(lat) && !isNaN(lon)) {
                        setTimeout(identify.execute(function(result) {

                            /* respone */
                            if (result.results && result.results.length > 0) {
                                locat = result.results[0].AdminLevel1_L + ", " + result.results[0].AdminLevel2_L + ", " + result.results[0].AdminLevel3_L;
                                let nostraCallout = new nostra.maps.CustomCallout({
                                    title: "ปักหมุดที่นี่",
                                    content: "<u>หมุดของคุณ</u><br><br>จังหวัด: " + result.results[0].AdminLevel1_L + "<br>อำเภอ: " + result.results[0].AdminLevel2_L + "<br>ตำบล: " + result.results[0].AdminLevel3_L + "<br>",
                                    width: 175,
                                    height: 100,
                                    color: "#FFFFFF",
                                    fontSize: null,
                                    fontColor: "#000000",
                                    showShadow: true,
                                    label: "หมุดของคุณ"
                                });

                                /* add marker when click on the map */
                                let marker = new nostra.maps.symbols.Marker({
                                    url: "",
                                    width: 60,
                                    height: 60,
                                    customCallout: nostraCallout,
                                    draggable: false
                                });
                                markerLayer.addMarker(lat, lon, marker);

                            } else {
                                alert("ไม่พบข้อมูล 1")
                            }
                            spinner(false)
                        }), 4000);
                    }
                    reset();
                }

                map.onClick = function(e) {
                    spinner(true);
                    reset();
                    let countryId = "TH";
                    lat = e.mapPoint.getLatitude();
                    lon = e.mapPoint.getLongitude();
                    $("#pause_lat").val(lat);
                    $("#pause_lon").val(lon);
                    console.log("lat,lon on Marker");
                    console.log(lat);
                    console.log(lon);

                    /* identify */
                    let identify = new nostra.services.Search.Identify({
                        lat: lat,
                        lon: lon,
                        country: countryId
                    });
                    if (!isNaN(lat) && !isNaN(lon)) {
                        setTimeout(identify.execute(function(result) {

                            /* respone */
                            if (result.results && result.results.length > 0) {
                                locat = result.results[0].AdminLevel1_L + ", " + result.results[0].AdminLevel2_L + ", " + result.results[0].AdminLevel3_L;
                                $("#pause_locat").val(locat);
                                let nostraCallout = new nostra.maps.CustomCallout({
                                    title: "ปักหมุดที่นี่",
                                    content: "<u>หมุดของคุณ</u><br><br>จังหวัด: " + result.results[0].AdminLevel1_L + "<br>อำเภอ: " + result.results[0].AdminLevel2_L + "<br>ตำบล: " + result.results[0].AdminLevel3_L + "<br>",
                                    width: 175,
                                    height: 100,
                                    color: "#FFFFFF",
                                    fontSize: null,
                                    fontColor: "#000000",
                                    showShadow: true,
                                    label: "หมุดของคุณ"
                                });

                                /* add marker when click on the map */
                                let marker = new nostra.maps.symbols.Marker({
                                    url: "",
                                    width: 60,
                                    height: 60,
                                    customCallout: nostraCallout,
                                    draggable: false
                                });
                                markerLayer.addMarker(lat, lon, marker);

                            } else {
                                alert("ไม่พบข้อมูล 2")
                            }
                            spinner(false)
                        }), 2000);
                    }
                }

            }

        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }).on('hidden.bs.modal', function() {
        // reset();
    });

    $("#change_setting_location").click(function() {
        $("#forModa4").modal("show");
    });

    function spinner(isLoading) {
        const spin = document.getElementById("spinner");
        isLoading ? spin.style.display = "flex" : spin.style.display = "none";
    }

    function reset() {
        markerLayer.hideAllCustomCallout();
        markerLayer.clear();
    }

    function showPosition(position) {
        lat_U = position.coords.latitude;
        lon_U = position.coords.longitude;
        console.log("I'm Here");
        console.log(lat_U);
        console.log(lon_U);
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                break;

            case error.POSITION_UNAVAILABLE:
                console.log("Location information is unavailable.");
                break;

            case error.TIMEOUT:
                console.log("The request to get user location timed out.");
                break;

            case error.UNKNOWN_ERROR:
                console.log("An unknown error occurred.");
                break;
        }
    }

    $("#find_me").click(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition2);
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        function showPosition2(position) {
            lat_U = position.coords.latitude;
            lon_U = position.coords.longitude;
            var point = new nostra.services.network.point({
                lat: lat_U,
                lon: lon_U
            });
            map.centerAndZoom(point, 15);
        }
    });

    $("#changed_location").click(function() {
        console.log("Sent it to somewhere");
        $("#id_lat").val($("#pause_lat").val());
        $("#id_lon").val($("#pause_lon").val());
        $('#edit_location').val($("#pause_locat").val());
        $("#forModa4").modal('hide');
    });
    // End Get location //

    function submitProfile() {
        console.log('click submit');
        var empty_input = 0;
        var text_alert = "";
        if (!$('#edit_name').val()) {
            empty_input += 1;
            text_alert = "กรุณาระบุชื่อ";
            $("#edit_name").focus();
        } else {

            var user_data = {
                'username': "<?= $username ?>",
                'name': $('#edit_name').val(),
                'bio': $('#edit_bio').val(),
                'gender': $('#edit_gender').val(),
                'avatar': temp_avatar,
                'avatar_old': "<?= $profile_pic ?>",
                'cover': temp_cover,
                'cover_old': "<?= $profile_cover ?>",
            };

            var location_data = {
                'username': "<?= $username ?>",
                'location': $('#edit_location').val(), // ชื่อโลเคชั่น
                't_lattitude': $("#id_lat").val(),
                't_longitude': $("#id_lon").val()
            }

            console.log(user_data);
            console.log(location_data);
            Swal.fire({
                title: 'ยืนยันการแก้ไขโปรไฟล์ ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Save location
                    $.ajax({
                        type: "POST",
                        url: "ajax/action/edit_profile_location.php",
                        data: location_data,
                        success: function(response) {
                            console.log('res: ' + response);
                        },
                        error: function(error) {
                            console.log('AJAX Error: ' + error);
                        }
                    });

                    // Save info
                    $.ajax({
                        type: "POST",
                        url: "ajax/action/edit_profile.php",
                        data: user_data,
                        success: function(response) {
                            console.log('res: ' + response);
                            $("#modal_edit_profile").modal("toggle");
                            Swal.fire({
                                icon: 'success',
                                title: 'อัปเดตโปรไฟล์ของคุณแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            showProfileCard();
                            if ("<?= $role ?>" == "tutor") {
                                showMyCourse();
                            } else {
                                showMyPost();
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
</script>