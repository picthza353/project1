<?php
// Set delay 1 second. 
sleep(1);

// Create connection connect to mysql database
$con = mysqli_connect("localhost","root","","project");
$con->set_charset("utf8");
// Next dropdown list.
$nextList = isset($_GET['nextList']) ? $_GET['nextList'] : '';

switch($nextList) {

  case 'amphures':
  $provinceId = isset($_GET['provinceId']) ? $_GET['provinceId'] : '';

  $result = $con->query("select * from amphures where province_id = '{$_GET["provinceId"]}'");

  $array = array();
  while($row = $result->fetch_object()){

    array_push($array, $row);
  }
  echo json_encode($array);

  break;

  case 'districts':
  $amphuresId = isset($_GET['amphuresId']) ? $_GET['amphuresId'] : '';

  $result = $con->query("select * from districts where amphure_id = '{$_GET["amphuresId"]}'");

  $array = array();
  while($row = $result->fetch_object()){

    array_push($array, $row);
  }
  echo json_encode($array);

  break;


}

?>