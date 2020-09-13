
<?php

	//Start Session
	session_start();
	
	// Include setup.php file
	include "scripts/admin_queries.php";
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
		
		// Create Objects
		$motd_list = new queryADMIN();	
		$user_role = new queryADMIN();
		$user_dept = new queryADMIN();
		$user_permissions = new queryADMIN();
		
		// Query Data from Database
		$motd = $motd_list->fetch_MOTD();
		$role_name = $user_role->fetch_role_name($r_id);
		$dept_name = $user_dept->fetch_user_dept($e_id);
		$perm_list = $user_permissions->fetch_user_permission($r_id);
	}
	

?>

<!DOCTYPE html>
<html>
    <head>
        <title>ADMIN MODULE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
                 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="../hr-module/hr-mod.php" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php" class="btn btn-primary btn-xs">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php" class="btn btn-primary btn-xs">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php" class="btn btn-primary btn-xs">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a href="#">ADMIN</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - ADMINISTRATION MODULE</div>
			 <div id="mod_menu">
			 ADMIN MENU
				<div class="list-type1">
					<ol>
						<li><a id="perm" href="#">Permissions</a></li>
						<li><a id="role" href="#">User Roles</a></li>
						<li><a id="user" href="#">System Users</a></li>
						<li><a id="set" href="#">System Settings</a></li>
					</ol>
				</div>
			 </div>
			 <div id="mod_display"> ADMIN CONTENT GOES HERE</div>
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
	<script type="text/javascript"> 
            $("#role").click(function(){
                $("#mod_display").load("forms/role/role_ops.html"); 
            });
			$("#perm").click(function(){
                $("#mod_display").load("forms/permission/permission_ops.html"); 
            });
			$("#user").click(function(){
                $("#mod_display").load("forms/user/user_ops.html"); 
            });
			$("#set").click(function(){
                $("#mod_display").load("forms/settings/settings.html"); 
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

