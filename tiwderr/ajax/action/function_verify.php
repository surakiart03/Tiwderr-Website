<script src="src/vendors/jquery/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
require_once("../../connection/connect_db.php");
if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];
    $query = "SELECT * FROM tbl_user WHERE email like '$email' AND verification_code like '$v_code'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['is_verified'] == 0) {
            $v_code = bin2hex(random_bytes(16)); //, verification_code = '$v_code'
            $update = "UPDATE tbl_user 
                        SET is_verified = 1
                            
                            , verified_time = NOW() 
                        WHERE email = '$email'";
            if (mysqli_query($conn, $update)) {
                echo "
                    <script type='text/javascript'>
                        $(document).ready(function(){
                            Swal.fire({
                                title: 'ยืนยันตัวตนสำเร็จ',
                                text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                                icon: 'success',
                                timer: 5000,
                                confirmButtonColor: '#3085d6',
                                timerProgressBar: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href='../../login.php';
                                }
                              })
                        });
                        setTimeout(function() {
							location.href = '../../login.php'
						}, 5000);
                    </script>
                    ";
            }
        } else {
            echo "
                <script type='text/javascript'>
                    $(document).ready(function(){
                        Swal.fire({
                            title: 'บัญชีผู้ใช้เคยได้รับการยืนยันแล้ว',
                            text: 'กำลังไปยังหน้าเข้าสู่ระบบภายใน 5 วินาที',
                            icon: 'error',
                            timer: 5000,
                            confirmButtonColor: '#3085d6',
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href='../../login.php';
                            }
                          })
                    });
                    setTimeout(function() {
						location.href = '../../login.php'
					}, 5000);
                </script>
                ";
        }
    } else {
    }
}
