<?php
session_start();
require_once("../../../connection/connect_db.php");

$username = $_POST['username'];

$sql = "SELECT * FROM `tbl_admin_log`
        WHERE `username` = '$username'
        ORDER BY `action_time` DESC;";
$result = mysqli_query($conn, $sql);

$th = array("สถานะ", "อัปเดตโดย", "เวลา");
?>
<div class="modal fade" id="modal_manage_approve_log" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_manage_approve_log" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><i class="fas fa-history mr-1"></i>ประวัติการอัปเดต</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px;">
                <div class="container">
                    <table class="table table-bordered text-dark" id="tb_approve_log" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <?php
                                for ($i = 0; $i < count($th); $i++) {
                                    echo '<th  class="text-center">' . $th[$i] . '</th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $remark = ($row['remark'] == "P" ? "PASS" : $row['remark']) ;
                                    $action_by = $row['action_by'];
                                    $action_time = $row['action_time'];
                            ?>
                                <tr>
                                    <td width="40%" class="<?= $remark == "PASS" ? "text-success" : "text-danger"?>"><?= $remark ?></td>
                                    <td><?= $action_by ?></td>
                                    <td class="text-center"><?= $action_time ?></td>
                                </tr>
                            <?php
                                }
                            } else {

                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tb_approve_log').DataTable({
            //     dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            //  "<'row'<'col-sm-12'tr>>" +
            //  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "ordering": true,
            "paging": false,
            "searching": false,

        });
    });
</script>