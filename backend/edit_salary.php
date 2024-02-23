<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentUser = getCurrentUser($_GET["id"]);
$allProjectNotSuccess = getAllProjectNotSuccess();

if(isset($_POST["submit"])){
  saveSalary($_POST["users_id"],$_POST["projects_id"],$_POST["salary_detail"],$_POST["salary_date"],$_POST["salary_time"],$_POST["salary_amount"],$_POST["salary_risk"]);
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
                      <label class="bmd-label-floating">งานรับเหมา<span style="color: red;"> *</span></label>
                      <select name="projects_id" class="form-control border-input" id="projects_id" required>
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProjectNotSuccess as $dataPro){ ?>
                          <?php $selected = "";
                          if($currentOrders['projects_id'] == $dataPro['id']){
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
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">รายละเอียด<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="salary_detail" id="salary_detail" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่<span style="color: red;"> *</span></label>
                      <?php 
                        $yThai = date("Y")+543;
                        $dateNow = date("d/m/").$yThai;
                      ?>
                      <input type="text" class="form-control" name="salary_date" id="withdraw_date" value="<?php echo $dateNow?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เวลา<span style="color: red;"> *</span></label>
                      <?php  
                        $time = date("H:i");
                      ?>
                      <input type="text" class="form-control" name="salary_time" id="withdraw_time" value="<?php echo $time?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">จำนวนเงิน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="salary_amount" value="400" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ค่าเสี่ยงภัย</label>
                      <input type="text" class="form-control" name="salary_risk">
                    </div>
                  </div>
                </div>
                <div align="center">
                  <input type="submit" name="submit" class="btn btn-success btn-round" value="บันทึกการเบิก">
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
        $('#withdraw_date').datetimepicker({
          lang:'th',
          timepicker:false,
          format:'d/m/Y'
        });
        $('#withdraw_time').datetimepicker({
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