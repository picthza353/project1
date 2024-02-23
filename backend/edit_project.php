<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 

$currentProject = getCurrentProject($_GET["id"]);
$allProjectEmployee = getAllProjectEmployee($_GET["id"]);
$allProjectPeriod = getAllProjectPeriod($_GET["id"]);
$allProvince = getAllProvince();
$allAmphurInProvince = getAllAmphurInProvince($currentProject["land_province"]);
$allDistrictInAmphur = getAllDistrictInAmphur($currentProject["land_amphur"]);
$allEmployer = getAllEmployer();
$allUserEmployee = getAllUserEmployee();
$numberProject = runNumberProject();

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    $period_number = $_POST["period_number"];
    $period_detail = $_POST["period_detail"];
    $period_price = $_POST["period_price"];
    $employee_id = $_POST["employee_id"];
    saveProject($_POST["users_id"],$_POST["run_number"],$_POST["employers_id"],$_POST["building_type"],$_POST["building_authority"],$_POST["land_deed"],$_POST["land_part"],$_POST["land_number"],$_POST["land_check"],$_POST["land_tumbol"],$_POST["land_amphur"],$_POST["land_province"],$_POST["area_amount"],$_POST["area_work"],$_POST["area_squre"],$_POST["start_date"],$_POST["end_date"],$_POST["amount_date"],$_POST["total_price"],$period_number,$period_detail,$period_price,$employee_id);
  }else{
    $period_number = $_POST["period_number"];
    $period_detail = $_POST["period_detail"];
    $period_price = $_POST["period_price"];
    $employee_id = $_POST["employee_id"];
    editProject($_POST["id"],$_POST["users_id"],$_POST["run_number"],$_POST["employers_id"],$_POST["building_type"],$_POST["building_authority"],$_POST["land_deed"],$_POST["land_part"],$_POST["land_number"],$_POST["land_check"],$_POST["land_tumbol"],$_POST["land_amphur"],$_POST["land_province"],$_POST["area_amount"],$_POST["area_work"],$_POST["area_squre"],$_POST["start_date"],$_POST["end_date"],$_POST["amount_date"],$_POST["total_price"],$period_number,$period_detail,$period_price,$employee_id);
  }
  

}

