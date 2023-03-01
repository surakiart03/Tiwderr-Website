<?php
$conn = mysqli_connect("203.158.3.36", "prj65_02", "554281", "prj65_02");

if (mysqli_connect_error()) {
    $err = mysqli_connect_error();
    print_r('Connect DB falied : $err');
} else {
    //echo "<script>console.log('Connect DB Success');</script>";
    mysqli_set_charset($conn, "utf8");
}
?>