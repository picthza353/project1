<?php

$con = mysqli_connect("localhost","root","","project");
$con->set_charset("utf8");

if($_REQUEST["load"]=="user"){
	
	$result = $con->query("select * from users");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="employer"){
	
	$result = $con->query("select * from employers");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}


?>



