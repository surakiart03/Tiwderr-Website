<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$role = $_POST['role'];

?>
<div class="tabset mt-3">
    <!-- Tab 1 -->
    <input type="radio" name="tabset" id="tab1" aria-controls="tab1">
    <label for="tab1"><i class="mr-1 mdi mdi-account-box"></i>แนะนำตัว</label>
    <!-- Tab 2 -->
    <input type="radio" name="tabset" id="tab2" aria-controls="tab2" checked>
    <label for="tab2"><i class="mr-1 mdi mdi-library"></i>งานสอน</label>
    <!-- Tab 3 -->
    <!-- <input type="radio" name="tabset" id="tab3" aria-controls="tab3">
    <label for="tab3"><i class="mr-1 mdi mdi-image-album"></i>แกลเลอรี่</label> -->
    <!-- Tab 4 -->
    <input type="radio" name="tabset" id="tab4" aria-controls="tab4">
    <label for="tab4"><i class="mr-1 mdi mdi-star-circle"></i>รีวิว</label>

    <?php
    if (isset($_SESSION['username']) && $username === $_SESSION['username']) {
    ?>
        <!-- Tab 5 -->
        <input type="radio" name="tabset" id="tab5" aria-controls="tab5">
        <label for="tab5"><i class="mr-1 mdi mdi-message-text"></i>การเสนอสอน</label>
    <?php
    }
    ?>
    <div class="tab-panels">
        <section id="tab1" class="tab-panel">
            <div class="container">
                <?php
                if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {
                ?>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-outline-primary" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalEditEdu();"' : 'onclick="alertApprove();"') ?>>แก้ไขประวัติการศึกษา</button>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div id="forTutorEdu">

                </div>
            </div>
            <hr />
            <div class="container">
                <?php
                if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {
                ?>
                    <div class="row  mb-3">
                        <div class="col-md-3">
                        <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-outline-primary" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalEditAward();"' : 'onclick="alertApprove();"') ?>>แก้ไขผลงาน</button>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div id="forTutorAward">

                </div>
            </div>
            <hr />
            <div class="container">
                <?php
                if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {

                ?>
                    <div class="row  mb-3">
                        <div class="col-md-3">

                            <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-outline-primary" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalEditExperience();"' : 'onclick="alertApprove();"') ?>>แก้ไขประสบการณ์สอน</button>
                        </div>
                    </div>
                <?php

                }
                ?>

                <div id="forTutorExperience">

                </div>
            </div>

        </section>
        <section id="tab2" class="tab-panel">
            <div id="forMyCourse">

            </div>
        </section>
        <!-- <section id="tab3" class="tab-panel">

        </section> -->
        <section id="tab4" class="tab-panel">
            <div id="forMyReview">

            </div>
        </section>
        <section id="tab5" class="tab-panel">
            <div id="forMyOffer">

            </div>
        </section>
    </div>
</div>
<script>
    var role = "<?= $role ?>";
    var username = "<?= $username ?>";

    $(document).ready(function() {
        showTutorEdu();
        showTutorAward();
        showTutorExperience();
        showMyCourse();
        showMyReview();
        if (username === "<?= isset($_SESSION['username']) ? $_SESSION['username'] : "" ?>") {
            showMyOffer();
        }
    });

    function showTutorEdu() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_tutor_edu.php",
            data: {
                username: username,
                role: role
            },
            success: function(response) {
                $("#forTutorEdu").html(response);
            }
        });
    }

    function showModalEditEdu() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_edu.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_edu").modal("toggle");
            }
        });
    }

    function showTutorAward() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_tutor_award.php",
            data: {
                username: username,
                role: role
            },
            success: function(response) {
                $("#forTutorAward").html(response);
            }
        });
    }

    function showModalEditAward() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_award.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_award").modal("toggle");
            }
        });
    }

    function showTutorExperience() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_tutor_experience.php",
            data: {
                username: username,
                role: role
            },
            success: function(response) {
                $("#forTutorExperience").html(response);
            }
        });
    }

    function showModalEditExperience() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_experience.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_experience").modal("toggle");
            }
        });
    }

    function showMyCourse() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_tutor_course.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forMyCourse").html(response);
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function showMyReview() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_tutor_review.php",
            data: {
                username: username,
                role: role
            },
            success: function(response) {
                $("#forMyReview").html(response);
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function showMyOffer() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_profile_offer.php",
            data: {
                username: username,
                role: role
            },
            success: function(response) {
                $("#forMyOffer").html(response);
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }
</script>