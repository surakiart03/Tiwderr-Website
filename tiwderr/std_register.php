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
	<link rel="stylesheet" href="./assets/css/show-password-toggle.css">
	<link rel="stylesheet" href="./assets/css/show-password-toggle.css.map">
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


<body class="bg-gradient-white">

	<?php
	if (isset($_SESSION['username'])) {
		header("Location: profile.php");
	}
	include "layout/header_nobanner.php";
	include_once "./connection/connect_db.php";
	?>

	<section class="">
		<div class="container py-5 h-50">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-2-strong" style="border-radius: 1rem;">
						<div class="card-body p-5">
							<div>
								<h2 class="mb-3 text-center">สมัครเป็นผู้เรียน</h2>
							</div>
							<form role="form" method="post" name="std_regFrm" id="std_regFrm">
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group m-0 p-0 mt-3">
												<label class="text-primary">ชื่อผู้ใช้</label><span style="position: absolute; right: 0;"></span>
												<input type="text" name="userName" id="userName" class="form-control form-control-sm text-dark input-lg " placeholder="ระบุชื่อผู้ใช้" maxlength="20">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group m-0 p-0 mt-3">
												<label class="text-primary">อีเมล</label><span style="position: absolute; right: 0;"></span>
												<input type="email" name="email" id="email" class="form-control form-control-sm text-dark input-lg " placeholder="ระบุอีเมล" maxlength="40">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group m-0 p-0 mt-3">
												<label class="text-primary">เบอร์โทรศัพท์</label><span style="position: absolute; right: 0;"></span>
												<input type="text" name="user_phone" id="user_phone" class="form-control form-control-sm text-dark input-lg " placeholder="ระบุเบอร์โทรศัพท์" maxlength="12">
											</div>
										</div>

										<div class="col-md-6 mt-3">
											<label class="text-primary">รหัสผ่าน</label>
											<div class="input-group">
												<input type="password" name="passWord" id="passWord" class="form-control form-control-sm text-dark input-lg" placeholder="ระบุรหัสผ่าน" maxlength="16" required>
												<button id="toggle-password" type="button" class="d-none" aria-label="Hide password."></button>
											</div>
										</div>

										<div class="col-md-6 mt-3">
											<label class="text-primary">ยืนยันรหัสผ่าน</label>
											<div class="input-group">
												<input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm text-dark input-lg " placeholder="ยืนยันรหัสผ่าน" maxlength="16" required>
												<button id="toggle-password-2" type="button" class="d-none-2" aria-label="Hide password."></button>
											</div>
											<input type="hidden" name="role" id="role" value="student" required>
										</div>
									</div>
								</div>

								<br>
								<div class="row">
									<div class="col-md-12 text-center">
										เมื่อคลิกสมัคร แสดงว่าคุณยินยอมตาม<br><span class="mouse-hover text-primary" onclick ="showTiwderrInfo('md_terms')">ข้อกำหนด</span>และ<span class="mouse-hover text-primary" onclick ="showTiwderrInfo('md_privacy')">นโยบายความเป็นส่วนตัว</span>ของเรา
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										<div class="col m-0 p-0">
											<button type="submit" name="submit" id="submit" value="สมัครสมาชิก" class="btn btn-primary btn-sm btn-block">สมัคร</button>
										</div>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col-md-12">
										<div class="form-group m-0 p-0 mb-1">
											<div class="col text-center">เป็นสมาชิกแล้วใช่ไหม? <a href="login.php">เข้าสู่ระบบ</a> เลย</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div id="forModal">
	</div>

	<section>
		<?php
		include "layout/footer.php"
		?>
	</section>

	<script src="src/vendors/jquery/dist/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
	<script src="./assets/js/show-password-toggle.min.js" async></script>
	<script type="text/javascript">
		$('document').ready(function() {
			$('#user_phone').inputmask('999-999-9999');
			var userName_state = false;
			var email_state = false;
			var phone_state = false;
			var text_alert2 = "กรุณากรอกข้อมูลของคุณ";

			$('#userName').on('blur', function() {
				var userName = $('#userName').val();
				if (userName == '') {
					userName_state = false;
					$('#userName').siblings("span").text("");
					text_alert2 = "โปรดระบุชื่อผู้ใช้";
					return;
				}
				$.ajax({
					url: 'ajax/action/function_form_checker.php',
					type: 'post',
					data: {
						'userName_check': 1,
						'userName': userName
					},
					success: function(response) {
						if (response == 'taken') {
							userName_state = false;
							$('#userName').siblings("span").text("ขออภัย ชื่อผู้ใช้ซ้ำกับในระบบ").css({
								"color": "#f12459"
							});
							text_alert2 = "โปรดตรวจสอบความถูกต้องข้อมูลของคุณ !";
						} else if (response == "not_taken") {
							userName_state = true;
							$('#userName').siblings("span").text("");
						}
					}
				})
			});

			$('#email').on('blur', function() {
				var email = $('#email').val();
				if (email == '') {
					email_state = false;
					$('#email').siblings("span").text("");
					text_alert2 = "โปรดระบุอีเมล";
					return;
				}
				$.ajax({
					url: 'ajax/action/function_form_checker.php',
					type: 'post',
					data: {
						'email_check': 1,
						'email': email
					},
					success: function(response) {
						if (response == 'taken') {
							email_state = false;
							$('#email').siblings("span").text("ขออภัย อีเมลซ้ำกับในระบบ").css({
								"color": "#f12459"
							});
							text_alert2 = "โปรดตรวจสอบความถูกต้องข้อมูลของคุณ !";
						} else if (response == "not_taken") {
							email_state = true;
							$('#email').siblings("span").text("");
						}
					}
				})
			});

			$('#user_phone').on('blur', function() {
				var user_phone = $('#user_phone').val();
				user_phone = user_phone.replaceAll("-", "");
				if (user_phone == '') {
					phone_state = false;
					$('#user_phone').siblings("span").text("");
					text_alert2 = "โปรดระบุเบอร์โทรศัพท์";
					return;
				}
				$.ajax({
					url: 'ajax/action/function_form_checker.php',
					type: 'post',
					data: {
						'phone_check': 1,
						'user_phone': user_phone
					},
					success: function(response) {
						if (response == 'taken') {
							phone_state = false;
							$('#user_phone').siblings("span").text("ขออภัย เบอร์ซ้ำกับในระบบ").css({
								"color": "#f12459"
							});
							text_alert2 = "โปรดตรวจสอบความถูกต้องข้อมูลของคุณ !";
						} else if (response == "not_taken") {
							phone_state = true;
							$('#user_phone').siblings("span").text("");
						}
					}
				})
			});

			$("#std_regFrm").on("submit", function(e) {
				if (userName_state == false || email_state == false || phone_state == false) {
					e.preventDefault()
					Swal.fire({
						title: text_alert2,
						icon: 'warning',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'ตกลง'
					})
				} else {
					e.preventDefault()
					checkForm();
				}
			});

		});

		function checkForm() {
			// var pattern_thai = /^[ก-๏\s]+$/u;
			// var pattern_eng = /^[a-zA-Z0-9_\s]+$/;
			var pattern_eng2 = /^[a-zA-Z0-9_\s]+$/;

			var empty_input = 0;
			var text_alert = "";

			var userName = $('#userName').val();
			var profile_name = $('#userName').val();
			var email = $('#email').val();
			var phone = $('#user_phone').val();
			var passWord = $('#passWord').val();
			var confirm_password = $('#confirm_password').val();
			var profile_pic = "default_pic.png";


			var atpos = email.indexOf('@');
			var dotpos = email.lastIndexOf('.com');

			if (!$('#userName').val()) {
				empty_input += 1;
				text_alert = "โปรดระบุชื่อผู้ใช้";
				$("#userName").focus();

			} else if (!userName.match(pattern_eng2)) {
				empty_input += 1;
				text_alert = "ชื่อผู้ใช้ต้องเป็นภาษาอังกฤษเท่านั้น";
				$("#userName").focus();

			} else if (!$('#email').val()) {
				empty_input += 1;
				text_alert = "โปรดระบุอีเมล";
				$("#email").focus();

			} else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
				empty_input += 1;
				text_alert = "โปรดระบุรูปแบบอีเมลที่ถูกต้อง !!";
				$("#email").focus();

			} else if (!$('#user_phone').val()) {
				empty_input += 1;
				text_alert = "โปรดระบุเบอร์โทรศัพท์";

			} else if (!$('#passWord').val()) {
				empty_input += 1;
				text_alert = "โปรดระบุรหัสผ่าน";
				$("#passWord").focus();

			} else if (passWord.length < 7 && passWord.length <= 16) {
				empty_input += 1;
				text_alert = "รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษรและไม่เกิน 16 ตัวอักษร !!";
				$("#passWord").focus();

			} else if (!$("#confirm_password").val()) {
				empty_input += 1;
				text_alert = "โปรดยืนยันรหัสผ่าน";
				$("#confirm_password").focus();

			} else if (confirm_password != passWord) {
				empty_input += 1;
				text_alert = "รหัสผ่านไม่ตรงกัน";
				$("#confirm_password").focus();

			} else {}

			if (empty_input != 0) {
				Swal.fire({
					title: text_alert,
					icon: 'warning',
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'ตกลง'
				})
			} else {
				addStdUser();
			}
		}

		function addStdUser() {
			var formData = new FormData();
			formData.append("userName", $("#userName").val());
			formData.append("profile_name", $("#userName").val());
			formData.append("email", $("#email").val());
			formData.append("phone", $("#user_phone").val());
			formData.append("passWord", $("#passWord").val());
			formData.append("role", "student");
			{
				$.ajax({
					url: "./ajax/action/function_insert_std.php",
					type: "POST",
					cache: false,
					data: formData,
					contentType: false, // you can also use multipart/form-data replace of false
					processData: false,
					success: function(response) {
						console.log(response);
						Swal.fire({
							title: 'สมัครสมาชิกสำเร็จ',
							text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
							icon: 'success',
							timer: 5000,
							confirmButtonColor: '#3085d6',
							timerProgressBar: true,
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = 'login.php';
							}
						})
						setTimeout(function() {
							location.href = "login.php"
						}, 5000);
					}
				});
				$('#std_regFrm')[0].reset();
			}
		}

		function showTiwderrInfo(path) {
			$.ajax({
				type: "post",
				url: "ajax/a-tiwderr/" + path + ".php",
				data: {

				},
				success: function(response) {
					$("#forModal").html(response);
					$("#" + path).modal("toggle");

				}
			});
		}

	</script>
</body>

</html>