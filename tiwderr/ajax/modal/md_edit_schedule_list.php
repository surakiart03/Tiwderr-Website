<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];
// $day = $_POST['day'];
// $detail = $_POST['detail'];

$sql = "SELECT * FROM `tbl_tutor_schedule` 
        WHERE `username` = '$username'
        ORDER BY `day`;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
?>
    <div class="row mb-1 justify-content-center">
        <span>ยังไม่มีรายการที่เพิ่ม</span>
    </div>
    <?php
} else {
    foreach ($result as $row) {
        if ($row['day'] == "1-mon") {
            $row['day'] = "จันทร์";
        } else if ($row['day'] == "2-tue") {
            $row['day'] = "อังคาร";
        } else if ($row['day'] == "3-wed") {
            $row['day'] = "พุธ";
        } else if ($row['day'] == "4-thu") {
            $row['day'] = "พฤหัสบดี";
        } else if ($row['day'] == "5-fri") {
            $row['day'] = "ศุกร์";
        } else if ($row['day'] == "6-sat") {
            $row['day'] = "เสาร์";
        } else if ($row['day'] == "7-sun") {
            $row['day'] = "อาทิตย์";
        }
    ?>
        <div class="row mb-1">
            <div class="col-2">
                <span><?= $row['day'] ?></span>
            </div>
            <div class="col-8 p-0 m-0">
                <textarea class="form-control form-control-sm text-dark mr-3" readonly style="background-color: white;"><?= $row['detail'] ?></textarea>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-danger" type="button" onclick="deleteSchedule(<?= $row['id'] ?>, '<?= $row['day'] ?>');">ลบ</button>
            </div>
        </div>
        <hr />
<?php
    }
}
?>

<script type="text/javascript">
    function deleteSchedule(id, day) {
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
                    url: "ajax/action/delete_schedule.php",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        showScheduleList();
                        showScheduleCard();
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