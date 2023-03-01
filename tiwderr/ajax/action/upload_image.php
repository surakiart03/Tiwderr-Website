<?php

if (isset($_POST["image"])) {
	$data = $_POST["image"];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$name = md5(rand(100, 200));

	$imageName =  $name . '.jpg';

	$path = '../../temp/images/' . $imageName;

	file_put_contents($path, $data);

	echo $imageName;
}

?>
