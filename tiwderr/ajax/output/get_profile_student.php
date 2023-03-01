<?php
require_once("../../connection/connect_db.php");
session_start();

$username = $_POST['username'];
$role = $_POST['role'];

?>
<div class="tabset mt-3">

    <!-- Tab 2 -->
    <input type="radio" name="tabset" id="tab2" aria-controls="tab2" checked>
    <label for="tab2"><i class="mr-1 mdi mdi-library"></i>ประกาศ</label>

    <!-- Tab 3 -->
    <input type="radio" name="tabset" id="tab3" aria-controls="tab3">
    <label for="tab3"><i class="mr-1 mdi mdi-star-circle"></i>รีวิว</label>
    <?php
    if ($username === $_SESSION['username']) {
    ?>
        <!-- Tab 4 -->
        <input type="radio" name="tabset" id="tab4" aria-controls="tab4">
        <label for="tab4"><i class="mr-1 mdi mdi-heart"></i>สิ่งที่ถูกใจ</label>

        <!-- Tab 5 -->
        <input type="radio" name="tabset" id="tab5" aria-controls="tab5">
        <label for="tab5"><i class="mr-1 mdi mdi-message-text"></i>การเสนอสอน</label>
    <?php
    }
    ?>
    <div class="tab-panels">

        <section id="tab2" class="tab-panel">
            <div id="forMyPost">

            </div>
        </section>

        <section id="tab3" class="tab-panel">
            <div id="forMyReview">

            </div>
        </section>

        <section id="tab4" class="tab-panel">
            <div id="forMyFav">

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
        showMyPost();
        showMyReview();
        if (username === "<?= $_SESSION['username'] ?>") {
            showMyFav();
            showMyOffer();
        }
    });

    function showMyPost() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_student_post.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forMyPost").html(response);
            },
            error: function(request, status, error) {
                console.log("AJAX ERROR : \n" + request.responseText);
            }
        });
    }

    function showMyReview() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_student_review.php",
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

    function showMyFav() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_student_fav.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forMyFav").html(response);
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