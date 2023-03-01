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
            COUNT(CASE WHEN A.is_approved = 0 AND B.coppied_id IS NULL then 1 ELSE NULL END) as `none`,
            COUNT(CASE WHEN A.is_approved = 0 AND B.coppied_id IS NOT NULL then 1 ELSE NULL END) as `waiting`,
            COUNT(CASE WHEN A.is_approved = 1 then 1 ELSE NULL END) as `pass`
        FROM `tbl_user` A 
            LEFT JOIN `tbl_user_info` B 
            ON A.username = B.username 
        WHERE A.role = 'tutor'"; 

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_assoc($result);
    $num[0] = $row['all'];
    $num[1] = $row['none'];
    $num[2] = $row['waiting'];
    $num[3] = $row['pass'];
}

echo json_encode($num);
