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
$currentProvince = getCurrentProvince($currentOrders['land_province']);
$currentAmphure = getCurrentAmphure($currentOrders['land_amphur']);
$currentDistrict = getCurrentDistrict($currentOrders['land_tumbol']);

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
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">รายละเอียดการสั่งซื้อ</h4>
              </div>

              <div class="card-body">
                <hr/>
                <legend>ข้อมูลการสั่งซื้อ</legend>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">เลขที่</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentOrders["order_number"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">งานรับเหมา</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentOrders['building_type']?> <?php echo $currentDistrict['d_name_th']?> <?php echo $currentAmphure['a_name_th']?> <?php echo $currentProvince['p_name_th']?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">ร้านที่สั่งซื้อ</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentOrders["store_name"];?></label>
                    </div>
                  </div>
                </div>
                
                <!-- <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">หมายเลขโทรศัพท์</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating"><?php echo $currentOrders["store_location"];?></label>
                    </div>
                  </div>
                </div> -->
                
                
                <hr/>
                <legend>ข้อมูลอุปกรณ์</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <fieldset>
                      
                      <table class="table table-striped" id="dataTable">
                        <thead>
                          <th style="text-align:left;"><label>อุปกรณ์/วัสดุที่สั่งซื้อ</label></th>
                          <th style="text-align:center;"><label>จำนวน</label></th>
                          <th style="text-align:center;"><label>หน่วย</label></th>
                          <th style="text-align:center;"><label>ราคา:หน่วย</label></th>
                          <th style="text-align:center;"><label>รวม</label></th>
                        </thead>
                        <tbody>
                          <?php if(empty($allOrdersDetail)){ ?>
                          <?php }else{?>
                            <?php $total = 0;?>
                            <?php foreach($allOrdersDetail as $dataDet){ ?>
                              <?php $total += $dataDet["equipment_price"] * $dataDet["equipment_amount"];?>
                              <tr>
                                <td style="width:40%;">
                                  <label class="bmd-label-floating"><?php echo $dataDet["equipment_name"];?></label>
                                </td>
                                <td style="width:10%;text-align:center;">
                                  <label class="bmd-label-floating"><?php echo $dataDet["equipment_amount"];?></label>
                                </td>
                                <td style="width:10%;text-align:center;">
                                  <label class="bmd-label-floating"><?php echo $dataDet["equipment_unit"];?></label>
                                </td>
                                <td style="width:20%;text-align:center;">
                                  <label class="bmd-label-floating"><?php echo number_format($dataDet["equipment_price"]);?> บาท</label>
                                </td>
                                <td style="width:20%;text-align:center;">
                                  <label class="bmd-label-floating"><?php echo number_format($dataDet["equipment_price"] * $dataDet["equipment_amount"]);?> บาท</label>
                                </td>
                              </tr>

                            <?php } ?>
                          <?php } ?>
                          <tr>
                            <td colspan="4" style="text-align:right;color:red;">รวม</td>
                            <td style="text-align:center;color:red;"><?php echo number_format($total);?> บาท</td>
                          </tr>


                        </tbody>
                      </table>
                    </fieldset>
                  </div>
                </div>

                <div align="center">
                  <input type="button" name="button" class="btn btn-danger btn-round" onClick="javascript:history.go(-1)" value="ย้อนกลับ">

                </div>
                <div class="clearfix"></div>

              </div>
            </div>
          </div>
          <div class="col-md-4">

            <div class="card card-profile">
              <?php if($currentOrders["order_bill"] != ""){ ?>
                <img class="img-fluid shadow border-radius-xl" src="images/order_bill/<?php echo $currentOrders["order_bill"];?>" />
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
    </div>
  </main>

  
  

</body>

</html>