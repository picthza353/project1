<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentUser = getCurrentUser($_GET["users_id"]);
$allProject = getAllProject();
$allUserSchedule = getAllUserSchedule($_GET["users_id"]);
$currentUserSchedule = getCurrentUserSchedule($_GET["id"]);


if(isset($_POST["submit"])){
  editWorkSchedule($_POST["id"],$_POST["users_id"],$_POST["projects_id"],$_POST["work_start_date"],$_POST["work_start_time"],$_POST["work_end_date"],$_POST["work_end_time"]);
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentUserSchedule["sid"];?>">
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $currentUser["uid"];?>">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">ข้อมูลการทำงาน</h4>
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อ-นามสกุล</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentUser["firstname"];?> <?php echo $currentUser["lastname"];?></label>
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
                      <label class="bmd-label-floating"><?php echo $currentUser["email"];?></label>
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
                      <label class="bmd-label-floating"><?php echo $currentUser["telephone"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตำแหน่ง</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentUser["pos_name"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">เงินที่ได้รับ</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo number_format($currentUser["salary"]);?> บาท</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">สถานที่ทำงาน</label>
                      <select name="projects_id" class="form-control border-input" id="projects_id">
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProject as $dataPro){ ?>
                          <?php $selected = "";
                          if($currentUserSchedule['projects_id'] == $dataPro['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $dataPro['id']?>" <?php echo $selected;?>><?php echo $dataPro['building_type']?> <?php echo $dataPro['land_tumbol']?> <?php echo $dataPro['land_amphur']?> <?php echo $dataPro['land_province']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่เข้างาน</label>
                      <input type="text" class="form-control" name="work_start_date" id="work_start_date" value="<?php echo formatDateFull($currentUserSchedule["work_start_date"]);?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เวลาเข้างาน</label>
                      <input type="text" class="form-control" name="work_start_time" id="work_start_time" value="<?php echo substr($currentUserSchedule["work_start_time"], 0,5);?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่ออกงาน</label>
                      <input type="text" class="form-control" name="work_end_date" id="work_end_date" value="<?php echo formatDateFull($currentUserSchedule["work_end_date"]);?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เวลาออกงาน</label>
                      <input type="text" class="form-control" name="work_end_time" id="work_end_time" value="<?php echo substr($currentUserSchedule["work_end_time"],0,5);?>" required>
                    </div>
                  </div>
                </div>


                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="บันทึกเข้า-ออกงาน">
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
      <script>
        var today = new Date();

        $('#work_start_date').datetimepicker({
          lang:'th',
          minDate:today,
          timepicker:false,
          format:'d/m/Y'
        });
        $('#work_start_time').datetimepicker({
          lang:'th',
          datepicker:false,
          format:'H:i',
          enabledHours: '10'
        });
        $('#work_end_date').datetimepicker({
          lang:'th',
          minDate:today,
          timepicker:false,
          format:'d/m/Y'
        });
        $('#work_end_time').datetimepicker({
          lang:'th',
          datepicker:false,
          format:'H:i',
          enabledHours: '10'
        });
      </script>
    </div>
  </main>


</body>

</html>