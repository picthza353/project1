<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentPosition = getCurrentPosition($_GET["id"]);

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    savePosition($_POST["pos_name"]);
  }else{
    editPosition($_POST["id"],$_POST["pos_name"]);
  }

}

if($_GET["id"] == ""){
  $txtHead = "เพิ่ม ตำแหน่ง";
}else{
  $txtHead = "แก้ไข ตำแหน่ง";
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentPosition["id"];?>">

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
                      <label class="bmd-label-floating">ชื่อตำแหน่ง<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="pos_name" value="<?php echo $currentPosition["pos_name"];?>" required>
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
              <img class="img-fluid shadow border-radius-xl" src="images/user_ico.png" />
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