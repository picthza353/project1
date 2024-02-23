<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentUser = getCurrentUser($_GET["id"]);
$allProject = getAllProject();
$allUserSchedule = getAllUserSchedule($_GET["id"]);

if(isset($_POST["search"])){
  $allUserSchedule = getSearchAllSchedule($_POST["users_id"],$_POST["month"],$_POST["years"]);
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
      <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ตารางการทำงาน</h4>
            </div>
            <div class="card-body">
              <form name="prduct_detail_form" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="users_id" value="<?php echo $currentUser["uid"];?>">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="bmd-label-floating">เดือน</label>
                      <select name="month" class="form-control">
                        <option value="1">มกราคม</option>
                        <option value="2">กุมภาพันธ์</option>
                        <option value="3">มีนาคม</option>
                        <option value="4">เมษายน</option>
                        <option value="5">พฤษภาคม</option>
                        <option value="6">มิถุนายน</option>
                        <option value="7">กรกฎาคม</option>
                        <option value="8">สิงหาคม</option>
                        <option value="9">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="bmd-label-floating">ปี</label>
                      <input type="text" class="form-control" name="years" required>
                    </div>
                  </div>
                  <div class="col-md-2" >
                    <div class="form-group" style="text-align: center;">
                      <br/>
                      <input type="submit" name="search" class="btn btn-success btn-round" value="ค้นหา">
                    </div>
                  </div>
                </div>
              </form>
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th style="text-align:left;"><label>สถานที่ทำงาน</label></th>
                  <th style="text-align:center;"><label>วันทีเข้างาน</label></th>
                  <th style="text-align:center;"><label>เวลาที่เข้างาน</label></th>
                  <th style="text-align:center;"><label>วันทีออกงาน</label></th>
                  <th style="text-align:center;"><label>เวลาที่ออกงาน</label></th>
                </thead>
                <tbody>
                  <?php if(empty($allUserSchedule)){ ?>
                  <?php }else{?>
                    <?php foreach($allUserSchedule as $dataSc){ ?>

                      <tr>
                        <td style="width:50%;text-align:left;">
                          <label class="bmd-label-floating"><?php echo $dataSc["building_type"];?> <?php echo $dataSc["land_tumbol"];?> <?php echo $dataSc["land_amphur"];?> <?php echo $dataSc["land_province"];?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo formatDateFull($dataSc["work_start_date"]);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo substr($dataSc["work_start_time"],0,5);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo formatDateFull($dataSc["work_end_date"]);?></label>
                        </td>
                        <td style="width:10%;text-align:center;">
                          <label class="bmd-label-floating"><?php echo substr($dataSc["work_end_time"],0,5);?></label>
                        </td>

                      </tr>

                    <?php } ?>
                  <?php } ?>

                </tbody>
              </table>


            </div>
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
    </script>
  </div>
</main>


</body>

</html>