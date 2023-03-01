<?php
require_once("../../connection/connect_db.php");
session_start();

$post_id = $_POST['post_id'];
$student = $_POST['student'];

$sql = "SELECT A.*, B.profile_pic, B.profile_name, B.bio, B.gender FROM `tbl_post` A
        INNER JOIN `tbl_user_info` B
        ON A.create_by = B.username
        WHERE A.id = $post_id;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    foreach ($result as $row) {
?>
        <div class="card shadow-sm ">
            <div class="card-header" style="background-color: #ffffff;">
                <div class="d-flex flex-row justify-content-end">
                    <div class="col m-0 p-0">
                        <div class="row px-3">
                            <div class="d-flex flex-column justify-content-center align-items-center hover-pointer" onclick="window.location.href='profile.php?username=<?= $row['create_by'] ?>'">
                                <figure class="d-inline-block mr-3">
                                    <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                                </figure>
                            </div>
                            <div class="d-flex flex-column hover-pointer" onclick="window.location.href='profile.php?username=<?= $row['create_by'] ?>'">
                                <span class="card-head h5 p-0 m-0 mouse-hover"><?= $row['profile_name'] ?></span>
                                <span class="card-subhead text-secondary"><?= $row['create_by'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($student == $_SESSION['username']  && $_SESSION['role'] == "student" ) {
                    ?>
                        <div class="col m-0 p-0">
                            <div class="nav-item dropdown d-flex flex-row justify-content-end m-0 p-0">
                                <a href="#" class="p-0" data-toggle="dropdown">
                                    <i class="mdi mdi-dots-horizontal" style="font-size:1.5rem;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right ">
                                    <button class="dropdown-item" onclick="showModalEditPostDescrip();"><i class="dropdown-item-icon mdi mdi-pencil"></i>แก้ไขรายละเอียด</button>
                                    <!-- <button  class="dropdown-item" onclick=""><i class="dropdown-item-icon mdi mdi-shape-plus"></i>เพิ่มตัวอย่างการสอน</button> -->
                                    <button class="dropdown-item" onclick="settingPostStatus();"><i class="dropdown-item-icon mdi mdi-lock-open-outline"></i>เปิดรับ/ปิดรับ</button>
                                    <button class="dropdown-item" onclick="deletePost();"><i class="dropdown-item-icon mdi mdi-delete"></i>ลบโพสต์</button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <h3 class="font-weight-bolder"><?= $row['title'] ?></h3>
                        <div class="row m-0">
                            <?= $row['post_descrip'] ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row m-0">
                            <p class="m-0" style="text-align:right; " id="post_status">
                                <?php if ($row['post_status'] == 1) {
                                ?>
                                    <span class="badge badge-pill badge-success" name="post_status">เปิดรับ</span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-pill badge-danger" name="post_status">ปิดรับ</span>
                                <?php
                                }
                                ?>
                            </p>
                        </div>
                        <div class="row m-0 mt-3">
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">หมวดวิชา</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['subject'] ?></span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ระดับชั้น</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark">
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
                                </span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">เป้าหมาย</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark">
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
                                </span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ช่องทาง</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['channel'] ?></span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ติวแบบ</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark"><?= $row['group_type'] ?></span></div>
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">วันที่ติว</span></div>
                            <div class="col-8 m-0 p-0">
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
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ช่วงเวลา</span></div>
                            <div class="col-8 m-0 p-0">
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
                            <div class="col-4 m-0 p-0"><span class="text-dark font-weight-bolder">ราคาต่อชั่วโมง</span></div>
                            <div class="col-8 m-0 p-0"><span class="text-dark">ไม่เกิน <?= $row['price'] ?> บาท</span></div>
                        </div>
                        <div class="row m-0 my-3">
                            <!--<div class="col-12 m-0 p-0"><span class="text-secondary">จำนวนเข้าชม 256,875 ครั้ง</span></div>-->
                            <div class="col-12 m-0 p-0"><span class="text-secondary">สร้างเมื่อ <?= $row['created_time'] ?> น.</span></div>
                            <div class="col-12 m-0 p-0"><span class="text-secondary">อัปเดตล่าสุด </span><span id="last_update" class="text-secondary"><?= $row['last_update'] ?  $row['last_update'] . " น." : "-"  ?></span></div>
                        </div>
                        <?php
                        if ($_SESSION['role'] == "tutor" && $row['post_status'] != 0) {

                        ?>
                            <div class="row m-0 mt-3">
                            <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-danger" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalAddOffer();"' : 'onclick="alertApprove();"') ?>><i class="mdi mdi-message-text mr-1 mdi-xl"></i>เสนอสอน</button>
                            </div>
                        <?php

                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
<?php
    }
}
?>
<script>
    $(document).ready(function() {
        if ("<?= $_SESSION['username'] ?>" == "<?= $student ?>" || "<?= $_SESSION['role'] ?>" == "tutor") {
            showOffer();
        }
    });

    function showOffer() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_offer_in_post.php",
            data: {
                post_id: <?= $post_id ?>
            },
            success: function(response) {
                $("#forContent2").html(response);

            }
        });
    }

    function showModalEditPostDescrip() {

        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_post_descrip.php",
            data: {
                id: <?= $post_id ?>,
            },
            success: function(response) {

                $("#forModal").html(response);
                console.log('click');
                $("#modal_edit_post_descrip").modal("toggle");
            }
        });
    }

    function settingPostStatus() {
        var status = $("[name=post_status]").text();
        if (status == "เปิดรับ") {
            var change = "ปิดรับ";
            var val = 0;
        } else {
            var change = "เปิดรับ";
            var val = 1;
        }

        Swal.fire({
            title: 'เปลี่ยนสถานะเป็น' + change + ' ?',
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
                    url: "ajax/action/edit_post_status.php",
                    data: {
                        id: <?= $post_id ?>,
                        status_val: val,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        Swal.fire({
                            icon: 'success',
                            title: 'เปลี่ยนสถานะเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (status == "เปิดรับ") {
                            $("#post_status").html('<span class="badge badge-pill badge-danger" name="post_status">ปิดรับ</span>');
                        } else {
                            $("#post_status").html('<span class="badge badge-pill badge-success" name="post_status">เปิดรับ</span>')
                        }
                        $("#last_update").text(response);

                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }

    function deletePost() {

        Swal.fire({
            title: 'คุณต้องการลบโพสต์ ?',
            text: "ไม่สามารถแก้ไขได้ในภายหลัง",
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
                    url: "ajax/action/delete_post.php",
                    data: {
                        id: <?= $post_id ?>,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบโพสต์เรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        window.location.href = 'profile.php?username=' + "<?= $_SESSION['username'] ?>";

                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }

    function showModalAddOffer() {

        $.ajax({
            type: "post",
            url: "ajax/modal/md_add_offer.php",
            data: {
                post_id: <?= $post_id ?>
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_add_offer").modal("toggle");
            }
        });
    }
</script>