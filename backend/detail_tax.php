<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentTax = getCurrentTax($_GET["id"]);
$currentProvince = getCurrentProvince($currentTax['res_province']);
$currentAmphure = getCurrentAmphure($currentTax['res_district']);
$currentDistrict = getCurrentDistrict($currentTax['res_subdistrict']);
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
              <h4 class="card-title">ข้อมูลใบกำกับภาษี</h4>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <h3 class="mb-0 text-sm">ผู้มีหน้าที่หักภาษี ณ ที่จ่าย</้>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">เลขประจำตัวผู้เสียภาษีอากร</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentTax["res_id"];?> <?php echo $currentProject["lastname"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ชื่อ</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentTax["res_name"];?></label>
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
                    <label class="bmd-label-floating"><?php echo $currentTax["res_address"]?> <?php echo $currentTax["res_alley"]?> <?php echo $currentTax["res_road"]?> ตำบล<?php echo $currentDistrict['d_name_th'];?> อำเภอ<?php echo $currentAmphure['a_name_th'];?> จังหวัด<?php echo $currentProvince['p_name_th'];?> <?php echo $currentTax["res_zipcode"];?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">วัน เดือน หรือปีภาษี ที่จ่าย</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo formatDateFull($currentTax["tax_date"])?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">จำนวนเงินที่จ่าย</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentTax["tax_amount"]?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ภาษีที่หัก และนำส่งไว้</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating"><?php echo $currentTax["tax_deduct"]?></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">ไฟล์เอกสาร</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <a href="images/tax/<?php echo $currentTax["tax_img"];?>" download class="btn btn-info text-sm">ดาวน์โหลดรูปเอกสาร</a>
                  </div>
                </div>
              </div>
              <hr/>
              <div align="center">
                  <input type="button" name="button" class="btn btn-danger btn-round" onClick="javascript:history.go(-1)" value="ย้อนกลับ">
                </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card card-profile">
              <img class="img-fluid shadow border-radius-xl" src="images/tax/<?php echo $currentTax["tax_img"];?>" />
          </div>
        </div>
      </div>
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