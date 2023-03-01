<?php
session_start();
require_once("../../../connection/connect_db.php");

$filterTable = $_POST['filterTable'];

if ($filterTable == 1) {
    $Wh = "";
} else if ($filterTable == 2) {
    $Wh = "WHERE A.role = 'tutor'";
} else if ($filterTable == 3) {
    $Wh = "WHERE A.role = 'student'";
} else {
}

$sql = "SELECT A.*, B.* FROM `tbl_user` A 
        INNER JOIN `tbl_user_info` B 
        ON A.username = B.username 
        $Wh
        ORDER BY A.created_time DESC";
$result = mysqli_query($conn, $sql);

// print_r($sql);

$th = array("ชื่อผู้ใช้", "อีเมล", "บทบาท", "เข้าร่วมเมื่อ", "ยืนยันอีเมล", "");

?>
<style>
    #tb_user tr:hover {
        background-color: #f6f6f6;
    }
</style>
<table class="table table-bordered text-dark" id="tb_user" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center  bg-primary text-white">
            <?php
            for ($i = 0; $i < count($th); $i++) {
                echo '<th  class="text-center">' . $th[$i] . '</th>';
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
                    <td class="text-center"><?= ($role == "tutor" ? '<i class="fas fa-chalkboard-teacher mr-1"></i>ติวเตอร์' : '<i class="fas fa-book-reader mr-1"></i>ผู้เรียน') ?></td>
                    <td>
                        <?= $created_time ?>
                    </td>
                    <td class="text-center <?= ($is_verified == 0 ? 'text-danger' : 'text-success') ?>"><?= ($is_verified == 0 ? '<i class="fa fa-exclamation mr-1"></i> ยังไม่ยืนยัน' : '<i class="fa fa-check mr-1"></i> ยืนยันแล้ว') ?></td>


                    <td class="text-center">
                        <button class="btn btn-info" onclick="showModalInfo('<?= $username ?>');"><i class="far fa-eye"></i></button>

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
        $('#tb_user').DataTable({
            //     dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            //  "<'row'<'col-sm-12'tr>>" +
            //  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            // "ordering": true,
            order: [[3, 'asc']],
        });
    });

    function showModalInfo(username) {
        // 
        $.ajax({
            type: "POST",
            url: "ajax/modal/md_user_info.php",
            data: {
                username: username,
            },
            success: function(response) {
                $("#forModal").html(response);
                $('#modal_user_info').modal('toggle');
                // console.log(response);

            },
            error: function(error) {
                console.log('AJAX Error: ' + error);
            }
        });
    }
</script>