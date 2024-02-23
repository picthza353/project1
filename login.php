<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>

<?php 
if(isset($_POST["login"])){
  checkLoginEmployer($_POST["username"],$_POST["password"]);
}

?>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->  

      <!-- Body main wrapper start -->
      <div class="wrapper">
        <?php
        require_once("nav.php");
        ?>
        <!-- Start Login Register Area -->
        <div class="htc__login__register bg__white ptb--150">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu" role="tablist">
                  <li role="presentation" class="login"><p class="text-gradient">ยินดีต้อนรับ </p></li>

                </ul>
              </div>
            </div>
            <!-- Start Login Register Content -->
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                  <!-- Start Single Content -->
                  <form name="prduct_detail_form" class="login" action="" method="post" enctype="multipart/form-data">
                    <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                      <input type="text" placeholder="ชื่อผู้ใช้งาน*" name="username" class="input"required>
                      <input type="password" placeholder="รหัสผ่าน*" name="password" class="input" required>

                      <div class="htc__login__btn mt--30">
                        <input type="submit" name="login" value="เข้าสู่ระบบ" class="btn-login">
                      </div>

                    </div>
                  </form>
                  <!-- End Single Content -->

                </div>
              </div>
            </div>
            <!-- End Login Register Content -->
          </div>
        </div>
        <!-- End Login Register Area -->
        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>