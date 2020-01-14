<?php

	//Start Session
	session_start();
	
	// Include setup.php file
	include "scripts/report_queries.php";
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
		
		// Create Objects
		$motd_list = new queryREPORTS();	
		$user_role = new queryREPORTS();
		$user_dept = new queryREPORTS();
		$user_permissions = new queryREPORTS();
		
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
        <title>REPORTS MODULE</title>
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
			 <?php
				//Visible to Admin only
				if( ($role_name == "admin") OR ($dept_name == "administration")){?>
                 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="../hr-module/hr-mod.php" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php" class="btn btn-primary btn-xs">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php" class="btn btn-primary btn-xs">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php" class="btn btn-primary btn-xs">MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php" class="btn btn-primary btn-xs">ADMIN</a></li>
				 <?php }elseif($dept_name == "hr"){?>
				<!-- VISIBLE TO HR DEPARTMENT ONLY -->
		         <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="../hr-module/hr-mod.php" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				<?php }elseif($dept_name == "production"){?>				
				 <!-- VISIBLE TO PRODUCTION DEPARTMENT ONLY -->
				 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a href="../prod-module/prod-mod.php" class="btn btn-primary btn-xs">PRODUCTION</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				 <?php }elseif($dept_name == "accounting"){?>				
				 <!-- VISIBLE TO ACCOUNTING DEPARTMENT ONLY -->
				 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				 <?php }elseif($dept_name == "finance"){?>
				 <!-- VISIBLE TO FINANCE DEPARTMENT ONLY -->
				 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				 <?php }elseif($dept_name == "sales"){?>
				 <!-- VISIBLE TO SALES DEPARTMENT ONLY -->
				 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php" class="btn btn-primary btn-xs">SALES</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				<?php } ?>				 
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - REPORTS MODULE</div>
             <div id="mod_menu"> 
			 REPORTS MENU
			 <div class="list-type1">
					<ol>
						<li><a id="batch_repo" href="#">Batch Reports</a></li>
						<li><a id="prod_repo" href="#">Products Reports </a></li>
						<li><a id="user_repo" href="#">Users Reports</a></li>
						<li><a id="exp_repo" href="#">Expenses Reports</a></li>
						<li><a id="sales_repo" href="#">Sales Reports</a></li>
						<li><a id="view" href="#">Views</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display"> REPORTS CONTENT GOES HERE</div>
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
	
            $("#batch_repo").click(function(){
                $("#mod_display").load("forms/batch_reports.php"); 
            });
			$("#prod_repo").click(function(){
                $("#mod_display").load("forms/products_reports.php"); 
            });
			$("#user_repo").click(function(){
                $("#mod_display").load("forms/user_reports.php"); 
            });
			$("#exp_repo").click(function(){
                $("#mod_display").load("forms/expenses_reports.php"); 
            });
			$("#sales_repo").click(function(){
                $("#mod_display").load("forms/delete_role.php"); 
            });
			$("#view").click(function(){
                $("#mod_display").load("reports/views/view_operations.html"); 
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

