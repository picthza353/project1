<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
?>
<?php 
$currentOrders = getCurrentOrders($_GET["id"]);
$allOrdersDetail = getAllOrdersDetail($_GET["id"]);
$allProjectNotSuccess = getAllProjectNotSuccess();
$numberOrderEquipment = runNumberOrderEquipment();

if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    $equipment_name = $_POST["equipment_name"];
    $equipment_amount = $_POST["equipment_amount"];
    $equipment_unit = $_POST["equipment_unit"];
    $equipment_price = $_POST["equipment_price"];
    saveOrder($_POST["users_id"],$_POST["order_number"],$_POST["projects_id"],$_POST["store_name"],$_FILES["order_bill"]["name"],$equipment_name,$equipment_amount,$equipment_unit,$equipment_price);
  }else{
    $equipment_name = $_POST["equipment_name"];
    $equipment_amount = $_POST["equipment_amount"];
    $equipment_unit = $_POST["equipment_unit"];
    $equipment_price = $_POST["equipment_price"];
    editOrder($_POST["id"],$_POST["users_id"],$_POST["order_number"],$_POST["projects_id"],$_POST["store_name"],$_FILES["order_bill"]["name"],$equipment_name,$equipment_amount,$equipment_unit,$equipment_price);
  }
  

}

if($_GET["id"] == ""){
  $txtHead = "สร้าง การสั่งซื้อ";
}else{
  $txtHead = "แก้ไข แก้ไข";
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
        <input type="hidden" class="form-control" name="id" value="<?php echo $currentOrders["ooid"];?>">
        <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo $txtHead;?></h4>
              </div>

              <div class="card-body">
                <hr/>
                <legend>ข้อมูลการสั่งซื้อ</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่</label>
                      <input type="text" class="form-control" name="order_number" value="<?php if($_GET['id'] == ""){ echo $numberOrderEquipment;}else{echo $currentOrders["order_number"];}?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
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
                      <label class="bmd-label-floating">ร้านที่สั่งซื้อ<span style="color: red;"> *</span></label>
                      <input type="text" class="form-control" name="store_name" value="<?php echo $currentOrders["store_name"];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">แนบไฟล์ใบสั่งซื้อ<span style="color: red;"> *</span></label>
                      <input type="file" class="form-control" name="order_bill" placeholder="แนบไฟล์ใบสั่งซื้อ" >
                    </div>
                  </div>
                </div>
                
                <hr/>
                <legend>ข้อมูลอุปกรณ์</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <fieldset>
                      <input type="button" style="float:right;margin-right:50px;" value="ลบ" class="btn btn-danger" onclick="deleteRow('dataTable')" />
                      <input type="button" style="float:right;margin-right:50px;" id="add_row" value="เพิ่ม" class="btn btn-success" onclick="addRow('dataTable')" />
                      <table class="table table-striped" id="dataTable">
                        <thead>
                          <th></th>
                          <th style="text-align:center;"><label>อุปกรณ์/วัสดุที่สั่งซื้อ</label></th>
                          <th style="text-align:center;"><label>จำนวน</label></th>
                          <th style="text-align:center;"><label>หน่วย</label></th>
                          <th style="text-align:center;"><label>ราคา:หน่วย</label></th>
                        </thead>
                        <tbody>
                          <?php if(empty($allOrdersDetail)){ ?>
                            <?php for($i=0;$i<1;$i++){ ?>
                              <tr>
                                <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                <td style="width:55%;">
                                  <input type="text" class="form-control border-input " name="equipment_name[]" id="equipment_name<?php echo $i;?>" >
                                </td>
                                <td style="width:10%;">
                                  <input type="text" class="form-control border-input " name="equipment_amount[]" id="equipment_amount<?php echo $i;?>" >
                                </td>
                                <td style="width:10%;">
                                  <input type="text" class="form-control border-input " name="equipment_unit[]" id="equipment_unit<?php echo $i;?>" >
                                </td>
                                <td style="width:20%;">
                                  <input type="text" class="form-control border-input " name="equipment_price[]" id="equipment_unit<?php echo $i;?>" >
                                </td>
                              </tr>
                            <?php } ?>
                          <?php }else{?>
                            <?php foreach($allOrdersDetail as $dataDet){ ?>

                              <tr>
                                <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                                <td style="width:55%;">
                                  <input type="text" class="form-control border-input " name="equipment_name[]" id="equipment_name<?php echo $i;?>" value="<?php echo $dataDet["equipment_name"];?>">
                                </td>
                                <td style="width:10%;">
                                  <input type="text" class="form-control border-input " name="equipment_amount[]" id="equipment_amount<?php echo $i;?>" value="<?php echo $dataDet["equipment_amount"];?>">
                                </td>
                                <td style="width:10%;">
                                  <input type="text" class="form-control border-input " name="equipment_unit[]" id="equipment_unit<?php echo $i;?>" value="<?php echo $dataDet["equipment_unit"];?>">
                                </td>
                                <td style="width:20%;">
                                  <input type="text" class="form-control border-input " name="equipment_price[]" id="equipment_price<?php echo $i;?>" value="<?php echo $dataDet["equipment_price"];?>">
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
      element1.name = "equipment_name[]";
      element1.id = "equipment_name"+rowCount;
      element1.className = "form-control";
      cell1.appendChild(element1);

      var cell2 = row.insertCell(2);
      var element2 = document.createElement("input");
      element2.type = "text";
      element2.name = "equipment_amount[]";
      element2.id = "equipment_amount"+rowCount;
      element2.className = "form-control";
      cell2.appendChild(element2);
      
      var cell3 = row.insertCell(3);
      var element3 = document.createElement("input");
      element3.type = "text";
      element3.name = "equipment_unit[]";
      element3.id = "equipment_unit"+rowCount;
      element3.className = "form-control";
      cell3.appendChild(element3);

      var cell4 = row.insertCell(4);
      var element4 = document.createElement("input");
      element4.type = "text";
      element4.name = "equipment_price[]";
      element4.id = "equipment_price"+rowCount;
      element4.className = "form-control";
      cell4.appendChild(element4);

      


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
        alert(e);
      }
    }
  </script>
  

</body>

</html>