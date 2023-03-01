<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];

$sql = "SELECT * FROM `tbl_tutor_edu` 
        WHERE `username` = '$username';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
?>
    <div class="row mb-1 justify-content-center">
        <span>ยังไม่มีรายการที่เพิ่ม</span>
    </div>
    <?php
} else {
    foreach ($result as $row) {
    ?>
        <div class="row mb-1">
            <div class="col-3">
                <span><?= $row['level'] ?></span>
            </div>
            <div class="col-5">
                <span><b><?= $row['institute'] ?></b></span><br />
                <span class="text-dark"><?= $row['fac_maj'] ? $row['fac_maj'] . "<br />" : "" ?></span>
                <span class="text-dark"><?= $row['diploma'] ? $row['diploma'] . "<br />" : "" ?></span>
                <span class="text-dark"><?= $row['gpax'] && $row['gpax'] != "0.00" ? "เกรดเฉลี่ย " . $row['gpax'] . "<br />" : "" ?></span>
                <span class="text-secondary"><?= $row['period_year'] ? "ช่วงปีที่ศึกษา " . $row['period_year'] : "" ?></span>
            </div>
            <div class="col-2">
                <span><em><?= $row['edu_stat'] ?></em></span>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-danger" type="button" onclick="deleteEdu(<?= $row['id'] ?>);">ลบ</button>
            </div>

        </div>
        <hr />
<?php
    }
}
?>

<script type="text/javascript">
    function deleteEdu(id) {
        Swal.fire({
            title: 'คุณต้องการลบรายการที่เลือก ?',
            text: "",
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
                    url: "ajax/action/delete_edu.php",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        showEduList();
                        showTutorEdu();
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบรายการที่เลือกเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(error) {
                        console.log('AJAX Error: ' + error);
                    }
                });

            }
        })
    }
</script>