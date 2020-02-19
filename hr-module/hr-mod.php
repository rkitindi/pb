<?php

	//Start Session
	session_start();
	
	
	// Include Queries
	include "scripts/setup.php";
		

	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='index.html'; </script>";
		exit;
		
	}else{
	
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
	
	
		// Create Objects
		$motd_list = new setupHR();	
		$user_role = new setupHR();
		//$user_dept = new setupHR();
		$user_permissions = new setupHR();
	
		// Query Data from Database
		$motd = $motd_list->fetch_MOTD();
		$role_name = $user_role->fetch_role_name($r_id);
		//$dept_name = $user_dept->fetch_user_dept($e_id);
		$perm_list = $user_permissions->fetch_user_permission($r_id);
		
	}
	
?>



<!DOCTYPE html>
<html>
    <head>
        <title>PRINCESS BANANA ERP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet"  type="text/css" href="../frontend/style.css">
    </head>
    <body>
      <!-- CONTAINER -->
      <div class="container" id="container">
        <!-- HEADER -->
        <div id="header">
           <div id="logo">PRINCESS BANANA</div>
           <div id="top_info">ENTERPRISE RESOURCE PLANNING SYSTEM</div>
           <div id="navbar">
            <ul>
			 <?php
				//Visible to Admin only
				if( ($role_name == "admin") OR ($dept_name == "administration")){?>
                 <li><a type="button" class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php" class="btn btn-primary btn-xs">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php" class="btn btn-primary btn-xs">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php" class="btn btn-primary btn-xs">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php" class="btn btn-primary btn-xs">ADMIN</a></li>
			<?php }else{ ?>
				<!-- VISIBLE TO HR DEPARTMENT ONLY -->
			     <li><a type="button" class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a type="button" class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a type="button" class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a type="button" class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a type="button" class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a type="button" class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a type="button" class="btn btn-primary btn-xs" disabled>ADMIN</a></li>			
			<?php } ?>
			
            </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - HR MODULE</div>
			 <div id="mod_menu">
			 HR MENU
				<div class="list-type1">
					<ol>
	                    <li><a id="create_emp" href="#">Register Employee</a></li>						
						<li><a id="upd_emp" href="#">Update Employee</a></li>						
						<li><a id="del_emp" href="#">Delete Employee</a></li>
						<li><a id="setup" href="#">Setup</a></li>
					</ol>
				</div>
			 </div>
			 <div id="mod_display"> HR CONTENT GOES HERE</div>
			 <div id="sitemessages"><marquee behavior="scroll" direction="left"><?php echo $motd; ?></marquee></div>
        </div>
        <!-- FOOTER -->
        <div id="footer">
           <div id="section_1">Developed by: Enafritech <br> www.enafritech.com</div>
           <div id="section_2"><a id="repopro" href="#">Report Problem</a></div>
           <div id="section_3">
		   		<form id="logout_form">
					<input type="submit" id="logout_btn" name="logout" value="LOGOUT">
				</form>	
		   </div>
        </div>
	</div>
	<script> 
	
			$("#create_emp").click(function(){
                $("#mod_display").load("forms/insert/register_employee_ops.php"); 
            });
			
			$("#upd_emp").click(function(){
                $("#mod_display").load("forms/update_employee.html"); 
            });
			
			$("#del_emp").click(function(){
                $("#mod_display").load("forms/delete_employee.html"); 
            });
			
			$("#setup").click(function(){
                $("#mod_display").load("forms/setup/setup_hr.php"); 
            });
			
			$("#repopro").click(function(){
				$("#mod_display").load("forms/problems/report_problem.php"); 
			});
			
			$("#logout_btn").click(function(){
				$.get("scripts/logout.php", $("#logout_form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
			});
			
     </script> 
	</body>
</html>

