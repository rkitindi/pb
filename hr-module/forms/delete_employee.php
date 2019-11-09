<?php
// Include config file
require_once "../scripts/config.php";
 
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
					<input type="button" value="EMPLOYMENT TYPES" id="etype"><br>
					<input type="button" value="PAYMENT TYPES" id="ptype"><br>
					<input type="button" value="PAYMENT SCHEDULE" id="pschedules"><br>
					<input type="button" value="LEAVE TYPE" id="ltype"><br>
					<input type="button" value="PERSONAL INFO" id="pinfo"><br>
					<input type="button" value="SALARIES INFO" id="sinfo"><br>
					<input type="button" value="LEAVE INFO" id="linfo"><br>
					<input type="button" value="BANK INFO" id="binfo">
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#etype").click(function(){
                $("#mod_display").load("forms/del_search_emplyment_type.php"); 
            });
			$("#ptype").click(function(){
                $("#mod_display").load("forms/del_search_payment_type.php"); 
            });
			$("#pschedules").click(function(){
                $("#mod_display").load("forms/del_search_payment_schedule.php"); 
            });
			$("#ltype").click(function(){
                $("#mod_display").load("forms/del_search_leave_type.php"); 
            });
			$("#pinfo").click(function(){
                $("#mod_display").load("forms/del_search_employee_pinfo.php"); 
            });
			$("#sinfo").click(function(){
                $("#mod_display").load("forms/del_search_employee_sinfo.php"); 
            });
			$("#linfo").click(function(){
                $("#mod_display").load("forms/del_search_employee_linfo.php"); 
            });
			$("#binfo").click(function(){
                $("#mod_display").load("forms/del_search_employee_binfo.php"); 
            });
		</script>
</body>
</html>