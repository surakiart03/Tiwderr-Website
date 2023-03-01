<?php
require_once("../../../connection/connect_db.php");

$sql = "SELECT 
        COUNT(CASE WHEN a.id AND a.role != 'admin' then 1 ELSE NULL END) as total_user,
        COUNT(CASE WHEN a.role = 'tutor' then 1 ELSE NULL END) total_tutor,
        COUNT(CASE WHEN a.role = 'student' then 1 ELSE NULL END) total_student,
        COUNT(CASE WHEN a.is_verified = 0 AND a.role != 'admin' then 1 ELSE NULL END) not_verify,
        COUNT(CASE WHEN a.is_verified = 1 AND a.role != 'admin' then 1 ELSE NULL END) is_verify,
        COUNT(CASE WHEN a.is_approved = 0 AND b.coppied_id IS NULL AND a.role != 'admin' AND a.role != 'student' then 1 ELSE NULL END) as none_approved,
        COUNT(CASE WHEN a.is_approved = 0 AND b.coppied_id IS NOT NULL AND a.role != 'admin' AND a.role != 'student' then 1 ELSE NULL END) as not_approved,
        COUNT(CASE WHEN a.is_approved = 1 AND a.role != 'admin' AND a.role != 'student' then 1 ELSE NULL END) as is_approved
        FROM tbl_user a
        LEFT JOIN tbl_user_info b ON a.username = b.username
        ;";

