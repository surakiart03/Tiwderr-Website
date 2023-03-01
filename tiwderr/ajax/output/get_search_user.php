<?php
session_start();

$Wh = (!isset($_SESSION['username']) ? " AND B.role = 'tutor'" : "");

require_once("../../connection/connect_db.php");
if (!empty($_POST["keyword"])) {
    $sql = $conn->prepare("SELECT A.username, A.profile_name, A.profile_pic, B.role 
                            FROM `tbl_user_info` A INNER JOIN `tbl_user` B 
                                ON A.username = B.username
                            WHERE (A.profile_name LIKE  ? $Wh ) OR (A.username LIKE  ? $Wh ) ORDER BY A.profile_name");
    $search = "%{$_POST['keyword']}%";
    $sql->bind_param("ss", $search, $search);
    $sql->execute();
    $result = $sql->get_result();
    if (!empty($result)) {
?>

        <?php
        foreach ($result as $row) {
        ?>
            <div class="row px-3 py-1 mouse-hover-bg" onClick="window.location='profile.php?username=<?php echo $row["username"]; ?>';">
                <div class="col-3 p-0 justify-content-center align-items-center" onClick="window.location='profile.php?username=<?php echo $row["username"]; ?>';">

                    <figure class="d-inline-block mr-3">
                        <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                    </figure>
                </div>
                <div class="col-9 p-0">
                    <span class="p-0 m-0 text-dark"><b><?= $row['profile_name'] ?></b></span><br />
                    <span class="p-0 m-0 text-secondary"><?= $row['username'] ?></span><br />
                    <span class="p-0 m-0 text-secondary"><?= ($row['role'] == "tutor" ? "ติวเตอร์" : "ผู้เรียน") ?></span>
                </div>
            </div>
        <?php
        } // end for
        ?>

    <?php
    } else {
    ?>
        <div class="row px-3 py-1 mouse-hover-bg" onClick="window.location='profile.php?username=<?php echo $row["username"]; ?>';">
            <div class="col-3 p-0 justify-content-center align-items-center" onClick="window.location='profile.php?username=<?php echo $row["username"]; ?>';">

                <figure class="d-inline-block mr-3">
                    <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                </figure>
            </div>
            <div class="col-9 p-0">
                <span class="p-0 m-0 text-dark"><b><?= $row['profile_name'] ?></b></span><br />
                <span class="p-0 m-0 text-secondary"><?= $row['username'] ?></span><br />
                <span class="p-0 m-0 text-secondary"><?= ($row['role'] == "tutor" ? "ติวเตอร์" : "ผู้เรียน") ?></span>
            </div>
        </div>
<?php
    }
}
?>