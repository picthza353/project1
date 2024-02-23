<?php 

if (isset($_GET['logout'])) {
  logout();
}
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#" target="_blank">
      <img src="../backend/images/logo.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Menu</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <?php if($_SESSION["id"] != "" && !empty($_SESSION["id"])){ ?>
        <?php if($_SESSION["role"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link  <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">
              <span class="nav-link-text ms-1">หน้าหลัก</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_position.php' ? 'active' : ''; ?>" href="manage_position.php">
              <span class="nav-link-text ms-1">ตำแหน่ง</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_user.php' ? 'active' : ''; ?>" href="manage_user.php">
              <span class="nav-link-text ms-1">ผู้ใช้งาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_employer.php' ? 'active' : ''; ?>" href="manage_employer.php">
              <span class="nav-link-text ms-1">ผู้ว่าจ้าง</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_project.php' ? 'active' : ''; ?>" href="manage_project.php">
              <span class="nav-link-text ms-1">งานรับเหมา</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_schedule.php' ? 'active' : ''; ?>" href="manage_schedule.php">
              <span class="nav-link-text ms-1">บันทึกการทำงาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'history_schedule.php' ? 'active' : ''; ?>" href="history_schedule.php">
              <span class="nav-link-text ms-1">ประวัติการทำงาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_income_expense.php' ? 'active' : ''; ?>" href="manage_income_expense.php">
              <span class="nav-link-text ms-1">รายรับ-รายจ่าย</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_order_equipment.php' ? 'active' : ''; ?>" href="manage_order_equipment.php">
              <span class="nav-link-text ms-1">สั่งซื้อวัสดุ</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_salary.php' ? 'active' : ''; ?>" href="manage_salary.php">
              <span class="nav-link-text ms-1">คำนวนค่าแรง</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'check_project.php' ? 'active' : ''; ?>" href="check_project.php">
              <span class="nav-link-text ms-1">ตรวจสอบความคืบหน้า</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_result.php' ? 'active' : ''; ?>" href="manage_result.php">
              <span class="nav-link-text ms-1">สรุปผล</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_working.php' ? 'active' : ''; ?>" href="manage_working.php">
              <span class="nav-link-text ms-1">ผลงาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_tax.php' ? 'active' : ''; ?>" href="manage_tax.php">
              <span class="nav-link-text ms-1">ใบกำกับภาษี</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'job_last.php' ? 'active' : ''; ?>" href="job_last.php">
              <span class="nav-link-text ms-1">งานรับเหมาล่าสุด</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>" href="profile.php">
              <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  " href="?logout=true">
              <span class="nav-link-text ms-1">ออกจากระบบ</span>
            </a>
          </li>
          
        <?php } ?>
        <?php if($_SESSION["role"] == 2){ ?>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_employee.php' ? 'active' : ''; ?>" href="dashboard_employee.php">
              <span class="nav-link-text ms-1">หน้าหลัก </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'employee_work.php' ? 'active' : ''; ?>" href="employee_work.php">
              <span class="nav-link-text ms-1">สถานที่ทำงาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'employee_schedule.php' ? 'active' : ''; ?>" href="employee_schedule.php">
              <span class="nav-link-text ms-1">ประวัติการทำงาน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'employee_salary.php' ? 'active' : ''; ?>" href="employee_salary.php">
              <span class="nav-link-text ms-1">การรับเงินเดือน</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>" href="profile.php">
              <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  " href="?logout=true">
              <span class="nav-link-text ms-1">ออกจากระบบ</span>
            </a>
          </li>
        <?php } ?>
      <?php } ?>
    </ul>
  </div>

</aside>



