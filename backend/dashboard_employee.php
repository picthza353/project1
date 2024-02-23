<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<?php 

$currentUser = getCurrentUser($_SESSION["id"]);
$allUserSchedule = getAllUserSchedule($_SESSION["id"]);

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
              <h4 class="card-title">หน้าหลัก</h4>
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
                    <label class="bmd-label-floating">ตำแหน่ง</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentUser["pos_name"];?> </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เงินเดือน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo number_format($currentUser["salary"]);?> บาท</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ประเภทผู้ใช้งาน</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $role_map[$currentUser["role"]];?> </label>
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