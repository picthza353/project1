<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentUser = getCurrentUser($_SESSION["id"]);

if(isset($_POST["submit"])){

  editProfile($_POST["id"],$_POST["username"],$_POST["password"],$_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["telephone"],$_FILES["profile_img"]["name"]);

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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentUser["uid"];?>">
        <input type="hidden" class="form-control" name="positions_id" value="<?php echo $currentUser["positions_id"];?>">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">ข้อมูลส่วนตัว</h4>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Username<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="username" id="username" value="<?php echo $currentUser["username"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Password<span style="color: red;"> *</span></label>
                      <input type="password" class="form-control" name="password" value="<?php echo $currentUser["password"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="firstname" value="<?php echo $currentUser["firstname"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">นามสกุล<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="lastname" value="<?php echo $currentUser["lastname"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">อีเมล<span style="color: red;"> *</span></label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $currentUser["email"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">หมายเลขโทรศัพท์<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $currentUser["telephone"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รูปประจำตัว</label>
                      <input type="file" class="form-control" name="profile_img" placeholder="รูปโปรไฟล์" >
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
              <?php if($currentUser["profile_img"] != ""){ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/user/<?php echo $currentUser["profile_img"];?>" />
              <?php }else{ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/user_ico.png" />
              <?php } ?>
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