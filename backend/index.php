<!DOCTYPE html>
<html lang="en">

<?php
require_once("header.php");
?>
<?php 
if(isset($_POST["login"])){
  checkLogin($_POST["username"],$_POST["password"]);
}
?>
<body class="" style="margin-top: -25px;">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <img src="images/logo.png" class="img-fluid" style="width:75px;height:75px;">
                  <h3 class="font-weight-bolder text-info text-gradient">ยินดีต้อนรับ </h3>
                  <p class="mb-0">ป้อนชื่อผู้ใช้และรหัสผ่านของคุณเพื่อเข้าสู่ระบบ</p>
                </div>
                <div class="card-body">
                  <form role="form" action="" method="post">
                    <label>ชื่อผู้ใช้งาน</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" name="username">
                    </div>
                    <label>รหัสผ่าน</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="text-center">
                      <input type="submit" name="login" value="เข้าสู่ระบบ" class="btn bg-gradient-info w-100 mt-4 mb-0">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('images/gallery_work/LINE_ALBUM_บ้านลุงติ้ว_๒๓๑๑๒๒_17.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> เว็บไซต์ระบบการจัดการผู้รับเหมาก่อสร้าง
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
</body>

</html>