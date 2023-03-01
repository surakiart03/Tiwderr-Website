<?php
session_start();
require_once("../../../connection/connect_db.php");

$Wh = array(""
    , "AND A.is_approved = 0 AND B.coppied_id IS NULL"
    , "AND A.is_approved = 0 AND B.coppied_id IS NOT NULL"
    , "AND A.is_approved = 1");

$i = "";
$num = array();

$sql = "SELECT 
            COUNT(*) as `all`,
            COUNT(CASE WHEN `role` = 'tutor' then 1 ELSE NULL END) as `tutor`,
            COUNT(CASE WHEN `role` = 'student' then 1 ELSE NULL END) as `student`
        FROM `tbl_user`"; 

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);
    $num[0] = $row['all'];
    $num[1] = $row['tutor'];
    $num[2] = $row['student'];
}

echo json_encode($num);
