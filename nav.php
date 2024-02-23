<?php 

if (isset($_GET['logout'])) {
  logout();
}
$currentEmployer = getCurrentEmployer($_SESSION["id"]);
$checkStatusNumber = getCheckStatusNumber($_SESSION["id"]);
?>
<style>
.badge {
  background-color: red;
  color: white;
  padding: 4px 8px;
  text-align: center;
  border-radius: 5px;
}
</style>
<!-- Start Header Style -->
<div id="header" class="htc-header" >
  <!-- Start Header Top -->
  <div class="htc__header__top bg__cat--1">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
          <ul class="heaher__top__left">
            <li><i class="fa fa-clock-o"></i>7.30 AM  -  17.30 PM</li>
            <li><a href="#"><i class="fa fa-phone"></i>(+66)873128156</a></li>
          </ul>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
          <div class="header__top__right">
            <ul class="login-register">
              <?php if($_SESSION["id"] == "" && empty($_SESSION["id"])){ ?>
                <li><a href="login.php">เข้าสู่ระบบ</a></li>
              <?php }else{ ?>
                <li><a href="profile.php"><?php echo $currentEmployer["firstname"];?> <?php echo $currentEmployer["lastname"];?> <span class="badge"><?php echo $checkStatusNumber;?></span></a></li>
                <li class="separator">/</li>
                <li><a href="?logout=true">ออกจากระบบ</a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header Top -->
  <!-- Start Mainmenu Area -->
  <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="logo">
            <a href="index.php">
              <img src="images/logo/logo.png" alt="logo image" width="65" height="65">
            </a>
          </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-5">
          <nav class="main__menu__nav  hidden-xs hidden-sm">
            <ul class="main__menu">
              <li><a href="index.php">หน้าหลัก</a></li>
              <li><a href="all_result.php">ผลงาน</a></li>
              <li><a href="contact.php">ติดต่อ</a></li>
              <li><a href="backend/index.php">เข้าสู่ระบบพนักงาน</a></li>   
              <?php if($_SESSION["id"] != "" && !empty($_SESSION["id"])){ ?>
                <li><a href="progress.php">ความคืบหน้า</a></li>
              <?php } ?>
            </ul>
                  </nav>
                  <div class="mobile-menu clearfix visible-xs visible-sm">
                    <nav id="mobile_dropdown">
                      <ul>
                        <li><a href="index.php">หน้าหลัก</a></li>
                        <li><a href="all_result.php">ผลงาน</a></li>
                        <li><a href="contact.php">ติดต่อ</a></li>
                        <li><a href="backend/index.php">เข้าสู่ระบบพนักงาน</a></li>   
                        <?php if($_SESSION["id"] != "" && !empty($_SESSION["id"])){ ?>
                          <li><a href="progress.php">ความคืบหน้า</a></li>
                        <?php } ?>
                      </ul>
                    </nav>
                  </div> 
                </div>
              </div>
              <div class="mobile-menu-area"></div>
            </div>
          </div>
          <!-- End Mainmenu Area -->
        </div>
        <!-- End Header Style -->