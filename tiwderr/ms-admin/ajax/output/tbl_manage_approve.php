<?php
session_start();
require_once("../../../connection/connect_db.php");

$filterTable = $_POST['filterTable'];

if ($filterTable == 1) {
    $Wh = "";
} else if ($filterTable == 2) {
    $Wh = "AND A.is_approved = 0 AND B.coppied_id IS NULL";
} else if ($filterTable == 3) {
    $Wh = "AND A.is_approved = 0 AND B.coppied_id IS NOT NULL";
} else if ($filterTable == 4) {
    $Wh = "AND A.is_approved = 1";
} else {
}

$sql = "SELECT A.*, B.* FROM `tbl_user` A 
        INNER JOIN `tbl_user_info` B 
        ON A.username = B.username 
        WHERE A.role = 'tutor' $Wh
        ORDER BY A.created_time DESC";
$result = mysqli_query($conn, $sql);

// print_r($sql);

$th = array("ชื่อผู้ใช้", "อีเมล", "เข้าร่วมเมื่อ", "ตรวจสอบตัวตน", "จัดการ", "อัปเดตล่าสุด");

?>
<style>
    #tb_approve tr:hover {
	background-color: #f6f6f6;
}
</style>
<table class="table table-bordered text-dark" id="tb_approve" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center bg-primary text-white">
            <?php
            for ($i = 0; $i < count($th); $i++) {
                echo '<th class="text-center">' . $th[$i] . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) != 0) {
            foreach ($result as $row) {
                $username = $row['username'];
                $email = $row['email'];
                $created_time = $row['created_time'];
                $role = $row['role'];
                $is_verified = $row['is_verified'];
                $is_approved = $row['is_approved'];
                $coppied_id = $row['coppied_id'];

                $sql_log = "SELECT `action_by`, `action_time` FROM `tbl_admin_log`
                        WHERE `username` = '$username'
                        ORDER BY `action_time` DESC
                        LIMIT 1;";
                $result_log = mysqli_query($conn, $sql_log);

                $action_by = "";
                $action_time = "";
                if (mysqli_num_rows($result_log) != 0) {
                    $row = mysqli_fetch_assoc($result_log);
                    $action_by = $row['action_by'];
                    $action_time = $row['action_time'];
                }
        ?>
                <tr>
                    <td><?= $username ?></td>
                    <td><?= $email ?></td>
                    <!-- <td class="text-center"><?= ($role == "tutor" ? 'ติวเตอร์' : 'ผู้เรียน') ?></td> -->
                    <td>
                        <?= $created_time ?>
                    </td>
                    <!-- <td class="text-center <?= ($is_verified == 0 ? 'text-danger' : 'text-success') ?>"><?= ($is_verified == 0 ? '<i class="fa fa-exclamation mr-1"></i> ยังไม่ยืนยัน' : '<i class="fa fa-check mr-1"></i> ยืนยันแล้ว') ?></td> -->
                    <?php
                    $approve_status = "-";
                    $color = "";
                    if ($role == "tutor") {
                        if ($is_approved == 0 && $coppied_id == "") {
                            $approve_status = '<i class="fa fa-exclamation mr-1"></i> ยังไม่ยืนยัน';
                            $color = "text-danger";
                        } else if ($is_approved == 0 && $coppied_id != "") {
                            $approve_status = '<i class="fa fa-spinner mr-1"></i>รอการตรวจสอบ';
                            $color = "text-warning";
                        } else if ($is_approved == 1) {
                            $approve_status = '<i class="fa fa-check mr-1"></i>ผ่าน';
                            $color = "text-success";
                        } else {
                        }
                    }

                    ?>

                    <td class="text-center <?= $color ?>"><?= $approve_status ?></td>

                    <td class="text-center">
                        <button class="btn btn-primary" onclick="showModalApprove('<?= $username ?>');"><i class="fa fa-search mr-1"></i>ตรวจสอบ</button>
                    </td>
                    <td class="mouse-hover" onclick="showManageApproveLog('<?= $username ?>');">
                        <?= $action_by ?><br>
                        <?= $action_time ?>
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
        $('#tb_approve').DataTable({
            //     dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            //  "<'row'<'col-sm-12'tr>>" +
            //  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "ordering": true,
            order: [[2, 'asc']],
        });
    });

    function showModalApprove(username) {
        // 
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_manage_approve.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forModal").html(response);
                $('#modal_manage_approve').modal('toggle');
                // console.log(response);

            },
            error: function(error) {
                console.log('AJAX Error: ' + error);
            }
        });
    }

    function showManageApproveLog(username) {
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_manage_approve_log.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forModal").html(response);
                $('#modal_manage_approve_log').modal('toggle');
                // console.log(response);

            },
            error: function(error) {
                console.log('AJAX Error: ' + error);
            }
        });
    }
</script>