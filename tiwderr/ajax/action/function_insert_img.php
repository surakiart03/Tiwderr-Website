<?php

// Include database connectivity

require_once("../../connection/connect_db.php");

// upload profile_pic using move_uploaded_file function in php

if (!empty($_FILES['profile_pic']['name'])) {

	$fileName = $_FILES['profile_pic']['name'];

	$fileExt = explode('.', $fileName);
	$fileActExt = strtolower(end($fileExt));
	$allowImg = array('png', 'jpeg', 'jpg' , 'pdf');
	$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
	$filePath = 'uploads/' . $fileNew;

	if (in_array($fileActExt, $allowImg)) {
		if ($_FILES['profile_pic']['size'] > 0  && $_FILES['profile_pic']['error'] == 0) {
			$query = "INSERT INTO test_user (profile_pic) VALUES('$fileNew')";
			if (mysqli_query($conn, $query)) {
				move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath);
				echo 'ไปเบิ่งไฟล์จ้า';
				// echo '<img src="' . $filePath . '" style="width:320px; height:300px;"/>';
			} else {
				echo json_encode(array('error' => '0', 'message' => 'อัพโหลดไม่สำเร็จ โปรดลองอีกครั้ง'));
			}
		} else {
			echo json_encode(array('error' => '0', 'message' => 'Unable to upload physical profile_pic'));
		}
	} else {
		echo json_encode(array('error' => '0', 'message' => 'Only PNG, JPEG, JPG image allow'));
	}
}
