<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php

$currentTax = getCurrentTax($_GET["id"]);
$allProvince = getAllProvince();
$allAmphurInProvince = getAllAmphurInProvince($currentTax["res_province"]);
$allDistrictInAmphur = getAllDistrictInAmphur($currentTax["res_district"]);

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    saveTax($_POST["res_id"],$_POST["res_name"],$_POST["res_address"],$_POST["res_alley"],$_POST["res_road"],$_POST["res_province"],$_POST["res_district"],$_POST["res_subdistrict"],$_POST["res_zipcode"],$_POST["tax_date"],$_POST["tax_amount"],$_POST["tax_deduct"],$_FILES["tax_img"]["name"]);
  }else{
    editTax($_POST["id"],$_POST["res_id"],$_POST["res_name"],$_POST["res_address"],$_POST["res_alley"],$_POST["res_road"],$_POST["res_province"],$_POST["res_district"],$_POST["res_subdistrict"],$_POST["res_zipcode"],$_POST["tax_date"],$_POST["tax_amount"],$_POST["tax_deduct"],$_FILES["tax_img"]["name"]);
  }
}

if($_GET["id"] == ""){
  $txtHead = "สร้าง ใบกำกับภาษี";
}else{
  $txtHead = "แก้ไข ใบกำกับภาษี";
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentTax["id"];?>">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo $txtHead;?></h4>
              </div>

              <div class="card-body">
                <hr/>
                <legend>ผู้มีหน้าที่หักภาษี ณ ที่จ่าย</legend>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขประจำตัวผู้เสียภาษีอากร<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="res_id" value="<?php echo $currentTax["res_id"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ชื่อ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="res_name" value="<?php echo $currentTax["res_name"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ที่อยู่<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="res_address" value="<?php echo $currentTax["res_address"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตรอก/ซอย</label>
                      <input type="text" class="form-control" name="res_alley" value="<?php echo $currentTax["res_alley"];?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ถนน</label>
                      <input type="text" class="form-control" name="res_road" value="<?php echo $currentTax["res_road"];?>">
                    </div>
                    </div>
                  <?php if($currentTax["id"] == ""){ ?>                        
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จังหวัด<span style="color: red;"> *</span></label>
                      <select name="res_province" class="form-control" id="province" required>
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProvince as $dataProvince){ ?>
                          <option value="<?php echo $dataProvince['id']?>" <?php echo $selected;?>><?php echo $dataProvince['p_name_th']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">อำเภอ/เขต<span style="color: red;"> *</span></label>
                      <select name="res_district" class="form-control" id="amphures" required></select>   
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตำบล/แขวง<span style="color: red;"> *</span></label>
                      <select name="res_subdistrict" class="form-control" id="districts" required></select>      
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">รหัสไปรษณีย์<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="res_zipcode" id="zipcode" value="<?php echo $currentTax["res_zipcode"];?>" readonly>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จังหวัด<span style="color: red;"> *</span></label>
                      <select name="res_province" class="form-control" id="province">
                        <option value="">-- โปรดเลือก --</option>
                          <?php foreach($allProvince as $data){ ?>
                            <?php $selected = "";
                              if($currentTax['res_province'] == $data['id']){
                                $selected = " selected";
                              }
                            ?>
                          <option value="<?php echo $data['id']?>" <?php echo $selected;?>><?php echo $data['p_name_th']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">อำเภอ/เขต<span style="color: red;"> *</span></label>
                      <select name="res_district" class="form-control" id="amphures">
                      <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allAmphurInProvince as $data){ ?>
                          <?php $selected = "";
                          if($currentTax['res_district'] == $data['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $data['id']?>" <?php echo $selected;?>><?php echo $data['a_name_th']?></option>
                        <?php } ?>
                      </select>   
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตำบล/แขวง<span style="color: red;"> *</span></label>
                      <select name="res_subdistrict" class="form-control" id="districts">
                        <option value="">-- โปรดเลือก --</option>
                          <?php foreach($allDistrictInAmphur as $data){ ?>
                            <?php $selected = "";
                            if($currentTax['res_subdistrict'] == $data['id']){
                              $selected = " selected";

                            }
                            ?>
                          <option value="<?php echo $data['id']?>" <?php echo $selected;?>><?php echo $data['d_name_th']?></option>
                        <?php } ?>
                      </select>      
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">รหัสไปรษณีย์<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="res_zipcode" id="zipcode" value="<?php echo $currentTax["res_zipcode"];?>" readonly>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">วัน เดือน หรือปีภาษี ที่จ่าย<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="tax_date" id="tax_date" value="<?php echo formatDateFull($currentTax["tax_date"]);?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จำนวนเงินที่จ่าย<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="tax_amount" value="<?php echo $currentTax["tax_amount"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ภาษีที่หัก และนำส่งไว้<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="tax_deduct" value="<?php echo $currentTax["tax_deduct"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ไฟล์เอกสาร<span style="color: red;"> *</span></label>
                      <input type="file" class="form-control" name="tax_img" placeholder="ไฟล์เอกสาร">
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
        </div>
      </form>
      <?php
      require_once("footer.php");
      ?>
    </div>
  </main>
  <script>
    $('#tax_date').datetimepicker({
        lang:'th',
        timepicker:false,
        format:'d/m/Y'
      });

      	$(function(){
      		var defaultOption = '<option value=""> ------- เลือก ------ </option>';
      		$('#province').change(function() {
      			$("#amphures").html(defaultOption);
      			$.ajax({
      // A string containing the URL to which the request is sent.
      url: "json_filter/jsonAction.php",
      // Data to be sent to the server.
      data: ({ nextList : 'amphures', provinceId: $('#province').val() }),
      // The type of data that you're expecting back from the server.
      dataType: "json",
      beforeSend: function() {
      },
      // success is called if the request succeeds.
      success: function(json){
        // Iterate over a jQuery object, executing a function for each matched element.
        $.each(json, function(index, value) {
          // Insert content, specified by the parameter, to the end of each element
          // in the set of matched elements.
          $("#amphures").append('<option value="' + value.id + '">' + value.a_name_th + '</option>');
      });
    }
});
      		});

      		$('#amphures').change(function() {
      			$("#districts").html(defaultOption);
      			$.ajax({
      // A string containing the URL to which the request is sent.
      url: "json_filter/jsonAction.php",
      // Data to be sent to the server.
      data: ({ nextList : 'districts', amphuresId: $('#amphures').val() }),
      // The type of data that you're expecting back from the server.
      dataType: "json",
      beforeSend: function() {
      },
      // success is called if the request succeeds.
      success: function(json){
        // Iterate over a jQuery object, executing a function for each matched element.
        $.each(json, function(index, value) {
          // Insert content, specified by the parameter, to the end of each element
          // in the set of matched elements.
          $("#districts").append('<option value="' + value.id + '">' + value.d_name_th + '</option>');
          $("#zipcode").val(value.zip_code);
      });
    }
});
      		});




      	});
      </script>
</body>

</html>