if($_GET["id"] == ""){
  $txtHead = "สร้าง งานรับเหมา";
}else{
  $txtHead = "แก้ไข งานรับเหมา";
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentProject["pid"];?>">
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo $txtHead;?></h4>
              </div>

              <div class="card-body">
                <hr/>
                <legend>ข้อมูลผู้ว่าจ้าง</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่</label>
                      <input type="text" class="form-control" name="run_number" value="<?php if($_GET['id'] == ""){ echo $numberProject;}else{echo $currentProject["run_number"];}?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ผู้ว่าจ้าง<span style="color: red;"> *</span></label>
                      <select name="employers_id" class="form-control border-input" id="employers_id" required>
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allEmployer as $dataEmp){ ?>
                          <?php $selected = "";
                          if($currentProject['employers_id'] == $dataEmp['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $dataEmp['id']?>" <?php echo $selected;?>><?php echo $dataEmp['firstname']?> <?php echo $dataEmp['lastname']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <hr/>
                <legend>พื้นที่ก่อสร้าง</legend>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">ประเภทการก่อสร้าง<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="building_type" value="<?php echo $currentProject["building_type"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">กรรมการผู้มีอำนาจ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="building_authority" value="<?php echo $currentProject["building_authority"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ที่ดินโฉนดเลขที่<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="land_deed" value="<?php echo $currentProject["land_deed"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">ระวาง<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="land_part" value="<?php echo $currentProject["land_part"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่ดิน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="land_number" value="<?php echo $currentProject["land_number"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">หน้าสำรวจ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="land_check" value="<?php echo $currentProject["land_check"];?>" required>
                    </div>
                  </div>
                </div>
                <?php if($currentProject["id"] == ""){ ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จังหวัด</label>
                      <select name="land_province" class="form-control" id="province" required>
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProvince as $dataProvince){ ?>
                          <option value="<?php echo $dataProvince['id']?>" <?php echo $selected;?>><?php echo $dataProvince['p_name_th']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">อำเภอ/เขต</label>
                      <select name="land_amphur" class="form-control" id="amphures" required></select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตำบล/แขวง</label>
                      <select name="land_tumbol" class="form-control" id="districts" required></select>
                    </div>
                  </div>
                  <?php }else{ ?>
                    <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จังหวัด</label>
                      <select name="land_province" class="form-control" id="province">
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allProvince as $data){ ?>
                          <?php $selected = "";
                          if($currentProject['land_province'] == $data['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $data['id']?>" <?php echo $selected;?>><?php echo $data['p_name_th']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">อำเภอ/เขต</label>
                      <select name="land_amphur" class="form-control" id="amphures">
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allAmphurInProvince as $data){ ?>
                          <?php $selected = "";
                          if($currentProject['land_amphur'] == $data['id']){
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
                      <label class="bmd-label-floating">ตำบล/แขวง</label>
                      <select name="land_tumbol" class="form-control" id="districts">
                        <option value="">-- โปรดเลือก --</option>
                        <?php foreach($allDistrictInAmphur as $data){ ?>
                          <?php $selected = "";
                          if($currentProject['land_tumbol'] == $data['id']){
                            $selected = " selected";

                          }
                          ?>
                          <option value="<?php echo $data['id']?>" <?php echo $selected;?>><?php echo $data['d_name_th']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">เนื้อที่(ไร่)<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="area_amount" value="<?php echo $currentProject["area_amount"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">งาน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="area_work" value="<?php echo $currentProject["area_work"];?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ตารางวา<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="area_squre" value="<?php echo $currentProject["area_squre"];?>" required>
                    </div>
                  </div>
                </div>
                <hr/>
                <legend>ระยะเวลาในการสร้าง</legend>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่เริ่มงาน<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control start_date" name="start_date" id="start_date" value="<?php echo formatDateFull($currentProject["start_date"]);?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">วันที่แล้วเสร็จ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control end_date" name="end_date" id="end_date" value="<?php echo formatDateFull($currentProject["end_date"]);?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">จำนวนวัน</label>
                      <input type="text" class="form-control" name="amount_date" id="amount_date" style="background-color: lightgray;" value="<?php echo $currentProject["amount_date"];?>" readonly>
                    </div>
                  </div>
                </div>
                <hr/>
                <legend>งบประมาณในการจ้าง</legend>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">จำนวนเงินทั้งหมด<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="total_price" value="<?php echo $currentProject["total_price"];?>" required>
                    </div>
                  </div>
                </div>
                <hr/>
                <legend>งวดการชำระ</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <fieldset>
                      <input type="button" style="float:right;margin-right:50px;" value="ลบ" class="btn btn-danger" onclick="deleteRow('dataTable')" />
                      <input type="button" style="float:right;margin-right:50px;" id="add_row" value="เพิ่ม" class="btn btn-success" onclick="addRow('dataTable')" />
                      <table class="table table-striped" id="dataTable">
                        <thead>
                          <th></th>
                          <th style="text-align:center;"><label>งวดที่</label></th>
                          <th style="text-align:left;"><label>รายละเอียด</label></th>
                          <th style="text-align:center;"><label>จำนวนเงิน</label></th>
                        </thead>
                        <tbody>
                          <?php if(empty($allProjectPeriod)){ ?>
                            <?php for($i=1;$i<=1;$i++){ ?>
                                <tr>
                                  <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                  <td style="width:10%;">
                                    <input type="text" class="form-control border-input " name="period_number[]" id="period_number<?php echo $i;?>" value="<?php echo $i?>" style="text-align:center;" readonly>
                                  </td>
                                  <td style="width:65%;">
                                    <input type="text" class="form-control border-input " name="period_detail[]" id="period_detail<?php echo $i;?>" >
                                  </td>
                                  <td style="width:20%;">
                                    <input type="text" class="form-control border-input " name="period_price[]" id="period_price<?php echo $i;?>" >
                                  </td>
                                </tr>
                            <?php } ?>
                          <?php }else{?>
                            <?php foreach($allProjectPeriod as $dataPe){ ?>

                              <tr>
                                <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                <td style="width:10%;">
                                  <input type="text" class="form-control border-input " name="period_number[]" id="period_number<?php echo $i;?>" value="<?php echo $dataPe["period_number"];?>">
                                </td>
                                <td style="width:65%;">
                                  <input type="text" class="form-control border-input " name="period_detail[]" id="period_detail<?php echo $i;?>" value="<?php echo $dataPe["period_detail"];?>">
                                </td>
                                <td style="width:20%;">
                                  <input type="text" class="form-control border-input " name="period_price[]" id="period_price<?php echo $i;?>" value="<?php echo $dataPe["period_price"];?>">
                                </td>
                              </tr>

                            <?php } ?>
                          <?php } ?>

                        </tbody>
                      </table>
                    </fieldset>
                  </div>
                </div>
                <hr/>
                <legend>พนักงาน/ลูกจ้าง</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <fieldset>
                      <input type="button" style="float:right;margin-right:50px;" value="ลบ" class="btn btn-danger" onclick="deleteRow2('dataTable2')" />
                      <input type="button" style="float:right;margin-right:50px;" id="add_row" value="เพิ่ม" class="btn btn-success" onclick="addRow2('dataTable2')" />
                      <table class="table table-striped" id="dataTable2">
                        <thead>
                          <th></th>
                          <th style="text-align:left;"><label>พนักงาน/ลูกจ้าง</label></th>
                        </thead>
                        <tbody>
                          <?php if(empty($currentProject)){ ?>
                            <?php for($i=0;$i<1;$i++){ ?>
                              <tr>
                                <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                <td style="width:95%;">
                                  <select name="employee_id[]" class="form-control" id="employee_id<?php echo $i;?>" >
                                    <option value="">-- โปรดเลือก --</option>
                                    <?php foreach($allUserEmployee as $data2){ ?>
                                      <?php $selected = "";?>
                                      <option value="<?php echo $data2['id']?>" <?php echo $selected;?>><?php echo $data2['firstname']?> <?php echo $data2['lastname']?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                              </tr>
                            <?php } ?>
                          <?php }else{?>
                            <?php foreach($allProjectEmployee as $dataEmp){ ?>

                              <tr>
                                <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                <td style="width:95%;">
                                  <select name="employee_id[]" class="form-control" id="employee_id<?php echo $i;?>" >
                                    <option value="">-- โปรดเลือก --</option>
                                    <?php foreach($allUserEmployee as $data2){ ?>
                                      <?php $selected = "";
                                      if($dataEmp['employee_id'] == $data2['id']){
                                        $selected = " selected";

                                      }
                                      ?>
                                      <option value="<?php echo $data2['id']?>" <?php echo $selected;?>><?php echo $data2['firstname']?> <?php echo $data2['lastname']?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                              </tr>

                            <?php } ?>
                          <?php } ?>

                        </tbody>
                      </table>
                    </fieldset>
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
      $('#start_date').datetimepicker({
        lang:'th',
        timepicker:false,
        format:'d/m/Y'
      });
      $('#end_date').datetimepicker({
        lang:'th',
        timepicker:false,
        format:'d/m/Y'
      });
      
      $(document).ready(function(){

        function convertDateFormat(dateString) {
            var arrDate = dateString.split("/");
            return arrDate[2] + '-' + arrDate[1] + '-' + arrDate[0];
        }

        // Function to calculate days between two dates
        function calculateDays() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            if (start_date && end_date) {
                var convert_start_date = convertDateFormat(start_date);
                var convert_end_date = convertDateFormat(end_date);

                var startDate = new Date(convert_start_date);
                var endDate = new Date(convert_end_date);

                var result = Math.floor((endDate - startDate) / (24 * 60 * 60 * 1000));

                $("#amount_date").val(result);
            } else {
                $("#amount_date").val("");
            }
        }

        // Change event for dynamic calculation
        $("#start_date, #end_date").change(function() {
            calculateDays();
        });
      });
    </script>
  <script language="javascript">

    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;

      var row = table.insertRow(rowCount);

      var cell0 = row.insertCell(0);
      var element0 = document.createElement("input");
      element0.type = "checkbox";
      element0.name="chkbox";
      cell0.appendChild(element0);

      var cell1 = row.insertCell(1);
      var element1 = document.createElement("input");
      element1.type = "text";
      element1.name = "period_number[]";
      element1.id = "period_number"+rowCount;
      element1.className = "form-control";
      element1.style.textAlign = "center";
      element1.readOnly = true;
      cell1.appendChild(element1);
      element1.value = rowCount;

      var cell2 = row.insertCell(2);
      var element2 = document.createElement("input");
      element2.type = "text";
      element2.name = "period_detail[]";
      element2.id = "period_detail"+rowCount;
      element2.className = "form-control";
      cell2.appendChild(element2);

      var cell3 = row.insertCell(3);
      var element3 = document.createElement("input");
      element3.type = "text";
      element3.name = "period_price[]";
      element3.id = "period_price"+rowCount;
      element3.className = "form-control";
      cell3.appendChild(element3);


    }

    function deleteRow(tableID) {
      try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];
          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
            table.deleteRow(i);
            rowCount--;
            i--;
          }


        }
      }catch(e) {
        //alert(e);
      }
    }
  </script>
  <script language="javascript">

        function addRow2(tableID) {

          var table = document.getElementById(tableID);

          var rowCount = table.rows.length;

          var row = table.insertRow(rowCount);

          var cell0 = row.insertCell(0);
          var element0 = document.createElement("input");
          element0.type = "checkbox";
          element0.name="chkbox";
          cell0.appendChild(element0);


          var cell1 = row.insertCell(1);
          var element1 = document.createElement("select");
          element1.id = 'employee_id'+rowCount;
          element1.name = 'employee_id[]';
          element1.setAttribute('class', 'form-control');
          cell1.appendChild(element1);
          var option = document.createElement("option");
          option.value = '';
          option.appendChild(document.createTextNode("-- โปรดเลือก --"));
          element1.appendChild(option);

          <?php foreach($allUserEmployee as $data2){ ?>
            var option = document.createElement("option");
            option.value = '<?php echo $data2["id"]?>';
            option.appendChild(document.createTextNode("<?php echo $data2['firstname']?> <?php echo $data2['lastname']?>"));
            element1.appendChild(option);
          <?php } ?>

        }



        function deleteRow2(tableID) {
          try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) {
              var row = table.rows[i];
              var chkbox = row.cells[0].childNodes[0];
              
              if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
              }
            }
          }catch(e) {
            //alert(e);
          }
        }


      </script>

<script>
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
      });
    }
});
      		});




      	});
      </script>

</body>

</html>