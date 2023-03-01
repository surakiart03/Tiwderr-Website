<?php
session_start();
$post_id = $_POST['post_id'];

?>
<div class="card shadow-sm ">
    <div class="card-header m-0 pb-0" style="background-color: #ffffff;">
        <h4>การเสนอสอน<?= $_SESSION['role'] == "tutor" ? "ของคุณ" : "จากติวเตอร์" ?></h4>
    </div>
    <div class="card-body">
        <div class="row px-3">
            <h5><i class="mdi mdi-alert-circle mr-1"></i>โปรดทราบ</h5>
            <ol>
                <?php
                if ($_SESSION['role'] == "tutor") {
                    echo '<li>มีเพียงผู้เรียนเจ้าของโพสต์เท่านั้นที่สามารถมองเห็นและตอบกลับข้อเสนอของคุณได้</li>';
                } else {
                    echo '<li>มีเพียงคุณเท่านั้นที่สามารถมองเห็นและตอบกลับข้อเสนอของติวเตอร์แต่ละคนได้</li>';
                }
                ?>
                <li><span class="text-danger">การยื่นข้อเสนอ ไม่ถือว่าเป็นการยืนยันรับบริการ</span> ติวเตอร์และผู้เรียนจะต้องเจรจาทำข้อตกลงกันในภายหลัง</li>
            </ol>
        </div>
        <hr class="m-0">
        <!-- <div class="row m-3 p-0 d-flex justify-content-between">
            <div class="col-md-12 m-0 mb-3 d-flex">
                <span class="text-nowrap mr-3 pt-1">เรียงตาม</span>
                <select class="form-control form-control-sm text-dark mr-3">
                    <option value="0" selected>ข้อเสนอล่าสุด</option>
                    <option value="1">ติวเตอร์</option>
                </select>
                <i class="mdi mdi-sort mouse-hover" style="font-size:1.5rem;"></i>
            </div>
        </div> -->
        <div id="forReply">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        showAllOffer()
    });

    function showAllOffer() {
        $.ajax({
            type: "post",
            url: "ajax/output/get_offer_list.php",
            data: {
                post_id: <?= $post_id ?>
            },
            success: function(response) {
                $("#forReply").html(response);
            }
        });
    }
</script>