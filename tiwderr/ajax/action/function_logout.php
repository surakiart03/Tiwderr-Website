<?php 
session_start();
session_destroy();
if(isset($_COOKIE['username'])) {
	unset($_COOKIE['username']);
	setcookie('username', '', time()-86400);
}
// redirect("../../login.php");
header("Location: ../../login.php");
?>
