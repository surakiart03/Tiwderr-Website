<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];

$sql = "SELECT * FROM `tbl_tutor_award` 
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
            <div class="col-10">
                <span><b><?= $row['title'] ?></b></span><br/>
                <span class="text-secondary"><?= $row['org'] ? "โดย ".$row['org'] : "" ?></span>
                <p><?= $row['detail'] ? $row['detail'] : "" ?></p>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-danger" type="button" onclick="deleteAward(<?= $row['id'] ?>);">ลบ</button>
            </div>

        </div>
        <hr />
<?php
    }
}
?>

<script type="text/javascript">
    function deleteAward(id) {
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
                    url: "ajax/action/delete_award.php",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        showAwardList();
                        showTutorAward()
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