<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentProject = getCurrentProject($_GET["projects_id"]);

if(isset($_POST["submit"])){
  $period_image = $_FILES['period_image']['name'];
  $total = count($_FILES['period_image']['name']);
  uploadImagePeriod($_POST["period_id"],$_POST["projects_id"],$period_image,$total);
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
        <input type="hidden" class="form-control" name="period_id" value="<?php echo $_GET["id"];?>">
        <input type="hidden" class="form-control" name="projects_id" value="<?php echo $_GET["projects_id"];?>">
        <div class="row">
          
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">อัพโหลดภาพความคืบหน้า</h4>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentProject["run_number"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ประเภทการก่อสร้าง</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentProject["building_type"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ผู้ว่าจ้าง</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentProject["firstname"];?> <?php echo $currentProject["lastname"];?></label>
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
                      <label class="bmd-label-floating"><?php echo $currentProject["company_name"];?></label>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">อัพโหลดภาพ</label>
                      <input type="file" class="form-control" name="period_image[]" placeholder="อัพโหลดภาพ" required multiple>
                    </div>
                  </div>
                </div>

                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="อัพโหลด">
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

  <script>

    $('#ie_date').datetimepicker({
      lang:'th',
      timepicker:false,
      format:'d/m/Y'
    });
    $('#ie_time').datetimepicker({
      lang:'th',
      datepicker:false,
      format:'H:i',
      enabledHours: '10'
    });
  </script>


</body>

</html>