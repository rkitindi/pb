<?php

	//Start Session
	session_start();
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='index.html'; </script>";
		exit;
		
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Role</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CLICK APPROPIATE BUTTON TO PROCEED</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<input type="button" value="EMPLOYEE DETAILS" id="pinfo"><br>
					<input type="button" value="EMPLOYEE EMERGENCY DETAILS" id="emdet"><br>
					<input type="button" value="DEPARTMENT INFO" id="depinfo"><br>
					<input type="button" value="EMPLOYMENT TYPE INFO" id="etypeinfo"><br>
					<input type="button" value="SALARIES INFO" id="sinfo"><br>
					<input type="button" value="LEAVE INFO" id="linfo"><br>
					<input type="button" value="BANK INFO" id="binfo">
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
			$("#pinfo").click(function(){
                $("#mod_display").load("forms/insert/personal_info.php"); 
            });
			$("#emdet").click(function(){
                $("#mod_display").load("forms/insert/emergency_info.php"); 
            });
			$("#depinfo").click(function(){
                $("#mod_display").load("forms/insert/employee_dept_info.php"); 
            });
			$("#etypeinfo").click(function(){
                $("#mod_display").load("forms/insert/employee_etype_info.php"); 
            });
			$("#sinfo").click(function(){
                $("#mod_display").load("forms/insert/salary_info.php"); 
            });
			$("#linfo").click(function(){
                $("#mod_display").load("forms/insert/leave_info.php"); 
            });
			$("#binfo").click(function(){
                $("#mod_display").load("forms/insert/bank_info.php"); 
            });
		</script>
</body>
</html>