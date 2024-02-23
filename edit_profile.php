<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>

<?php 
$currentEmployer = getCurrentEmployer($_GET["id"]);

if(isset($_POST["submit"])){
    editProfileEmployer($_POST["id"],$_POST["username"],$_POST["password"],$_POST["firstname"],$_POST["lastname"],$_POST["address"],$_POST["email"],$_POST["telephone"],$_POST["facebook_name"],$_POST["line_id"],$_POST["company_name"],$_POST["juristic_person"],$_POST["company_address"]);
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
        
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" data--black__overlay="6" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">แก้ไขข้อมูลส่วนตัว</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
      <form name="prduct_detail_form" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="id" value="<?php echo $currentEmployer["id"];?>">
        <section class="htc__contact__area bg__white ptb--150">
          <div class="container">
            <div class="col-md-8">
              <legend>รายละเอียด</legend>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="bmd-label-floating">ชื่อ</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $currentEmployer["firstname"];?>" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="bmd-label-floating">นามสกุล</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $currentEmployer["lastname"];?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">อีเมล</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo $currentEmployer["email"];?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">หมายเลขโทรศัพท์</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" name="telephone" value="<?php echo $currentEmployer["telephone"];?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ที่อยู่</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address" value="<?php echo $currentEmployer["address"];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">บริษัท</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" name="company_name" value="<?php echo $currentEmployer["company_name"];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เลขที่ ทะเบียนนิติบุคคล</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" name="juristic_person" value="<?php echo $currentEmployer["juristic_person"];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ที่ตั้ง สำนักงาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" class="form-control" name="company_address" value="<?php echo $currentEmployer["company_address"];?>" >
                  </div>
                </div>
              </div>
              <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-lg" value="บันทึก">
                  <input type="button" name="button" class="btn btn-danger btn-lg" onClick="javascript:history.go(-1)" value="ย้อนกลับ">
                </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <img class="img-fluid shadow border-radius-xl" src="backend/images/emp_ico.png" />
              </div>
            </div>



          </div>
        </section>
        </form>

        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>