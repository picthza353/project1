<?php
error_reporting(0);

//เชื่อต่อ Database
$con = mysqli_connect("localhost","kztmrmbxtp","8W9u7xQsby","kztmrmbxtp");
$con->set_charset("utf8");

date_default_timezone_set("Asia/Bangkok");

function checkLogin($username,$password){
	$data = array();
	global $con;
	$res = mysqli_query($con,"select * from users where username = '".$username."' and password='".$password."' ");
	
	while($row = mysqli_fetch_array($res)) {
		$data['id'] = $row['id'];
		$data['role'] = $row['role'];
	}
	if (!empty($data)) {
		session_start();
		$id = $data['id'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['role'] = $data['role'];
		if($data['role'] == 1){
			echo ("<script language='JavaScript'>
				window.location.href='dashboard.php';
				</script>");
		}else{
			echo ("<script language='JavaScript'>
				window.location.href='dashboard_employee.php';
				</script>");
		}
		
	}else{
		echo ("<script>
				$(document).ready(function() {
					Swal.fire({
						icon: 'error',
						title: 'ไม่สามารถเข้าสู่ระบบได้',
						text: 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
						confirmButtonText: 'ตกลง'
					});
				});
			</script>");
	}
	
	mysqli_close($con);

}

function checkLoginEmployer($username,$password){
	$data = array();
	global $con;
	$res = mysqli_query($con,"select * from employers where username = '".$username."' and password='".$password."' ");
	
	while($row = mysqli_fetch_array($res)) {
		$data['id'] = $row['id'];
	}
	if (!empty($data)) {
		session_start();
		$id = $data['id'];
		$_SESSION['id'] = $data['id'];

		echo ("<script language='JavaScript'>
				window.location.href='index.php';
				</script>");
		
		
	}else{
		echo ("<script>
				$(document).ready(function() {
					Swal.fire({
						icon: 'error',
						title: 'ไม่สามารถเข้าสู่ระบบได้',
						text: 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
						confirmButtonText: 'ตกลง'
					});
				});
			</script>");
		header("refresh:1; url=login.php");
	}
	mysqli_close($con);

}

function formatDateFull($date){
	if($date=="0000-00-00"){
		return "";
	}
	if($date=="")
		return $date;
	$raw_date = explode("-", $date);
	return  $raw_date[2] . "/" . $raw_date[1] . "/" . $raw_date[0];
}

function logout(){
	session_start();
	session_unset();
	session_destroy();
	echo ("<script language='JavaScript'>
		window.location.href='index.php';
		</script>");
	exit();
}

function savePosition($pos_name){
	
	global $con;

	$sql = "INSERT INTO positions (pos_name) VALUES('".$pos_name."')";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'สำเร็จ',
					text: 'เพิ่มข้อมูลเรียบร้อย',
					showConfirmButton: false
				});
			});
			</script>");
	header("refresh:1; url=manage_position.php");
	
}

function editPosition($id,$pos_name){
	
	global $con;

	$sql="UPDATE positions SET pos_name='".$pos_name."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=manage_position.php"); 
	
}

function deletePosition($id){
	global $con;

	mysqli_query($con,"DELETE FROM positions WHERE id='".$id."'");
	mysqli_close($con);

}

function getAllPosition(){
	global $con;

	$sql = "SELECT * FROM positions ORDER BY id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'pos_name' => $row['pos_name']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentPosition($id){

	global $con;

	$sql = "SELECT * FROM positions WHERE id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function saveUser($username,$password,$firstname,$lastname,$email,$telephone,$positions_id,$salary_type,$salary,$role,$profile_img,$gender,$ability){
	
	global $con;

	if($profile_img != null ){
		if(move_uploaded_file($_FILES["profile_img"]["tmp_name"],"images/user/".$_FILES["profile_img"]["name"]))
		{
			$sql = "INSERT INTO users (username, password, firstname, lastname, email, telephone, positions_id, salary_type, salary, role, profile_img, gender, ability) VALUES('".$username."','".$password."','".$firstname."','".$lastname."','".$email."','".$telephone."','".$positions_id."','".$salary_type."','".$salary."','".$role."','".$_FILES["profile_img"]["name"]."','".$gender."','".$ability."')";
		}
	}else{
		$sql = "INSERT INTO users (username, password, firstname, lastname, email, telephone, positions_id, salary_type, salary, role, gender, ability) VALUES('".$username."','".$password."','".$firstname."','".$lastname."','".$email."','".$telephone."','".$positions_id."','".$salary_type."','".$salary."','".$role."','".$gender."','".$ability."')";
	}
	mysqli_query($con,$sql);
	mysqli_close($con);

	// echo ("<script language='JavaScript'>
	// 	window.location.href='manage_user.php';
	// 	</script>"); 
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'เพิ่มข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_user.php"); 
	
}

function editUser($id,$username,$password,$firstname,$lastname,$email,$telephone,$positions_id,$salary_type,$salary,$role,$profile_img,$gender,$ability){
	
	global $con;

	if($profile_img != null ){
		if(move_uploaded_file($_FILES["profile_img"]["tmp_name"],"images/user/".$_FILES["profile_img"]["name"]))
		{
			$sql="UPDATE users SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',email='".$email."',telephone='".$telephone."',positions_id='".$positions_id."',salary_type='".$salary_type."',salary='".$salary."',role='".$role."',profile_img='".$_FILES["profile_img"]["name"]."',gender='".$gender."',ability='".$ability."' WHERE id = '".$id."'";
		}
	}else{
		$sql="UPDATE users SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',email='".$email."',telephone='".$telephone."',positions_id='".$positions_id."',salary_type='".$salary_type."',salary='".$salary."',role='".$role."',gender='".$gender."',ability='".$ability."' WHERE id = '".$id."'";
	}
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'สำเร็จ',
					text: 'แก้ไขข้อมูลเรียบร้อย',
					showConfirmButton: false
				});
			});
			</script>");
	header("refresh:1; url=manage_user.php");  
	
}

function editProfile($id,$username,$password,$firstname,$lastname,$email,$telephone,$profile_img){
	
	global $con;

	if($profile_img != null ){
		if(move_uploaded_file($_FILES["profile_img"]["tmp_name"],"images/user/".$_FILES["profile_img"]["name"]))
		{
			$sql="UPDATE users SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',email='".$email."',telephone='".$telephone."',profile_img='".$_FILES["profile_img"]["name"]."' WHERE id = '".$id."'";
		}
	}else{
		$sql="UPDATE users SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',email='".$email."',telephone='".$telephone."' WHERE id = '".$id."'";

	}
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=profile.php");  
	
}

function deleteUser($id){
	global $con;

	mysqli_query($con,"DELETE FROM users WHERE id='".$id."'");
	mysqli_query($con,"DELETE FROM salaries WHERE users_id='".$users_id."'");
	mysqli_close($con);

}

