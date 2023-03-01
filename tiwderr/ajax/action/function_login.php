<?php

if (isset($_POST['check'])) {
	require_once("../../connection/connect_db.php");
	$email		= $_POST['email'];
	$passWord	= md5($_POST['password']);

	$sql = "SELECT * FROM `tbl_user` WHERE `email` = '$email' AND user_password = '$passWord'";
	$result = mysqli_query($conn, $sql);
	// print_r($sql);
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_assoc($result);

		$username = $row['username'];
		$verified = $row['is_verified'];
		
		if ($verified == 1) {

			$sql_user = "SELECT A.*, B.profile_pic 
						FROM `tbl_user` A 
						INNER JOIN `tbl_user_info` B 
						ON A.username = B.username
						WHERE A.username = '$username'";

			$result_user = mysqli_query($conn, $sql_user);

			if (mysqli_num_rows($result_user) != 0) {
				while ($row3 = mysqli_fetch_assoc($result_user)) {
					$session_keys = array_keys($row3);
					foreach ($session_keys as $keys) {
						$_SESSION[$keys] = $row3[$keys];
					}
				}
				echo "success";
			}
		} else {
			echo "not verified";
		}
	} else {
		echo "not found";
	}
	// $check = "is_verified FROM tbl_user WHERE email = '$email' AND user_password = '$passWord'";
	// $result2 = $conn->query($check);

	// if ($result2->num_rows > 0) {
	// 	// output data of each row
	// 	while ($row = $result2->fetch_assoc()) {
	// 		$verified = $row['is_verified'];
	// 		$sql = "SELECT username FROM tbl_user WHERE email = '$email' AND user_password = '$passWord' AND '$verified' = 1";
	// 		$result = $conn->query($sql);

	// 		if ($result->num_rows == 1) {
	// 			session_start();
	// 			while ($row2 = mysqli_fetch_assoc($result)) {
	// 				$us = $row2['username'];
	// 			}
	// 			if (isset($_POST['remember'])) {
	// 				setcookie('username', $us, time() + 86400);
	// 			}

	// 			// $_SESSION['username'] = $us;

	// 			$sql_user = "SELECT A.*, B.profile_pic 
	// 						FROM `tbl_user` A 
	// 						INNER JOIN `tbl_user_info` B 
	// 						ON A.username = B.username
	// 						WHERE A.username = '$_SESSION[username]'";
	// 			$result_user = mysqli_query($conn, $sql_user);

	// 			if (mysqli_num_rows($result_user) != 0) {
	// 				while ($row3 = mysqli_fetch_assoc($result_user)) {
	// 					$session_keys = array_keys($row3);
	// 					foreach ($session_keys as $keys) {
	// 						$_SESSION[$keys] = $row3[$keys];
	// 					}
	// 				}
	// 				echo "success";
	// 			}
	// 		} else {
	// 			echo "error";
	// 		}
	// 	}
	// }
	// exit();
}
