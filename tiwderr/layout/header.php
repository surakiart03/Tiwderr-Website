<?php

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-on-scroll">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#miriUiKitNavbar" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="miriUiKitNavbar" style="z-index: 1030;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">หน้าแรก</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="tutor_finder.php">ค้นหาติวเตอร์</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="announcement_post.php">ประกาศหาติวเตอร์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="how.php">TiWDERR ใช้ยังไง?</a>
                </li>
                <li class="nav-item ">
                    <i class="nav-link mdi mdi-magnify" style="font-size: 1.5rem;" onclick="showSearchUser();"></i>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['username'])) {
                ?>
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link p-0" data-toggle="dropdown">
                            <sup id="num_noti" class="badge badge-pill badge-danger" style="font-size:0.5rem;"></sup><i class="mdi mdi-bell-outline" style="font-size:1.25rem;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="width: 300px; max-width: 300px; max-height: 600px; overflow-y: auto;">
                            <div class="container">
                                <div class="d-flex flex-row justify-content-between">
                                    <h5>การแจ้งเตือน</h5>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <span class="mouse-hover" onclick="setReadNotiAll(1);"><i class="mdi  mdi-check mr-1"></i>ทำเครื่องหมายว่าอ่านแล้ว</span>
                                    <span class="mouse-hover" onclick="setReadNotiAll(2);"><i class="mdi  mdi-delete mr-1"></i>ลบที่อ่านแล้ว</span>
                                </div>

                            </div>
                            <div id="forNotify" class="p-2 pb-0 mb-0">

                            </div>

                        </div>
                    </li>
                    <li class="nav-item dropdown">

                        <a href="#" class="nav-link dropdown-toggle p-0" data-toggle="dropdown">
                            Hi! <?= $_SESSION['username'] ?> <img src="./assets/images/avatar/<?= $_SESSION['profile_pic'] ?>" width="40px" height="40px" alt="demo" class="rounded-circle ml-2">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right ">
                            <a href="profile.php?username=<?= $_SESSION['username'] ?>" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-shield-account-outline"></i>โปรไฟล์ของฉัน</a>
                            <a href="change_password.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-lock-outline"></i>เปลี่ยนรหัสผ่าน</a>
                            <a href="#" class="dropdown-item" onclick="logoutFunc();"><i class="dropdown-item-icon mdi mdi-logout"></i>ออกจากระบบ</a>
                        </div>
                    </li>
                <?php
                } else {
                ?>
                    <button class="btn btn-danger btn-sm mx-1" onclick="window.location.href='main_register.php'" style="width: 8rem;"><i class="mdi mdi-account-plus mr-2"></i>สมัครสมาชิก</button>
                    <button class="btn btn-primary btn-sm mx-1" onclick="window.location.href='login.php'" style="width: 8rem;"><i class="mdi mdi-login mr-2"></i>เข้าสู่ระบบ</button>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div id="forSearchUser">

</div>
<script type="text/javascript">
    setInterval(function() {
        getNotify();
    }, 5000);

    function getNotify() {
        $.ajax({
            type: "POST",
            url: "ajax/output/get_notify.php",
            data: {

            },
            // dataType: "text",
            success: function(response) {
                // console.log(response);
                $("#forNotify").html(response);
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function playNoti() {
        var audio = new Audio('assets/audio/noti.mp3');
        audio.play();
    }

    function setReadNotiAll(num) { // 1: readed, 2: delete
        $.ajax({
            type: "POST",
            url: "ajax/action/edit_is_read.php",
            data: {
                type: "",
                row_id: "",
                src: "",
                owner: "",
                status: num,
                option: 'all',
            },
            // dataType: "text",
            success: function(response) {
                console.log(response);
                getNotify();
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function setReadNoti(type, row_id, src, owner) {
        console.log('readed');
        $.ajax({
            type: "POST",
            url: "ajax/action/edit_is_read.php",
            data: {
                type: type,
                row_id: row_id,
                src: src,
                owner: owner,
                status: 1,
                option: 'one',
            },
            // dataType: "text",
            success: function(response) {
                // console.log(response);
                console.log('ajax readed: ' + response);

                //getNotify();
                window.location.href = response;
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function showSearchUser() {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_search_user.php",
            data: {

            },
            // dataType: "text",
            success: function(response) {
                // console.log(response);
                $("#forSearchUser").html(response);
                $("#md_search_user").modal("toggle");
                $("#search-box").focus();
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }
</script>