<?php
session_start();


require_once("../../connection/connect_db.php");

$username = $_POST['username'];
$role = $_POST['role'];

$sql = "SELECT * FROM `tbl_tutor_experience` 
        WHERE `username` = '$username';";
$result = mysqli_query($conn, $sql);

$id = "";
$experience = "";
$username = "";
$last_update = "";
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $experience = $row['experience'];
    $username = $row['username'];
    $last_update = $row['last_update'];
}
?>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">ประสบการณ์การสอน</h6>
    </div>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="col-md-12">
            <?= $experience  ?>
        </div>
</div>
<hr />

<?php
    } else {
?>
    <div class="col-md-12">
        ไม่มีข้อมูลประสบการณ์สอน
    </div>
<?php
    }
?>