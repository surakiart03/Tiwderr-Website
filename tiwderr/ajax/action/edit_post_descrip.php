<?php
require_once("../../connection/connect_db.php");
session_start();

$id = $_POST['id'];
$post_descrip = $_POST['post_descrip'];

$sql = "UPDATE `tbl_post`
        SET `post_descrip` = ?
            , `last_update` = NOW()
        WHERE `id` = $id ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $post_descrip);

$result = $stmt->execute();

if ($result) {
    echo "Update tbl_post success ^-^\n"  . $sql;
} else {
    echo "Update tbl_post failed T-T\n"  . $sql;
}

$stmt->close();