function getAllUser(){
	global $con;

	$sql = "SELECT *,u.id as uid FROM users u LEFT JOIN positions p ON u.positions_id = p.id ORDER BY u.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['uid'],
			'username' => $row['username'],
			'password' => $row['password'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'positions_id' => $row['positions_id'],
			'pos_name' => $row['pos_name'],
			'salary' => $row['salary'],
			'role' => $row['role'],
			'profile_img' => $row['profile_img']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllUserEmployee(){
	global $con;

	$sql = "SELECT *,u.id as uid FROM users u LEFT JOIN positions p ON u.positions_id = p.id WHERE u.role = '2' ORDER BY u.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['uid'],
			'username' => $row['username'],
			'password' => $row['password'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'positions_id' => $row['positions_id'],
			'pos_name' => $row['pos_name'],
			'salary' => $row['salary'],
			'role' => $row['role'],
			'profile_img' => $row['profile_img']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentUser($id){

	global $con;

	$sql = "SELECT *,u.id as uid FROM users u LEFT JOIN positions p ON u.positions_id = p.id WHERE u.id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function saveEmployer($username,$password,$firstname,$lastname,$address,$email,$telephone,$company_name,$juristic_person,$company_address){
	
	global $con;

	$sql = "INSERT INTO employers (username, password, firstname, lastname, address, email, telephone, company_name, juristic_person, company_address) VALUES('".$username."','".$password."','".$firstname."','".$lastname."','".$address."','".$email."','".$telephone."','".$company_name."','".$juristic_person."','".$company_address."')";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'เพิ่มข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_employer.php");
	
}

function editEmployer($id,$username,$password,$firstname,$lastname,$address,$email,$telephone,$company_name,$juristic_person,$company_address){
	
	global $con;

	$sql="UPDATE employers SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',address='".$address."',email='".$email."',telephone='".$telephone."',company_name='".$company_name."',juristic_person='".$juristic_person."',company_address='".$company_address."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_employer.php");
	
}

function editProfileEmployer($id,$username,$password,$firstname,$lastname,$address,$email,$telephone,$facebook_name,$line_id,$company_name,$juristic_person,$company_address){
	
	global $con;

	$sql="UPDATE employers SET username='".$username."',password='".$password."',firstname='".$firstname."',lastname='".$lastname."',address='".$address."',email='".$email."',telephone='".$telephone."',facebook_name='".$facebook_name."',line_id='".$line_id."',company_name='".$company_name."',juristic_person='".$juristic_person."',company_address='".$company_address."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=profile.php");
	
}

function deleteEmployer($id){
	global $con;

	mysqli_query($con,"DELETE FROM employers WHERE id='".$id."'");
	mysqli_close($con);

}

function getAllEmployer(){
	global $con;

	$sql = "SELECT * FROM employers ORDER BY id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'username' => $row['username'],
			'password' => $row['password'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'email' => $row['email'],
			'company_name' => $row['company_name'],
			'juristic_person' => $row['juristic_person'],
			'company_address' => $row['company_address'],
			'telephone' => $row['telephone'],
			'facebook_name' => $row['facebook_name'],
			'line_id' => $row['line_id']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentEmployer($id){

	global $con;

	$sql = "SELECT * FROM employers WHERE id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function runNumberProject(){
	global $con;

	$res = mysqli_query($con,"SELECT MAX(run_number) as mid FROM projects");
	$data = array();
	while($row = mysqli_fetch_array($res)) {
		$data['mid'] = $row['mid'];
	}
	$run = intval($data['mid']);
	$run = $run+1;

	if($run=="")
		$run=1;
	$number_order = sprintf('%05d', $run);

	return $number_order;
	mysqli_close($con);
}

function saveProject($users_id,$run_number,$employers_id,$building_type,$building_authority,$land_deed,$land_part,$land_number,$land_check,$land_tumbol,$land_amphur,$land_province,$area_amount,$area_work,$area_squre,$start_date,$end_date,$amount_date,$total_price,$period_number,$period_detail,$period_price,$employee_id){

	global $con;

	$arrDate1 = explode("/", $start_date);
	$convert_start_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];
	$arrDate2 = explode("/", $end_date);
	$convert_end_date = $arrDate2[2].'-'.$arrDate2[1].'-'.$arrDate2[0];

	$sql = "INSERT INTO projects (users_id, run_number, employers_id, building_type, building_authority, land_deed, land_part, land_number, land_check, land_tumbol, land_amphur, land_province, area_amount, area_work, area_squre, start_date, end_date, amount_date, total_price) VALUES('".$users_id."','".$run_number."','".$employers_id."','".$building_type."','".$building_authority."','".$land_deed."','".$land_part."','".$land_number."','".$land_check."','".$land_tumbol."','".$land_amphur."','".$land_province."','".$area_amount."','".$area_work."','".$area_squre."','".$convert_start_date."','".$convert_end_date."','".$amount_date."','".$total_price."')";

	mysqli_query($con,$sql);
	$last_id = $con->insert_id;
	foreach( $period_number as $key => $pn ) {
		if ($pn != "") {
			$pd = $period_detail[$key];
			$pp = $period_price[$key];
			$sql_detail = "INSERT INTO projects_period (projects_id, period_number, period_detail, period_price, peiod_status) VALUES ('".$last_id."','".$pn."','".$pd."','".$pp."','1')";
			mysqli_query($con,$sql_detail);
		}
	}

	foreach( $employee_id as $key => $empi ) {
		if ($empi != "") {
			$sql_detail_emp = "INSERT INTO projects_employee (projects_id,employee_id) VALUES ('".$id."','".$empi."')";
			mysqli_query($con,$sql_detail_emp);
		}
	}

	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'เพิ่มข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_project.php");

}

function editProject($id,$users_id,$run_number,$employers_id,$building_type,$building_authority,$land_deed,$land_part,$land_number,$land_check,$land_tumbol,$land_amphur,$land_province,$area_amount,$area_work,$area_squre,$start_date,$end_date,$amount_date,$total_price,$period_number,$period_detail,$period_price,$employee_id){

	global $con;
	$arrDate1 = explode("/", $start_date);
	$convert_start_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];
	$arrDate2 = explode("/", $end_date);
	$convert_end_date = $arrDate2[2].'-'.$arrDate2[1].'-'.$arrDate2[0];

	$sql = "UPDATE projects SET users_id='".$users_id."',run_number='".$run_number."',employers_id='".$employers_id."',building_type='".$building_type."',building_authority='".$building_authority."',land_deed='".$land_deed."',land_part='".$land_part."',land_number='".$land_number."',land_check='".$land_check."',land_tumbol='".$land_tumbol."',land_amphur='".$land_amphur."',land_province='".$land_province."',area_amount='".$area_amount."',area_work='".$area_work."',area_squre='".$area_squre."',start_date='".$convert_start_date."',end_date='".$convert_end_date."',amount_date='".$amount_date."',total_price='".$total_price."' WHERE id = '".$id."'";


	mysqli_query($con,$sql);

	mysqli_query($con,"DELETE FROM projects_period WHERE projects_id='".$id."'");
	mysqli_query($con,"DELETE FROM projects_employee WHERE projects_id='".$id."'");
	foreach( $period_number as $key => $pn ) {
		if ($pn != "") {
			$pd = $period_detail[$key];
			$pp = $period_price[$key];
			$sql_detail = "INSERT INTO projects_period (projects_id, period_number, period_detail, period_price, peiod_status) VALUES ('".$id."','".$pn."','".$pd."','".$pp."','1')";
			mysqli_query($con,$sql_detail);
		}
	}

	foreach( $employee_id as $key => $empi ) {
		if ($empi != "") {
			$sql_detail_emp = "INSERT INTO projects_employee (projects_id,employee_id) VALUES ('".$id."','".$empi."')";
			mysqli_query($con,$sql_detail_emp);
		}
	}

	mysqli_close($con);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_project.php"); 
	
}

function deleteProject($id){
	global $con;

	mysqli_query($con,"DELETE FROM projects WHERE id='".$id."'");
	mysqli_query($con,"DELETE FROM projects_period WHERE projects_id='".$id."'");
	mysqli_query($con,"DELETE FROM projects_employee WHERE projects_id='".$id."'");
	mysqli_query($con,"DELETE FROM income_expense WHERE projects_id='".$id."'");
	mysqli_close($con);

}

function getAllProject(){
	global $con;

	$sql = "SELECT *,p.id as pid FROM projects p 
	LEFT JOIN employers e ON p.employers_id = e.id
	LEFT JOIN provinces pr ON p.land_province = pr.id
    LEFT JOIN amphures a ON p.land_amphur = a.id
    LEFT JOIN districts d ON p.land_tumbol = d.id
	ORDER BY p.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'users_id' => $row['users_id'],
			'run_number' => $row['run_number'],
			'employers_id' => $row['employers_id'],
			'building_type' => $row['building_type'],
			'land_deed' => $row['land_deed'],
			'land_part' => $row['land_part'],
			'land_number' => $row['land_number'],
			'land_check' => $row['land_check'],
			'land_tumbol' => $row['d_name_th'],
			'land_amphur' => $row['a_name_th'],
			'land_province' => $row['p_name_th'],
			'area_amount' => $row['area_amount'],
			'area_work' => $row['area_work'],
			'area_squre' => $row['area_squre'],
			'start_date' => $row['start_date'],
			'end_date' => $row['end_date'],
			'amount_date' => $row['amount_date'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'company_name' => $row['company_name'],
			'juristic_person' => $row['juristic_person'],
			'company_address' => $row['company_address'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'total_price' => $row['total_price']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllProjectNotSuccess(){
	global $con;

	$sql = "SELECT *,p.id as pid FROM projects p 
	LEFT JOIN employers e ON p.employers_id = e.id
	LEFT JOIN provinces pr ON p.land_province = pr.id
    LEFT JOIN amphures a ON p.land_amphur = a.id
    LEFT JOIN districts d ON p.land_tumbol = d.id  
	WHERE p.project_status = '0' 
	ORDER BY p.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'users_id' => $row['users_id'],
			'run_number' => $row['run_number'],
			'employers_id' => $row['employers_id'],
			'building_type' => $row['building_type'],
			'land_deed' => $row['land_deed'],
			'land_part' => $row['land_part'],
			'land_number' => $row['land_number'],
			'land_check' => $row['land_check'],
			'land_tumbol' => $row['d_name_th'],
			'land_amphur' => $row['a_name_th'],
			'land_province' => $row['p_name_th'],
			'area_amount' => $row['area_amount'],
			'area_work' => $row['area_work'],
			'area_squre' => $row['area_squre'],
			'start_date' => $row['start_date'],
			'end_date' => $row['end_date'],
			'amount_date' => $row['amount_date'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'company_name' => $row['company_name'],
			'juristic_person' => $row['juristic_person'],
			'company_address' => $row['company_address'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'total_price' => $row['total_price']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentProjectNotSuccess($id){

	global $con;

	$sql = "SELECT *,p.id as pid FROM projects p LEFT JOIN employers e ON p.employers_id = e.id WHERE p.project_status = '0' ORDER BY p.id DESC";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getAllProjectEmployee($projects_id){
	global $con;

	$sql = "SELECT *,pe.id as peid 
	FROM projects_employee pe 
	LEFT JOIN users u ON pe.employee_id = u.id 
	LEFT JOIN positions p ON u.positions_id = p.id
	WHERE pe.projects_id = '".$projects_id."'
	ORDER BY pe.id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['peid'],
			'projects_id' => $row['projects_id'],
			'employee_id' => $row['employee_id'],
			'username' => $row['username'],
			'password' => $row['password'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'positions_id' => $row['positions_id'],
			'salary' => $row['salary'],
			'role' => $row['role'],
			'profile_img' => $row['profile_img'],
			'pos_name' => $row['pos_name']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllProjectPeriod($projects_id){
	global $con;

	$sql = "SELECT * FROM projects_period WHERE projects_id = '".$projects_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'projects_id' => $row['projects_id'],
			'period_number' => $row['period_number'],
			'period_detail' => $row['period_detail'],
			'period_price' => $row['period_price'],
			'period_image' => $row['period_image'],
			'peiod_status' => $row['peiod_status']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentProject($id){

	global $con;

	$sql = "SELECT *,p.id as pid FROM projects p LEFT JOIN employers e ON p.employers_id = e.id WHERE p.id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCalculatePercentProject($projects_id){

	global $con;

	$sql_count = "SELECT COUNT(*) as numCount FROM projects_period WHERE projects_id = '".$projects_id."'";
	$resCount = mysqli_query($con,$sql_count);
	$resultCount = mysqli_fetch_array($resCount,MYSQLI_ASSOC);

	$sqlSuccess = "SELECT COUNT(*) as numSuccess FROM projects_period WHERE projects_id = '".$projects_id."' AND peiod_status = '2' ";
	$resSuccess = mysqli_query($con,$sqlSuccess);
	$resultSuccess = mysqli_fetch_array($resSuccess,MYSQLI_ASSOC);

	$currPercent = 100 / $resultCount["numCount"] ;
	$progressWork = $currPercent * $resultSuccess["numSuccess"];

	return $progressWork;

	mysqli_close($con);

}

function updateComplete($id,$projects_id){
	
	global $con;

	$sql="UPDATE projects_period SET peiod_status='2' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);

}

function updateSuccessJob($id,$projects_id){
	
	global $con;

	$sql="UPDATE projects_period SET peiod_status='2' WHERE id = '".$id."'";

	mysqli_query($con,$sql);

	$res = mysqli_query($con,"select COUNT(*) as numCount from projects_period where projects_id = '".$projects_id."' AND peiod_status = '1' ");
	
	while($row = mysqli_fetch_array($res)) {
		$data['numCount'] = $row['numCount'];
	}
	if ($data['numCount'] == 0) {
		$sqlStat="UPDATE projects_period SET project_status='1' WHERE id = '".$projects_id."'";
		mysqli_query($con,$sqlStat);
	}

	mysqli_close($con);
	echo ("<script language='JavaScript'>
		window.location.href='update_progress.php?id=$projects_id';
		</script>"); 
	
}

function getAllDataProgressChart($projects_id){
	global $con;

	$sql_count = "SELECT COUNT(*) as numCount FROM projects_period WHERE projects_id = '".$projects_id."'";
	$resCount = mysqli_query($con,$sql_count);
	$resultCount = mysqli_fetch_array($resCount,MYSQLI_ASSOC);

	$sqlSuccess = "SELECT COUNT(*) as numSuccess FROM projects_period WHERE projects_id = '".$projects_id."' AND peiod_status = '2' ";
	$resSuccess = mysqli_query($con,$sqlSuccess);
	$resultSuccess = mysqli_fetch_array($resSuccess,MYSQLI_ASSOC);

	$currPercent = 100 / $resultCount["numCount"] ;
	$progressWork = $currPercent * $resultSuccess["numSuccess"];
	$err = 100 - $progressWork;
	$jsonArray = array();

	//$arrData["data"] = array();
	array_push($jsonArray, array('y' => $progressWork,'label' => "ชำระแล้ว"));
	array_push($jsonArray, array('y' => $err,'label' => "ค้างชำระ"));
	


	return $jsonArray;

	mysqli_close($con);


}

function saveStartWork($users_id,$projects_id,$work_start_date,$work_start_time){
	
	global $con;

	$arrDate1 = explode("/", $work_start_date);
	$convert_start_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];

	$sql = "INSERT INTO schedules (users_id, projects_id, work_start_date, work_start_time) VALUES('".$users_id."','".$projects_id."','".$convert_start_date."','".$work_start_time."')";
	
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'เพิ่มข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=edit_schedule.php?id=$users_id");
	
}

function saveEndWork($id,$users_id){
	
	global $con;

	$yThai = date("Y")+543;
	$dateNow = $yThai.date("-m-d");
	$timeNow = date("H:i");

	$sql="UPDATE schedules SET work_end_date='".$dateNow."',work_end_time='".$timeNow."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);

}

function deleteScheduleWork($id,$users_id){
	global $con;
	mysqli_query($con,"DELETE FROM schedules WHERE id='".$id."'");
	mysqli_close($con);

}

function editWorkSchedule($id,$users_id,$projects_id,$work_start_date,$work_start_time,$work_end_date,$work_end_time){
	
	global $con;

	$arrDate1 = explode("/", $work_start_date);
	$convert_start_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];
	$arrDate2 = explode("/", $work_end_date);
	$convert_end_date = $arrDate2[2].'-'.$arrDate2[1].'-'.$arrDate2[0];

	$sql="UPDATE schedules SET projects_id='".$projects_id."',work_start_date='".$convert_start_date."',work_start_time='".$work_start_time."',work_end_date='".$convert_end_date."',work_end_time='".$work_end_time."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=edit_schedule.php?id=$users_id");
	
}

function getAllUserSchedule($users_id){
	global $con;

	$sql = "SELECT *,s.id as sid FROM schedules s 
	LEFT JOIN projects p ON s.projects_id = p.id
	LEFT JOIN provinces pr ON p.land_province = pr.id
    LEFT JOIN amphures a ON p.land_amphur = a.id
    LEFT JOIN districts d ON p.land_tumbol = d.id 
	WHERE s.users_id = '".$users_id."' 
	ORDER BY s.work_start_date DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sid'],
			'users_id' => $row['users_id'],
			'projects_id' => $row['projects_id'],
			'building_type' => $row['building_type'],
			'land_tumbol' => $row['d_name_th'],
			'land_amphur' => $row['a_name_th'],
			'land_province' => $row['p_name_th'],
			'work_start_date' => $row['work_start_date'],
			'work_start_time' => $row['work_start_time'],
			'work_end_date' => $row['work_end_date'],
			'work_end_time' => $row['work_end_time']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getSearchAllSchedule($users_id,$month,$years){
	global $con;

	$sql = "SELECT *,s.id as sid FROM schedules s LEFT JOIN projects p ON s.projects_id = p.id WHERE s.users_id = '".$users_id."' AND MONTH(s.work_start_date) = '".$month."' AND YEAR(s.work_start_date) = '".$years."'  ORDER BY s.work_start_date DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sid'],
			'users_id' => $row['users_id'],
			'projects_id' => $row['projects_id'],
			'building_type' => $row['building_type'],
			'land_tumbol' => $row['land_tumbol'],
			'land_amphur' => $row['land_amphur'],
			'land_province' => $row['land_province'],
			'work_start_date' => $row['work_start_date'],
			'work_start_time' => $row['work_start_time'],
			'work_end_date' => $row['work_end_date'],
			'work_end_time' => $row['work_end_time']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentUserSchedule($id){

	global $con;

	$sql = "SELECT *,s.id as sid FROM schedules s LEFT JOIN projects p ON s.projects_id = p.id WHERE s.id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function saveIncomeExpense($projects_id,$ie_category,$ie_detail,$ie_date,$ie_time,$ie_type,$ie_amount){
	
	global $con;

	$arrDate1 = explode("/", $ie_date);
	$convert_ie_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];

	$sql = "INSERT INTO income_expense (projects_id, ie_category, ie_detail, ie_date, ie_time, ie_type, ie_amount) VALUES('".$projects_id."','".$ie_category."','".$ie_detail."','".$convert_ie_date."','".$ie_time."','".$ie_type."','".$ie_amount."')";
	
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'บันทึกข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_income_expense.php");
	
}

function getAllIncomeExpenseProject($projects_id){
	global $con;

	$sql = "SELECT * FROM income_expense WHERE projects_id = '".$projects_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'peoject_id' => $row['peoject_id'],
			'ie_category' => $row['ie_category'],
			'ie_detail' => $row['ie_detail'],
			'ie_date' => $row['ie_date'],
			'ie_time' => $row['ie_time'],
			'ie_type' => $row['ie_type'],
			'ie_amount' => $row['ie_amount']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllExpenseProject($projects_id){
	global $con;

	$sql = "SELECT * FROM income_expense WHERE projects_id = '".$projects_id."' AND ie_category = '2' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'peoject_id' => $row['peoject_id'],
			'ie_category' => $row['ie_category'],
			'ie_detail' => $row['ie_detail'],
			'ie_date' => $row['ie_date'],
			'ie_time' => $row['ie_time'],
			'ie_type' => $row['ie_type'],
			'ie_amount' => $row['ie_amount']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function runNumberOrderEquipment(){
	global $con;

	$res = mysqli_query($con,"SELECT MAX(order_number) as mid FROM orders");
	$data = array();
	while($row = mysqli_fetch_array($res)) {
		$data['mid'] = $row['mid'];
	}
	$run = intval($data['mid']);
	$run = $run+1;

	if($run=="")
		$run=1;
	$number_order = sprintf('%05d', $run);

	return $number_order;
	mysqli_close($con);
}

function saveOrder($users_id,$order_number,$projects_id,$store_name,$order_bill,$equipment_name,$equipment_amount,$equipment_unit,$equipment_price){

	global $con;

	$yThai = date("Y")+543;
	$dateNow = $yThai.date("-m-d");
	if(move_uploaded_file($_FILES["order_bill"]["tmp_name"],"images/order_bill/".$_FILES["order_bill"]["name"]))
	{
		$sql = "INSERT INTO orders (users_id, order_number, projects_id, store_name, order_bill, date_create) VALUES('".$users_id."','".$order_number."','".$projects_id."','".$store_name."','".$_FILES["order_bill"]["name"]."','".$dateNow."')";
	}
	

	mysqli_query($con,$sql);
	$last_id = $con->insert_id;
	foreach( $equipment_name as $key => $en ) {
		if ($en != "") {
			$ea = $equipment_amount[$key];
			$eu = $equipment_unit[$key];
			$ep = $equipment_price[$key];
			$sql_detail = "INSERT INTO orders_detail (orders_id, equipment_name, equipment_amount, equipment_unit, equipment_price) VALUES ('".$last_id."','".$en."','".$ea."','".$eu."','".$ep."')";
			mysqli_query($con,$sql_detail);
		}
	}

	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'เพิ่มข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_order_equipment.php");

}

function editOrder($id,$users_id,$order_number,$projects_id,$store_name,$order_bill,$equipment_name,$equipment_amount,$equipment_unit,$equipment_price){

	global $con;

	if($order_bill != null){
		if(move_uploaded_file($_FILES["order_bill"]["tmp_name"],"images/order_bill/".$_FILES["order_bill"]["name"]))
		{
			$sql = "UPDATE orders SET users_id='".$users_id."',order_number='".$order_number."',projects_id='".$projects_id."',store_name='".$store_name."',order_bill='".$_FILES["order_bill"]["name"]."' WHERE id = '".$id."'";
			mysqli_query($con,$sql);
		}
	}else{
		$sql = "UPDATE orders SET users_id='".$users_id."',order_number='".$order_number."',projects_id='".$projects_id."',store_name='".$store_name."' WHERE id = '".$id."'";
		mysqli_query($con,$sql);
	}

	mysqli_query($con,"DELETE FROM orders_detail WHERE orders_id='".$id."'");

	foreach( $equipment_name as $key => $en ) {
		if ($en != "") {
			$ea = $equipment_amount[$key];
			$eu = $equipment_unit[$key];
			$ep = $equipment_price[$key];
			$sql_detail = "INSERT INTO orders_detail (orders_id, equipment_name, equipment_amount,equipment_unit,equipment_price) VALUES ('".$id."','".$en."','".$ea."','".$eu."','".$ep."')";
			mysqli_query($con,$sql_detail);
		}
	}

	mysqli_close($con);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_order_equipment.php");
	
}

function deleteOrder($id){
	global $con;

	mysqli_query($con,"DELETE FROM orders WHERE id='".$id."'");
	mysqli_query($con,"DELETE FROM orders_detail WHERE orders_id='".$id."'");
	mysqli_close($con);
	echo ("<script language='JavaScript'>
		window.location.href='manage_order_equipment.php';
		</script>"); 

}

function getAllOrders(){
	global $con;

	$sql = "SELECT *, o.id as ooid 
	FROM orders o 
	LEFT JOIN projects p ON o.projects_id = p.id
	LEFT JOIN provinces pr ON p.land_province = pr.id
    LEFT JOIN amphures a ON p.land_amphur = a.id
    LEFT JOIN districts d ON p.land_tumbol = d.id
	ORDER BY o.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['ooid'],
			'users_id' => $row['users_id'],
			'order_number' => $row['order_number'],
			'projects_id' => $row['projects_id'],
			'store_name' => $row['store_name'],
			'store_location' => $row['store_location'],
			'store_phone' => $row['store_phone'],
			'run_number' => $row['run_number'],
			'building_type' => $row['building_type'],
			'land_tumbol' => $row['d_name_th'],
			'land_amphur' => $row['a_name_th'],
			'land_province' => $row['p_name_th'],
			'date_create' => $row['date_create'],
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllOrdersDetail($orders_id){
	global $con;

	$sql = "SELECT * FROM orders_detail WHERE orders_id = '".$orders_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'orders_id' => $row['orders_id'],
			'equipment_name' => $row['equipment_name'],
			'equipment_amount' => $row['equipment_amount'],
			'equipment_price' => $row['equipment_price'],
			'equipment_unit' => $row['equipment_unit']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentOrders($id){

	global $con;

	$sql = "SELECT *, o.id as ooid 
	FROM orders o 
	LEFT JOIN projects p ON o.projects_id = p.id
	WHERE o.id = '".$id."' 
	ORDER BY o.id DESC";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function saveSalary($users_id,$projects_id,$salary_detail,$salary_date,$salary_time,$salary_amount,$salary_risk){
	
	global $con;

	$arrDate1 = explode("/", $salary_date);
	$convert_salary_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];
	if($salary_risk == ""){
		$salary_risk = 0;
		$rem = $salary_amount + $salary_risk;
	}else{
		$rem = $salary_amount + $salary_risk;
	}

	$sql = "INSERT INTO salaries (users_id, projects_id, salary_detail, salary_date, salary_time, salary_amount, salary_risk, salary_remaining) VALUES('".$users_id."','".$projects_id."','".$salary_detail."','".$convert_salary_date."','".$salary_time."','".$salary_amount."','".$salary_risk."','".$rem."')";
	
	mysqli_query($con,$sql);

	$res = mysqli_query($con,"select * from salaries where users_id = '".$users_id."'");
	$totalSalary = 0;
	while($row = mysqli_fetch_array($res)) {
		$totalSalary += $row['salary_remaining'];
	}

	$sqlWage = "UPDATE users SET wage='".$totalSalary."' WHERE id = '".$users_id."'";

	mysqli_query($con,$sqlWage);

	mysqli_close($con);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'บันทึกข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_salary.php");
	
}

function getCurrentSalaryDateUser($users_id){

	global $con;

	$yThai = date("Y")+543;
	$dateNow = $yThai.date("-m-d");
	$sql = "SELECT * FROM salaries WHERE users_id = '".$users_id."' AND DATE(salary_date) = '".$dateNow."'";

	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCurrentSalaryWeekUser($users_id){

	global $con;

	$month = date("m");
	$sql = "SELECT * FROM salaries WHERE users_id = '".$users_id."' AND MONTH(salary_date) = '".$month."'";

	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getAllDataDashboardChart(){
	global $con;

	$sql = "SELECT * FROM projects ORDER BY id DESC ";

	$res = mysqli_query($con,$sql);

	$jsonArray = array();

	//$arrData["data"] = array();

	while($row = mysqli_fetch_array($res)) {
		array_push($jsonArray, array('y' => $row['total_price'], 'label' => $row['building_type']));
	}


	return $jsonArray;

	mysqli_close($con);


}

function getAllDataDashboardIncomeExpenseChart(){
	global $con;

	$sql = "SELECT SUM(ie_amount) as sumAmount,ie_category FROM income_expense GROUP BY ie_category ORDER BY id DESC ";

	$res = mysqli_query($con,$sql);

	$jsonArray = array();

	//$arrData["data"] = array();

	while($row = mysqli_fetch_array($res)) {
		if($row['ie_category'] == 1){
			array_push($jsonArray, array('y' => $row['sumAmount'], 'label' => "รายรับ"));
		}else{
			array_push($jsonArray, array('y' => $row['sumAmount'], 'label' => "รายจ่าย"));
		}
		
	}


	return $jsonArray;

	mysqli_close($con);


}

function getAllWorkEmployeeProject($users_id){
	global $con;

	$sql = "SELECT *,p.id as pid 
	FROM projects_employee e  
	LEFT JOIN projects p ON e.projects_id = p.id 
	WHERE p.project_status = '0' AND e.employee_id = '".$users_id."'
	ORDER BY p.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'users_id' => $row['users_id'],
			'run_number' => $row['run_number'],
			'employers_id' => $row['employers_id'],
			'building_type' => $row['building_type'],
			'land_deed' => $row['land_deed'],
			'land_part' => $row['land_part'],
			'land_number' => $row['land_number'],
			'land_check' => $row['land_check'],
			'land_tumbol' => $row['land_tumbol'],
			'land_amphur' => $row['land_amphur'],
			'land_province' => $row['land_province'],
			'area_amount' => $row['area_amount'],
			'area_work' => $row['area_work'],
			'area_squre' => $row['area_squre'],
			'start_date' => $row['start_date'],
			'end_date' => $row['end_date'],
			'amount_date' => $row['amount_date'],
			'total_price' => $row['total_price']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function editSalaryTypeEmployee($id,$salary_type){
	
	global $con;

	$sql="UPDATE users SET salary_type='".$salary_type."' WHERE id = '".$id."'";

	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script language='JavaScript'>
		window.location.href='employee_salary.php';
		</script>"); 
	
}

function saveWork($users_id,$work_name,$locations,$work_detail,$work_img,$work_gallery,$total){

	global $con;

	if($work_img != null){
		if(move_uploaded_file($_FILES["work_img"]["tmp_name"],"images/work/".$_FILES["work_img"]["name"]))
		{

			$sql = "INSERT INTO works (users_id, work_name, locations, work_detail, work_img) VALUES('".$users_id."','".$work_name."','".$locations."','".$work_detail."','".$_FILES["work_img"]["name"]."')";
			mysqli_query($con,$sql);
			$last_id = $con->insert_id;

		}
	}else{
		$sql = "INSERT INTO works (users_id, work_name, locations, work_detail) VALUES('".$users_id."','".$work_name."','".$locations."','".$work_detail."')";
		mysqli_query($con,$sql);
		$last_id = $con->insert_id;
	}



	for( $i=0 ; $i < $total ; $i++ ) {

		$tmpFilePath = $_FILES['work_gallery']['tmp_name'][$i];

		if ($tmpFilePath != ""){

			$newFilePath = "images/gallery_work/" . $_FILES['work_gallery']['name'][$i];

			if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				$sql_detail = "INSERT INTO works_gallery (works_id, images) VALUES ('".$last_id."','".$_FILES['work_gallery']['name'][$i]."')";
				mysqli_query($con,$sql_detail);

			}
		}
	}

	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'บันทึกข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_working.php");

}

function editWork($id,$users_id,$work_name,$locations,$work_detail,$work_img,$work_gallery,$total){

	global $con;

	if($work_img != null){
		if(move_uploaded_file($_FILES["work_img"]["tmp_name"],"images/work/".$_FILES["work_img"]["name"]))
		{
			$sql="UPDATE works SET users_id='".$users_id."',work_name='".$work_name."',locations='".$locations."',work_detail='".$work_detail."',work_img='".$_FILES["work_img"]["name"]."' WHERE id = '".$id."'";
		}
	}else{
		$sql="UPDATE works SET users_id='".$users_id."',work_name='".$work_name."',locations='".$locations."',work_detail='".$work_detail."' WHERE id = '".$id."'";
	}

	mysqli_query($con,$sql);
	if($total > 1){
		mysqli_query($con,"DELETE FROM work_gallery WHERE works_id = '".$id."'");
		for( $i=0 ; $i < $total ; $i++ ) {
			$tmpFilePath = $_FILES['work_gallery']['tmp_name'][$i];
			if ($tmpFilePath != ""){
				$newFilePath = "images/gallery_work/" . $_FILES['work_gallery']['name'][$i];
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					$sql_detail = "INSERT INTO works_gallery (works_id, images) VALUES ('".$id."','".$_FILES['work_gallery']['name'][$i]."')";
					mysqli_query($con,$sql_detail);

				}
			}
		}
	}

	mysqli_close($con);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_working.php");

}

function deleteWork($id){
	global $con;
	mysqli_query($con,"DELETE FROM works WHERE id='".$id."'");
	mysqli_query($con,"DELETE FROM works_gallery WHERE works_id='".$id."'");
	mysqli_close($con);
	echo ("<script language='JavaScript'>
		window.location.href='manage_working.php';
		</script>"); 
}

function getAllWork(){
	global $con;

	$sql = "SELECT * FROM works ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'work_name' => $row['work_name'],
			'locations' => $row['locations'],
			'work_detail' => $row['work_detail'],
			'work_img' => $row['work_img']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllWorkGallery($works_id){
	global $con;

	$sql = "SELECT * FROM works_gallery WHERE works_id = '".$works_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'works_id' => $row['works_id'],
			'images' => $row['images']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentWork($id){

	global $con;

	$sql = "SELECT * FROM works WHERE id = '".$id."' ";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getAllProgressProject($users_id){
	global $con;

	$sql = "SELECT *,p.id as pid FROM projects p LEFT JOIN employers e ON p.employers_id = e.id WHERE e.id = '".$users_id."' ORDER BY p.id DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'users_id' => $row['users_id'],
			'run_number' => $row['run_number'],
			'employers_id' => $row['employers_id'],
			'building_type' => $row['building_type'],
			'land_deed' => $row['land_deed'],
			'land_part' => $row['land_part'],
			'land_number' => $row['land_number'],
			'land_check' => $row['land_check'],
			'land_tumbol' => $row['land_tumbol'],
			'land_amphur' => $row['land_amphur'],
			'land_province' => $row['land_province'],
			'area_amount' => $row['area_amount'],
			'area_work' => $row['area_work'],
			'area_squre' => $row['area_squre'],
			'start_date' => $row['start_date'],
			'end_date' => $row['end_date'],
			'amount_date' => $row['amount_date'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'company_name' => $row['company_name'],
			'juristic_person' => $row['juristic_person'],
			'company_address' => $row['company_address'],
			'email' => $row['email'],
			'telephone' => $row['telephone'],
			'total_price' => $row['total_price']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}


function uploadImagePeriod($period_id,$projects_id,$period_image,$total){
	
	global $con;

	$yThai = date("Y")+543;
	$dateNow = $yThai.date("-m-d");
	for( $i=0 ; $i < $total ; $i++ ) {

		$tmpFilePath = $_FILES['period_image']['tmp_name'][$i];

		if ($tmpFilePath != ""){

			$newFilePath = "images/period_gallery/" . $_FILES['period_image']['name'][$i];

			if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				$sql_gal = "INSERT INTO period_gallery (period_id, projects_id, images, date_update) VALUES ('".$period_id."','".$projects_id."','".$_FILES['period_image']['name'][$i]."','".$dateNow."')";
				mysqli_query($con,$sql_gal);
				echo ("<script>
					$(document).ready(function() {
						Swal.fire({
							icon: 'success',
							title: 'สำเร็จ',
							text: 'อัพโหลดรูปภาพเรียบร้อย',
							showConfirmButton: false
						});
					});
					</script>"); 
				header("refresh:1; url=update_progress.php?id=$projects_id");
			}
		}
	}
	mysqli_close($con);
	
}

function getCheckPeriodImage($period_id){

	global $con;

	$sql = "SELECT COUNT(*) as numImg FROM period_gallery WHERE period_id = '".$period_id."' ";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getAllImageInProgressDate($projects_id,$period_id){
	global $con;

	$sql = "SELECT * FROM period_gallery WHERE period_id = '".$period_id."' AND projects_id = '".$projects_id."' GROUP BY date_update ORDER BY date_update DESC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'date_update' => $row['date_update'],
			'images' => $row['images']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllImageInProgress($projects_id,$period_id){
	global $con;

	$sql = "SELECT * FROM period_gallery WHERE period_id = '".$period_id."' AND projects_id = '".$projects_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'period_id' => $row['period_id'],
			'projects_id' => $row['projects_id'],
			'date_update' => $row['date_update'],
			'images' => $row['images']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllImageInProgressCurrDate($projects_id,$period_id,$date_update){
	global $con;

	$sql = "SELECT * FROM period_gallery WHERE period_id = '".$period_id."' AND projects_id = '".$projects_id."' AND DATE(date_update) = '".$date_update."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'period_id' => $row['period_id'],
			'projects_id' => $row['projects_id'],
			'date_update' => $row['date_update'],
			'images' => $row['images']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentImageInProgress($id){
	global $con;

	$sql = "SELECT * FROM period_gallery WHERE period_id = '".$period_id."' AND projects_id = '".$projects_id."' ORDER BY id ASC";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCheckStatusNumber($employers_id){

	global $con;

	$sql = "SELECT COUNT(p.id) as numAlert FROM projects p LEFT JOIN period_gallery pg ON p.id = pg.projects_id WHERE p.employers_id = '".$employers_id."' AND pg.check_status = '0' GROUP BY p.id ";
	$res = mysqli_query($con,$sql);
	$numCount = 0;
	while($row = mysqli_fetch_array($res)) {
		$numCount++;
	}
	return $numCount;

	mysqli_close($con);

}

function updateCheckStatus($projects_id,$period_id){

	global $con;

	$sql = "UPDATE period_gallery SET check_status='1' WHERE projects_id = '".$projects_id."' AND period_id = '".$period_id."'";
	
	mysqli_query($con,$sql);

	mysqli_close($con);
	
}

function getAllProvince(){
	global $con;

	$res = mysqli_query($con,"SELECT * FROM provinces ORDER BY p_name_th ASC");

	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'code' => $row['code'],
			'p_name_th' => $row['p_name_th'],
			'name_en' => $row['name_en'],
			'geography_id' => $row['geography_id']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllAmphurInProvince($province_id){
	global $con;

	$res = mysqli_query($con,"SELECT * FROM amphures WHERE province_id = '".$province_id."' ORDER BY a_name_th ASC");

	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'code' => $row['code'],
			'a_name_th' => $row['a_name_th'],
			'a_name_en' => $row['a_name_en'],
			'province_id' => $row['province_id']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getAllDistrictInAmphur($amphure_id){
	global $con;

	$res = mysqli_query($con,"SELECT * FROM districts WHERE amphure_id = '".$amphure_id."' ORDER BY d_name_th ASC");

	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'zip_code' => $row['zip_code'],
			'd_name_th' => $row['d_name_th'],
			'd_name_en' => $row['d_name_en'],
			'amphure_id' => $row['amphure_id']);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function getCurrentProvince($id){

	global $con;

	$sql = "SELECT * FROM provinces WHERE id = '".$id."' ";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCurrentAmphure($id){

	global $con;

	$sql = "SELECT * FROM amphures WHERE id = '".$id."' ";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCurrentDistrict($id){

	global $con;

	$sql = "SELECT * FROM districts WHERE id = '".$id."' ";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getCountDateWorkMonthDistrict($users_id,$months){

	global $con;

	$sql = "SELECT COUNT(*) as numDate FROM salaries WHERE users_id = '".$users_id."' AND MONTH(salary_date) = '".$months."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function convertMoneyToText($number){ 
	$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
	$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
	$number = str_replace(",","",$number); 
	$number = str_replace(" ","",$number); 
	$number = str_replace("บาท","",$number); 
	$number = explode(".",$number); 
	if(sizeof($number)>2){ 
		return 'ทศนิยมหลายตัวนะจ๊ะ'; 
		exit; 
	}
	$strlen = strlen($number[0]); 
	$convert = ''; 
	for($i=0;$i<$strlen;$i++){ 
		$n = substr($number[0], $i,1); 
		if($n!=0){ 
			if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
			elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
			elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
			else{ $convert .= $txtnum1[$n]; } 
			$convert .= $txtnum2[$strlen-$i-1]; 
		} 
	} 

	$convert .= 'บาท'; 
	if($number[1]=='0' OR $number[1]=='00' OR 
		$number[1]==''){ 
		$convert .= 'ถ้วน'; 
}else{ 
	$strlen = strlen($number[1]); 
	for($i=0;$i<$strlen;$i++){ 
		$n = substr($number[1], $i,1); 
		if($n!=0){ 
			if($i==($strlen-1) AND $n==1){$convert 
				.= 'เอ็ด';} 
				elseif($i==($strlen-2) AND 
					$n==2){$convert .= 'ยี่';} 
					elseif($i==($strlen-2) AND 
						$n==1){$convert .= '';} 
						else{ $convert .= $txtnum1[$n];} 
					$convert .= $txtnum2[$strlen-$i-1]; 
				} 
			} 
			$convert .= 'สตางค์'; 
		} 
		return $convert; 
}

function saveTax($res_id,$res_name,$res_address,$res_alley,$res_road,$res_province,$res_district,$res_subdistrict,$res_zipcode,$tax_date,$tax_amount,$tax_deduct,$tax_img){
	
	$arrDate1 = explode("/", $tax_date);
	$convert_tax_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];

	global $con;

	if($tax_img != null ){
		if(move_uploaded_file($_FILES["tax_img"]["tmp_name"],"images/tax/".$_FILES["tax_img"]["name"]))
		{
			$sql = "INSERT INTO taxes (res_id, res_name, res_address, res_alley, res_road, res_province, res_district, res_subdistrict, res_zipcode, tax_date, tax_amount, tax_deduct, tax_img) 
			VALUES('".$res_id."', '".$res_name."', '".$res_address."', '".$res_alley."', '".$res_road."', '".$res_province."', '".$res_district."', '".$res_subdistrict."', '".$res_zipcode."', '".$convert_tax_date."', '".$tax_amount."', '".$tax_deduct."', '".$_FILES["tax_img"]["name"]."')";
		}
	}else{
		$sql = "INSERT INTO taxes (res_id, res_name, res_address, res_alley, res_road, res_province, res_district, res_subdistrict, res_zipcode, tax_date, tax_amount, tax_deduct) 
		VALUES('".$res_id."', '".$res_name."', '".$res_address."', '".$res_alley."', '".$res_road."', '".$res_province."', '".$res_district."', '".$res_subdistrict."', '".$res_zipcode."', '".$convert_tax_date."', '".$tax_amount."', '".$tax_deduct."')";
	}
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'บันทึกข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_tax.php");
	
}

function editTax($id,$res_id,$res_name,$res_address,$res_alley,$res_road,$res_province,$res_district,$res_subdistrict,$res_zipcode,$tax_date,$tax_amount,$tax_deduct,$tax_img){
	
	$arrDate1 = explode("/", $tax_date);
	$convert_tax_date = $arrDate1[2].'-'.$arrDate1[1].'-'.$arrDate1[0];

	global $con;

	if($tax_img != null ){
		if(move_uploaded_file($_FILES["tax_img"]["tmp_name"],"images/tax/".$_FILES["tax_img"]["name"]))
		{
			$sql="UPDATE taxes SET res_id='".$res_id."',res_name='".$res_name."',res_address='".$res_address."',res_alley='".$res_alley."',res_road='".$res_road."',res_province='".$res_province."',res_district='".$res_district."',res_subdistrict='".$res_subdistrict."',res_zipcode='".$res_zipcode."',tax_date='".$tax_date."',tax_amount='".$tax_amount."',tax_deduct='".$tax_deduct."',tax_img='".$_FILES["tax_img"]["name"]."' WHERE id = '".$id."'";
		}
	}else{
		$sql="UPDATE taxes SET res_id='".$res_id."',res_name='".$res_name."',res_address='".$res_address."',res_alley='".$res_alley."',res_road='".$res_road."',res_province='".$res_province."',res_district='".$res_district."',res_subdistrict='".$res_subdistrict."',res_zipcode='".$res_zipcode."',tax_date='".$tax_date."',tax_amount='".$tax_amount."',tax_deduct='".$tax_deduct."' WHERE id = '".$id."'";
	}
	mysqli_query($con,$sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'แก้ไขข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=manage_tax.php"); 
}

function getCurrentTax($id){

	global $con;

	$sql = "SELECT * FROM taxes WHERE id = '".$id."'";
	$res = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);

}

function getAllTax(){
	global $con;

	$sql = "SELECT * FROM taxes";
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'no' => $row['no'],
			'number' => $row['number'],
			'res_id' => $row['res_id'],
			'res_name' => $row['res_name'],
			'res_address' => $row['res_address'],
			'res_alley' => $row['res_alley'],
			'res_road' => $row['res_road'],
			'res_province' => $row['res_province'],
			'res_district' => $row['res_district'],
			'res_subdistrict' => $row['res_subdistrict'],
			'res_zipcode' => $row['res_zipcode'],
			'tax_img' => $row['tax_img'],
			'tax_date' => $row['tax_date'],
			'tax_amount' => $row['tax_amount'],
			'tax_deduct' => $row['tax_deduct']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);

}

function deleteTax($id){
	global $con;

	mysqli_query($con,"DELETE FROM taxes WHERE id='".$id."'");
	mysqli_close($con);
	echo ("<script language='JavaScript'>
		window.location.href='manage_tax.php';
		</script>"); 
}

function saveWithDraw($users_id,$wage,$withdraw_amount){
	global $con;

	$yThai = date("Y")+543;
	$dateNow = $yThai.date("-m-d");

	$rem = -$withdraw_amount;
	$bal = $wage - $withdraw_amount;
	$sql = "INSERT INTO withdraws (users_id, withdraw_amount, withdraw_date) VALUES('".$users_id."','".$withdraw_amount."','".$dateNow."')";
	mysqli_query($con,$sql);

	mysqli_query($con,"INSERT INTO salaries (users_id, salary_detail, salary_date, salary_amount, salary_remaining) VALUES('".$users_id."','เบิกค่าแรง','".$dateNow."','".$rem."','".$rem."')");
	mysqli_query($con,"UPDATE users SET wage='".$bal."' WHERE id = '".$users_id."'");

	mysqli_close($con);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'สำเร็จ',
				text: 'บันทึกข้อมูลเรียบร้อย',
				showConfirmButton: false
			});
		});
		</script>"); 
	header("refresh:1; url=detail_salary.php?id=$users_id");

}
?>