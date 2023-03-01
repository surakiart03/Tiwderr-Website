<?php
session_start();
require_once("../../connection/connect_db.php");

$post_id = $_POST['post_id'];

$wh = "";
if ($_SESSION['role'] == "tutor") {
    $wh = " AND A.create_by = '" . $_SESSION['username'] . "'";
}

$sql_offer = "SELECT A.*, B.profile_name, B.profile_pic FROM `tbl_offer` A
                INNER JOIN `tbl_user_info` B
                ON A.create_by = B.username
                WHERE A.post_id = $post_id $wh
                ORDER BY created_time DESC";
$result_offer = mysqli_query($conn, $sql_offer);
// print_r($sql_offer);
?>
<style>
    #myTable table,
    td,
    th {
        /* border-collapse: collapse; */
        border-bottom: 1px solid #ccc;

        /* font-size: 1rem; */
    }

    table {
        table-layout: fixed
    }

    /* 
table {
  width: 100%;
  border-collapse: collapse;
} */
    #myTable tbody tr {
        background-color: #ffffff;
        vertical-align: top;
    }

    #myTable tr:hover {
        background-color: #ebecf0;
    }
</style>
<table id="myTable" class="mt-3" width="100%">
    <thead style="display: none;">
        <tr>
            <th>Offer</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if (mysqli_num_rows($result_offer) != 0) {


            while ($row = mysqli_fetch_assoc($result_offer)) {

                $confirm = 0;
                $remark = 0;
                $i = 0;
                foreach (array_keys($row) as $keys) {
                    if (str_starts_with($keys, "cf_") && $row[$keys] == 'yes') {
                        $confirm += 1;
                    }

                    if (str_starts_with($keys, "rm_") && $row[$keys] != "") {
                        $remark += 1;
                    }
                }
        ?>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <div class="row px-3">
                                    <div class="d-flex flex-column justify-content-center align-items-center mr-2 hover-pointer" onclick="window.open('profile.php?username=<?= $row['create_by'] ?>', '_blank');">
                                        <figure class="d-inline-block mr-1">
                                            <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                                        </figure>
                                    </div>
                                    <div class="d-flex flex-column hover-pointer" onclick="window.open('profile.php?username=<?= $row['create_by'] ?>', '_blank');">
                                        <span class="card-head p-0 m-0 mr-1 mouse-hover"><?= $row['profile_name'] ?></span><span class="card-subhead text-secondary"><?= $row['create_by'] ?></span>
                                    </div>
                                </div>
                                <div class="row px-5 mb-3">
                                    <span class="mr-3"><i class="mdi mdi-checkbox-marked-circle mr-1"></i>การตกลง<span class="mx-1 <?= ($confirm != 0 ? "text-success" : "text-danger") ?>"> <?= ($confirm != 0 ? $confirm : "0") ?></span>/ 8</span>
                                    <span class="mr-3"><i class="mdi mdi-comment-alert mr-1"></i>คำอธิบาย<span class="mx-1  <?= ($remark != 0 ? "text-success" : "text-danger") ?>"> <?= ($remark != 0 ? $remark : "0") ?></span>/ 8</span>
                                    <span><i class="mdi mdi-library-books mr-1"></i>รายละเอียด<span class="mx-1 <?= ($row['offer_descrip'] ? "text-success" : "text-danger") ?>"><?= ($row['offer_descrip'] ? "1" : "0") ?></span>/ 1</span>
                                </div>

                                <div class="row px-5 mb-3 text-secondary">
                                    <span class="mr-1">เสนอเมื่อ</span><span><?= $row['created_time'] ?> น.</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <button class="btn btn-outline-primary btn-sm p-1 m-0 mb-1" type="button" style="width: 100%;" onclick="showModalOfferDetail(<?= $post_id ?>, <?= $row['id'] ?>);">
                                    <i class="mdi mdi-clipboard-text mr-1" style="font-size: 1rem;"></i><span>ดูข้อเสนอ</span>
                                </button>
                                <?php
                                $sql_total_reply = "SELECT COUNT(*) AS total_reply 
                                                    FROM `tbl_offer_reply` 
                                                    WHERE `post_id` = $post_id AND `offer_id` =  $row[id]";
                                $result_total_reply = mysqli_query($conn, $sql_total_reply);
                                if (mysqli_num_rows($result_total_reply)) {
                                    foreach ($result_total_reply as $row_total_reply) {
                                        $total_reply = $row_total_reply['total_reply'];
                                    }
                                }
                                ?>
                                <button id="btn<?= $row['id'] ?>" class="btn btn-outline-success btn-sm p-1 m-0 mb-1" type="button" style="width: 100%;" data-toggle="collapse" data-target="#offer<?= $row['id'] ?>" aria-expanded="false" aria-controls="offer<?= $row['id'] ?>" onclick="showReply(<?= $post_id ?>,<?= $row['id'] ?>)">
                                    <i class="mdi mdi-reply mr-1" style="font-size: 1rem;"></i><span>ตอบกลับ (<span id="total_reply<?= $row['id'] ?>" class=""><?= $total_reply ? $total_reply : 0 ?></span>)</span>
                                </button>

                            </div>
                            <div class="col-12">
                                <div class="collapse" id="offer<?= $row['id'] ?>">
                                    <div id="forReply<?= $row['id'] ?>" class="card card-body" style="height: 400px; max-height: 400px;  overflow-y: auto;">

                                    </div>
                                    <div class="">
                                        <textarea class="form-control form-control-sm text-dark" id="reply_offer<?= $row['id'] ?>" rows="2" placeholder="เขียนการตอบกลับของคุณ"></textarea>
                                        <div class="d-flex flex-row justify-content-end m-0 mt-3">
                                            <button class="btn btn-success btn-sm" onclick="submitReply(<?= $post_id ?>, <?= $row['id'] ?>);">ส่ง</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                </tr>
        <?php
            }
        }
        ?>

    </tbody>
