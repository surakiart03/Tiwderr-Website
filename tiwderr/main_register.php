<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    header("Location: ms-admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="assets/images/logo_icon.png" type="image/x-icon">
	<title>สมัครสมาชิก | TiWDERR</title>


	<!-- Vendor css -->
	<link rel="stylesheet" href="src/vendors/@mdi/font/css/materialdesignicons.min.css">

	<!-- Base css with customised bootstrap included -->
	<link rel="stylesheet" href="src/css/miri-ui-kit-free.css">

	<!-- Stylesheet for demo page specific css -->
	<link rel="stylesheet" href="./assets/css/demo.css">
	<link rel="stylesheet" href="./assets/css/tab-card.css">
	<link rel="stylesheet" href="./assets/css/style.css">
	<!-- Font style -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<style>
		body {
			font-family: 'Kanit', sans-serif;
		}
	</style>
</head>

<?php
if (isset($_SESSION['username'])) {
	header("Location: profile.php");
}
include "layout/header_nobanner.php"
?>

<body>
	<section class="vh-70">
		<div class="container py-5 ">
			<div class="row d-flex justify-content-center align-items-center">
				<div class="col-12 col-md-8 col-lg-6 col-xl-7.5">
					<div class="card shadow-2-strong" style="border-radius: 1rem;">
						<div class="card-body p-5 text-">
							<h2 class="mb-3 text-center">สมัครสมาชิก</h2>
							<div style="padding-top:30px" class="panel-body">
								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								<div class="row">
									<div class="col"><a href="std_register.php" class="btn btn-outline-danger btn-block btn-lg">สมัครเป็นผู้เรียน</a></div>
								</div>
							</div>
							<div style="padding-top:30px" class="panel-body">
								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								<div class="row">
									<div class="col"><a href="tutor_register.php" class="btn btn-outline-primary btn-block btn-lg">สมัครเป็นติวเตอร์</a></div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include "layout/footer.php" ?>
    <script src="src/vendors/jquery/dist/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
		var password = document.getElementById("password"),
			confirm_password = document.getElementById("confirm_password");

		function validatePassword() {
			if (password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords Don't Match");
			} else {
				confirm_password.setCustomValidity('');
			}
		}

		// password.onchange = validatePassword;
		// confirm_password.onkeyup = validatePassword;
	</script>
</body>

</html>