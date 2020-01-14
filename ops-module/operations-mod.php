<?php

	//Start Session
	session_start();
	
	
	// Include Queries
	include "scripts/accounting_queries.php";
		

	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='index.html'; </script>";
		exit;
		
	}else{
	
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
	
	
		// Create Objects
		$motd_list = new queryACCOUNTING();	
		$user_role = new queryACCOUNTING();
		$user_dept = new queryACCOUNTING();
		$user_permissions = new queryACCOUNTING();
	
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
        <title>ACCONTING MODULE</title>
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
                 <li><a href="../frontend/index.html">HOME</a></li>
                 <li><a href="../hr-module/hr-mod.php">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php">PRODUCTION</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php">ADMIN</a></li>
			 <?php }else{ ?>
			 	 <!-- VISIBLE TO ACCOUNTING DEPARTMENT ONLY -->
                 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>			
			<?php } ?>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - ACCOUNTING MODULE</div>
             <div id="mod_menu"> 
			 ACCOUNTING MENU
				<div class="list-type1">
					<ol>
					    <li><a id="batch-ops" href="#">Batches</a></li>
						<li><a id="prod-ops" href="#">Products</a></li>
						<li><a id="expenses-ops" href="#">Expenses</a></li>
						<li><a id="bills" href="#">Bills</a></li>
						<li><a id="setup" href="#">Setup</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display"> ACCOUNTING CONTENT GOES HERE</div>
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
	
			$("#expenses-ops").click(function(){
                $("#mod_display").load("forms/expenses/operations_expenses.html"); 
            });
			
			$("#batch-ops").click(function(){
                $("#mod_display").load("forms/batch/batch_operations.html"); 
            });
			
			$("#prod-ops").click(function(){
                $("#mod_display").load("forms/product/product_operations-types.html"); 
            });
			
			$("#setup").click(function(){
                $("#mod_display").load("forms/setup/setup_operations.html"); 
            });
			
			$("#bills").click(function(){
                $("#mod_display").load("forms/bills/bills_operation-types.html"); 
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

