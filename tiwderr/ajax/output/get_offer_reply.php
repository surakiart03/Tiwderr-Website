<?php
session_start();
require_once("../../connection/connect_db.php");

$post_id = $_POST['post_id'];
$offer_id = $_POST['offer_id'];

$sql_reply = "SELECT A.*, B.profile_name, B.profile_pic FROM `tbl_offer_reply` A
            INNER JOIN `tbl_user_info` B
            ON A.create_by = B.username
            WHERE A.post_id = $post_id AND A.offer_id = $offer_id
            ORDER BY A.created_time";
$result_reply = mysqli_query($conn, $sql_reply);

if (mysqli_num_rows($result_reply)) {
    foreach ($result_reply as $row_reply) {
        if ($row_reply['create_by'] == $_SESSION['username']) {
?>
            <div class="d-flex flex-row justify-content-end align-items-start pl-10 pr-3 mb-3">
                <div class="d-flex flex-column" style="max-width: 400px;">
                    <span class="p-2 text-wrap" style="background-color: #e0efff; border-radius: 10px;" title="<?= $row_reply['created_time'] ?>">
                        <?= $row_reply['message'] ?>
                    </span>
                    <!-- <p class="text-muted font-weight-light" style="float: right;"><?= $row_reply['created_time'] ?> น.</p> -->
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center ml-2">
                    <figure class="d-inline-block mr-1">
                        <img src="./assets/images/avatar/<?= $row_reply['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                    </figure>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="d-flex flex-row justify-content-start align-items-start pl-3 pr-10 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                    <figure class="d-inline-block mr-1">
                        <img src="./assets/images/avatar/<?= $row_reply['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                    </figure>
                </div>
                <div class="d-flex flex-column" style="max-width: 400px;">
                    <span class="p-2 text-wrap" style="background-color: #efefef; border-radius: 10px;" title="<?= $row_reply['created_time'] ?>">
                        <?= $row_reply['message'] ?>
                    </span>
                    <!-- <p class="text-muted font-weight-light"><?= $row_reply['created_time'] ?> น.</p> -->
                </div>
            </div>

<?php
        }
    }
}
?>