</table>
<script>
    $(document).ready(function() {
        $(".summernote-reply").summernote({
            placeholder: 'เขียนข้อความตอบกลับ',
            disableDragAndDrop: true,
            disableResizeEditor: false,
            //tabsize: 2,
            height: 70,
            toolbar: false,
        });

        $("#myTable").DataTable({
            dom: '<"toolbar">frtip',
            ordering: false,
            searching: false,
            paging: true,
	    destroy: true,
        });


    });
    
    function showModalOfferDetail(post_id, offer_id) {
        console.log('click');
        $.ajax({
            type: "post",
            url: "ajax/modal/md_offer_detail.php",
            data: {
                post_id: post_id,
                offer_id: offer_id,
            },
            success: function(response) {
                $("#forModal").html(response);
                $("#modal_offer_detail").modal("toggle");

            }
        });
    }

    function submitReply(post_id, offer_id) {
        var reply_data = {
            'post_id': post_id,
            'offer_id': offer_id,
            'message': $("#reply_offer" + offer_id).val().replace(/\n\r?/g, '<br />'), //
            'create_by': "<?= $_SESSION['username'] ?>",
        }

        if ($("#reply_offer" + offer_id).val().trim()) {
            $.ajax({
                type: "POST",
                url: "ajax/action/add_offer_reply.php",
                data: reply_data,
                success: function(response) {
                    console.log('res: ' + response);
                    $("#reply_offer" + offer_id).val('');
                    $("#reply_offer" + offer_id).focus();
                    $("#total_reply" + offer_id).text(parseInt($("#total_reply" + offer_id).text()) + 1);
                    showReply(post_id, offer_id);
                },
                error: function(error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        } else {
            $("#reply_offer" + offer_id).focus();
        }
    }

    function showReply(post_id, offer_id) {
        $.ajax({
            type: "post",
            url: "ajax/output/get_offer_reply.php",
            data: {
                post_id: post_id,
                offer_id: offer_id,
            },
            success: function(response) {
                $("#forReply" + offer_id).html(response);
            }
        });
    }
</script>