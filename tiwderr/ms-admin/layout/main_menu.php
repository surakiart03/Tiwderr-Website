        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="../assets/images/logo_icon.png" alt="logo" width="50px">
                </div>
                <div class="sidebar-brand-text mx-3">TiWDERR</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($menu == "index" ? "active" : "") ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>แดชบอร์ด</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                การจัดการ
            </div>

            <!-- Nav Item - manage_user -->
            <li class="nav-item <?= ($menu == "manage_user" ? "active" : "") ?>">
                <a class="nav-link" href="manage_user.php">
                    <i class="fas fa-table mr-1"></i>
                    <span>รายการบัญชีผู้ใช้</span></a>
            </li>

            <!-- Nav Item - manage_approve -->
            <li class="nav-item <?= ($menu == "manage_approve" ? "active" : "") ?>">
                <a class="nav-link" href="manage_approve.php">
                    <i class="fas fa-user-shield mr-1"></i>
                    <span>ตรวจสอบตัวตน</span></a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>ข้อความในระบบ</span></a>
            </li> -->

            <!-- Nav Item - questionair -->
            <li class="nav-item">
                <a class="nav-link" href="https://docs.google.com/forms/d/1-4LAoTwucYd0ddCmXOmV1xxZqpWQrEM4MCq9C6nBUoI/edit" target="_blank">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>สำรวจผู้ใช้</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                ตั้งค่า
            </div>

            <!-- Nav Item - admin stting -->
            <li class="nav-item <?= ($menu == "setting_admin" ? "active" : "") ?>">
                <a class="nav-link" href="setting_admin.php">
                    <i class="fas fa-cog"></i>
                    <span>ตั้งค่าผู้ดูแลระบบ</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->