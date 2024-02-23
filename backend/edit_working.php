<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentWork = getCurrentWork($_GET["id"]);

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    $work_gallery = $_FILES['work_gallery']['name'];
    $total = count($_FILES['work_gallery']['name']);
    saveWork($_POST["users_id"],$_POST["work_name"],$_POST["locations"],$_POST["work_detail"],$_FILES["work_img"]["name"],$work_gallery,$total);

  }else{
    $work_gallery = $_FILES['work_gallery']['name'];
    $total = count($_FILES['work_gallery']['name']);
    editWork($_POST["id"],$_POST["users_id"],$_POST["work_name"],$_POST["locations"],$_POST["work_detail"],$_FILES["work_img"]["name"],$work_gallery,$total);
  }
}

if($_GET["id"] == ""){
  $txtHead = "เพิ่ม ผลงาน";
}else{
  $txtHead = "แก้ไข ผลงาน";
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentWork["id"];?>">
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo $txtHead;?></h4>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อผลงาน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="work_name" value="<?php echo $currentWork["work_name"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">สถานที่<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="locations" value="<?php echo $currentWork["locations"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รายละเอียด</label>
                      <textarea class="form-control" name="work_detail" ><?php echo $currentWork["work_detail"];?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รูปหน้าปก</label>
                      <input type="file" class="form-control" name="work_img" placeholder="รูปหน้าปก" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รูปการทำงาน (เลือกได้มากกว่า 1 รูป)</label>
                      <input type="file" class="form-control" name="work_gallery[]" multiple placeholder="รูปการทำงาน" >
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
            <div class="card card-profile" style="align-items:center;">
              <?php if($currentWork["work_img"] != ""){ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/work/<?php echo $currentWork["work_img"];?>" />
              <?php }else{ ?>
                <img style="width: 300px;" class="img-fluid shadow border-radius-xl" src="images/picture_icon.png" />
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