if (mysqli_query($conn, $sql)) {
    $result = mysqli_query($conn, $sql);
}
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $total_user = $row['total_user'];
        $total_tutor = $row['total_tutor'];
        $total_student = $row['total_student'];
        $not_verify = $row['not_verify'];
        $is_verify = $row['is_verify'];
        $none_approved = $row['none_approved'];
        $not_approved = $row['not_approved'];
        $is_approved = $row['is_approved'];
    }
} else {
    echo "0 results";
}
?>
<div class="container-flex">
    <div class="row  h-100 ">
        <div class="col-xl-3 col-md-12 mb-4 align-items-xl-stretch">
            <div class="card shadow border-primary">
                <!-- Card Header - Dropdown -->
                <div class="card-header text-primary">
                    <div class="font-weight-bold text-justify">ผู้ใช้ทั้งหมด</div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-pie"> -->
                        <canvas id="myPieChart"></canvas>
                    <!-- </div> -->
                    <div class="text-center small mt-2">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #78acec;"></i> ติวเตอร์
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #ec78ac;"></i> ผู้เรียน
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-12 mb-4">
            <div class="card shadow bg-info text-white">
                <div class="card-body">
                    <div class="col align-items-center">
                        <div class="h1 mb-5 text-center"><i class="fas fa-solid fa-users" style="font-size: 3rem;"></i></div>
                        <div class="h1 mb-5 font-weight-bold text-center"><?= $total_user ?></div>
                        <div class="h2 text-center card-title">บัญชีผู้ใช้</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow bg-success text-white">
                <div class="card-body">
                    <div class="col align-items-center">
                        <div class="h1 mb-5 font-weight-bold text-center"><i class="fas fa-chalkboard-teacher" style="font-size: 3rem;"></i></div>
                        <div class="h1 mb-5 font-weight-bold text-center"><?= $total_tutor ?></div>
                        <div class="h2 text-center card-title">ติวเตอร์</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow bg-warning text-white">
                <div class="card-body">
                    <div class="col align-items-center">
                        <div class="h1 mb-5 font-weight-bold text-center"><i class="fas fa-book-reader" style="font-size: 3rem;"></i></div>
                        <div class="h1 mb-5 font-weight-bold text-center"><?= $total_student ?></div>
                        <div class="h2 text-center card-title">ผู้เรียน</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-12 mb-2">
            <div class="card mb-2 border-success text-success">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col mt-0">
                            <h6 class="card-title">ยืนยันบัญชีแล้ว</h6>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-solid fa-envelope"  style="font-size: 3rem;"></i>
                            <!-- <i class="fas fa-solid fa-envelope-circle-check" ></i> -->
                        </div>
                    </div>
                    <h2 class="mt-0"><?= $is_verify ?> </h2>
                </div>
            </div>
            <div class="card mb-2 border-danger text-danger">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col mt-0">
                            <h6 class="card-title">ยังไม่ยืนยันบัญชี</h6>
                        </div>

                        <div class="col-auto">
                        <i class="fas fa-solid fa-envelope-open"  style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h2 class="mt-0"><?= $not_verify ?> </h2>
                </div>
            </div>
                    </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card shadow border-primary">
                <!-- Card Header - Dropdown -->
                <div class="card-header text-primary">
                    <div class="font-weight-bold text-justify">การยืนยันอีเมล</div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-pie"> -->
                        <canvas id="myPieChart2"></canvas>
                    <!-- </div> -->
                    <div class="text-center small mt-2">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #ec78ac;"></i> ยังไม่ยืนยัน
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #36b9cc;"></i> ยืนยันแล้ว
                        </span>
                    </div>
                </div>
            </div>
        </div>
	<div class="col-xl-3 col-md-12 mb-2">
            <div class="card mb-2 border-success text-success">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col mt-0">
                            <h6 class="card-title">ตรวจสอบแล้ว</h6>
                        </div>

                        <div class="col-auto">  
                            <i class="fas fa-solid fa-user-check" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h2 class="mt-0"><?= $is_approved ?> </h2>
                </div>
            </div>
            <div class="card border-danger text-danger">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col mt-0">
                            <h6 class="card-title">ยังไม่ตรวจสอบ</h6>
                        </div>

                        <div class="col-auto">
                        <i class="fas fa-solid fa-user-clock" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h2 class="mt-0"><?= $not_approved ?> </h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card shadow border-primary">
                <!-- Card Header - Dropdown -->
                <div class="card-header text-primary">
                    <div class="font-weight-bold text-justify">การตรวจสอบตัวตน</div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <div class="chart-pie "> -->
                        <canvas id="myPieChart3"></canvas>
                    <!-- </div> -->
                    <div class="text-center small mt-2">
			<span class="mr-2">
                            <i class="fas fa-circle" style="color: #ec78ac ;"></i> ไม่ยืนยัน
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #78acec;"></i> รอ
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #36b9cc;"></i> ผ่าน
                        	</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    ctx.width = 100;
    ctx.height = 67;
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["ติวเตอร์", "ผู้เรียน"],
            datasets: [{
                data: [<?= $total_tutor; ?>, <?= $total_student; ?>],
                backgroundColor: ['#78acec', '#ec78ac', '#36b9cc'],
                hoverBackgroundColor: ['#78a0ec', '#ec78a0', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 10,
                yPadding: 10,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            // cutoutPercentage: 80,
        },
    });

    var ctx2 = document.getElementById("myPieChart2");
    ctx2.width = 100;
    ctx2.height = 64;
    var myPieChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ["ยังไม่ยืนยืน", "ยืนยันแล้ว"],
            datasets: [{
                data: [<?= $not_verify; ?>, <?= $is_verify; ?>],
                backgroundColor: ['#ec78ac', '#36b9cc'],
                hoverBackgroundColor: ['#ec78a0', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            // cutoutPercentage: 80,
        },
    });

    var ctx4 = document.getElementById("myPieChart3");
    ctx4.width = 100;
    ctx4.height = 64;
    var myPieChart4 = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: ["ไม่ยืนยัน", "รอ" ,"ผ่าน"],
            datasets: [{
                data: [<?= $none_approved; ?>, <?= $not_approved; ?>, <?= $is_approved; ?>],
                backgroundColor: ['#ec78ac', '#78acec',  '#36b9cc'],
                hoverBackgroundColor: ['#ec78a0', '#78a0ec', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            // cutoutPercentage: 80,
        },
    });
</script>