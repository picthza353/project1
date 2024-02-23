<!doctype html>
<html class="no-js" lang="en">

<?php
require_once("header.php");
?>

<?php 
$currentEmployer = getCurrentEmployer($_SESSION["id"]);
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
                    <h2 class="bradcaump-title">ข้อมูลส่วนตัว</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <section class="htc__contact__area bg__white ptb--150">
          <div class="container">
            <div class="col-md-8">
              <legend>รายละเอียด</legend>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ชื่อ-นามสกุล</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentEmployer["firstname"];?> <?php echo $currentEmployer["lastname"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["email"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["telephone"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["address"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["company_name"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["juristic_person"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentEmployer["company_address"];?></label>
                  </div>
                </div>
              </div>
              <div align="center">
                <a type="button" class="btn btn-warning btn-lg" href="edit_profile.php?id=<?php echo $currentEmployer["id"];?>">แก้ไข</a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <img class="img-fluid shadow border-radius-xl" src="backend/images/emp_ico.png" />
              </div>
            </div>



          </div>
        </section>

        

        


        <?php
        require_once("footer.php");
        ?>
      </div>


    </body>



    </html>