<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT * FROM `tbl_tutor_contact` 
        WHERE `username` = '$username'
        ORDER BY `type`, `contact`;";
$result = mysqli_query($conn, $sql);

?>
<div class="card mt-3">
    <div class="card-body p-3">
        <h6 class="text-primary">
            ช่องทางการติดต่อ
        </h6>
        <?php
        if (mysqli_num_rows($result) != 0) {
            foreach ($result as $row) {
                // if ($row['type'] == "1-Phone") {
                //     $row['type'] = "โทรศัพท์";
                // } else if ($row['type'] == "2-Email") {
                //     $row['type'] = "Email";
                // } else if ($row['type'] == "3-Facebook") {
                //     $row['type'] = "Facebook";
                // } else if ($row['type'] == "4-Instagram") {
                //     $row['type'] = "Instagram";
                // } else if ($row['type'] == "5-Line") {
                //     $row['type'] = "Line";
                // } else if ($row['type'] == "6-Twitter") {
                //     $row['type'] = "Twitter";
                // } else if ($row['type'] == "7-WhatsApp") {
                //     $row['type'] = "WhatsApp";
                // }


        ?>
                <p class="mb-0 d-flex flex-row justify-content-start">
                    <?php
                    if ($row['type'] == "1-Phone") {
                        echo '<p><img src="assets/images/icons/b-phone.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "2-Email") {
                        echo '<p><img src="assets/images/icons/b-mail.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "3-Facebook") {
                        echo '<p><img src="assets/images/icons/b-facebook.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "4-Instagram") {
                        echo '<p><img src="assets/images/icons/b-ig.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "5-Line") {
                        echo '<p><img src="assets/images/icons/b-line.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "6-Twitter") {
                        echo '<p><img src="assets/images/icons/b-twitter.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else if ($row['type'] == "7-WhatsApp") {
                        echo '<p><img src="assets/images/icons/b-whatsapp.png" style="width: 30px; height: 30px;"><span class="ml-3">' . $row['contact'] . '</span></p>';
                    } else {
                        echo '-';
                    }
                    ?>
                </p>
            <?php
            }
        } else {
            ?>
            <p class="mt-3 mb-0 d-flex flex-row justify-content-center">
                ไม่มีข้อมูลช่องทางการติดต่อ
            </p>

        <?php
        }

        if (isset($_SESSION['username']) && $role === "tutor" && $username === $_SESSION['username']) {
        ?>

            <p class="mt-3 mb-0 d-flex flex-row justify-content-center">
            <button class="btn btn-sm <?= ($_SESSION['is_approved'] != 0 ? "btn-outline-primary" : "btn-secondary") ?> " style="width:100%;" <?= ($_SESSION['is_approved'] != 0 ? 'onclick="showModalEditContact();"' : 'onclick="alertApprove();"') ?>>แก้ไขข้อมูลติดต่อ</button>
            </p>

        <?php
        }
        ?>
    </div>
</div>
<script>
    function showModalEditContact() {
        $.ajax({
            type: "post",
            url: "ajax/modal/md_edit_contact.php",
            data: {

            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_edit_contact").modal("toggle");

            }
        });
    }
</script>