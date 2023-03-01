<?php
session_start();
require_once("../../../connection/connect_db.php");

$sql = "SELECT * FROM `tbl_admin` 
        ORDER BY created_time ASC";
$result = mysqli_query($conn, $sql);

// print_r($sql);

$th = array("ชื่อผู้ใช้", "อีเมล", "บทบาท", "เพิ่มโดย", "เพิ่มเมื่อ", "จัดการ");

?>
<style>
    #tb_setting_admin tr:hover {
        background-color: #f6f6f6;
    }
</style>
<table class="table table-bordered text-dark" id="tb_setting_admin" width="100%" cellspacing="0">
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
                $id = $row['id'];
                $username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
                $role = ($row['role'] == "admin" ? "ผู้ดูแลระบบ" : "");
                $create_by = $row['create_by'];
                $created_time = $row['created_time'];
        ?>
                <tr>
                    <td><?= $username ?></td>
                    <td><?= $email ?></td>
                    <td class="text-center"><?= ($username == "ADMIN") ? '<i class="fas fa-crown mr-1"></i>' : "" ?><?= $role ?></td>
                    <td class="text-center"><?= $create_by ?></td>
                    <td class="text-center"><?= $created_time ?></td>
                    <td class="text-center">
                        <?php
                        if ($username != "ADMIN") {
                        ?>
                            <button class="btn btn-danger"  <?= ($_SESSION['username'] != 'ADMIN' ? "disabled" : "") ?> onclick="showDelete('<?= $id ?>');"><i class="fas fa-trash"></i></button>
                        <?php }
                        ?>

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
        $('#tb_setting_admin').DataTable({
            // dom: '<"toolbar">frtip',
            //ordering: false,
            // searching: true,
            // paging: true,
            order: [[4, 'asc']],

        });
    });

    function showDelete(id) {
        Swal.fire({
            title: 'ลบบัญชีผู้ดูแลนี้ ?',
            text: "ไม่สามารถแก้ไขได้ในภายหลัง",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "ajax/action/delete_admin.php",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบบัญชีผู้ดูแลแล้ว',
                                text: '',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            showTableAdmin();
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'มีบางอย่างผิดพลาด',
                                text: 'ไม่สามารถลบบัญชีผู้ดูแลได้',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });
            }
        })
    }
</script>