<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentEmployer = getCurrentEmployer($_GET["id"]);

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    saveEmployer($_POST["username"],$_POST["password"],$_POST["firstname"],$_POST["lastname"],$_POST["address"],$_POST["email"],$_POST["telephone"],$_POST["company_name"],$_POST["juristic_person"],$_POST["company_address"]);
  }else{
    editEmployer($_POST["id"],$_POST["username"],$_POST["password"],$_POST["firstname"],$_POST["lastname"],$_POST["address"],$_POST["email"],$_POST["telephone"],$_POST["company_name"],$_POST["juristic_person"],$_POST["company_address"]);
  }
}

if($_GET["id"] == ""){
  $txtHead = "เพิ่ม ผู้ว่าจ้าง";
}else{
  $txtHead = "แก้ไข ผู้ว่าจ้าง";
}

?>
<body class="g-sidenav-show  bg-gray-100">
  <?php
  require_once("side_bar.php");
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php
    require_once("nav.php");
    ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <form name="prduct_detail_form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentEmployer["id"];?>">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo $txtHead;?></h4>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Username<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="username" id="usernameEmp" value="<?php echo $currentEmployer["username"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Password<span style="color: red;"> *</span></label>
                      <input type="password" class="form-control" name="password" value="<?php echo $currentEmployer["password"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="firstname" value="<?php echo $currentEmployer["firstname"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">นามสกุล<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="lastname" value="<?php echo $currentEmployer["lastname"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ที่อยู่</label>
                      <input type="text" class="form-control" name="address" value="<?php echo $currentEmployer["address"];?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">บริษัท</label>
                      <input type="text" class="form-control" name="company_name" value="<?php echo $currentEmployer["company_name"];?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่ ทะเบียนนิติบุคคล</label>
                      <input type="text" class="form-control" name="juristic_person" value="<?php echo $currentEmployer["juristic_person"];?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ที่ตั้ง สำนักงาน</label>
                      <input type="text" class="form-control" name="company_address" value="<?php echo $currentEmployer["company_address"];?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">อีเมล<span style="color: red;"> *</span></label>
                      <input type="email" class="form-control" name="email" id="emailEmp" value="<?php echo $currentEmployer["email"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">หมายเลขโทรศัพท์<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="telephone" id="telephoneEmp" value="<?php echo $currentEmployer["telephone"];?>" required>
                    </div>
                  </div>
                </div>
                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="บันทึก">
                  <input type="button" name="button" class="btn btn-danger btn-round" onClick="javascript:history.go(-1)" value="ย้อนกลับ">

                </div>
                <div class="clearfix"></div>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile">
              <img class="img-fluid shadow border-radius-xl" src="images/emp_ico.png" />
            </div>
          </div>
        </div>

      </form>
      <?php
      require_once("footer.php");
      ?>
    </div>
  </main>


</body>

</html>