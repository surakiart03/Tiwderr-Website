<?php
session_start();

require_once("../../connection/connect_db.php");

$username = $_SESSION['username'];

$sql = "SELECT * FROM `tbl_tutor_contact` 
        WHERE `username` = '$username'
        ORDER BY `type`, `contact`;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
?>
    <div class="row mb-1 justify-content-center">
        <span>ยังไม่มีรายการที่เพิ่ม</span>
    </div>
    <?php
} else {
    foreach ($result as $row) {
        if ($row['type'] == "1-Phone") {
            $row['type'] = "โทรศัพท์";
        } else if ($row['type'] == "2-Email") {
            $row['type'] = "Email";
        } else if ($row['type'] == "3-Facebook") {
            $row['type'] = "Facebook";
        } else if ($row['type'] == "4-Instagram") {
            $row['type'] = "Instagram";
        } else if ($row['type'] == "5-Line") {
            $row['type'] = "Line";
        } else if ($row['type'] == "6-Twitter") {
            $row['type'] = "Twitter";
        } else if ($row['type'] == "7-WhatsApp") {
            $row['type'] = "WhatsApp";
        }
    ?>
        <div class="row mb-1">
            <div class="col-2">
                <span><?= $row['type'] ?></span>
            </div>
            <div class="col-8 p-0 m-0">
                <input type="text" class="form-control form-control-sm text-dark mr-3" readonly style="background-color: white;" value="<?= $row['contact'] ?>">
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-danger" type="button" onclick="deleteContact(<?= $row['id'] ?>, '<?= $row['type'] ?>');">ลบ</button>
            </div>
        </div>
        <hr />
<?php
    }
}
?>

<script type="text/javascript">
    function deleteContact(id, type) {
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
                    url: "ajax/action/delete_contact.php",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log('res: ' + response);
                        showContactList();
                        showContactCard();
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