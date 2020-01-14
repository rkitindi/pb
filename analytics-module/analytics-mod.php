<?php

	//Start Session
	session_start();
	
	// Include setup.php file
	include "scripts/analytics_queries.php";
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
		
		// Create Objects
		$motd_list = new queryANALYTICS();	
		$user_role = new queryANALYTICS();
		$user_dept = new queryANALYTICS();
		$user_permissions = new queryANALYTICS();
		
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
        <title>ANALYTICS MODULE</title>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="#" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
				<?php } ?>				 
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - ANALYTICS MODULE</div>
             <div id="mod_menu"> 
			 ANALYTICS MENU
			 <div class="list-type1">
					<ol>
						<li><a id="top_batch" href="#"> Top Batch </a></li>
						<li><a id="top_product" href="#"> Top Product </a></li>
						<li><a id="top_seller" href="#"> Top Sellere </a></li>
						<li><a id="sales_trend" href="#"> Sales Trends </a></li>
						<li><a id="prod_trend" href="#"> Products Trends </a></li>
						<li><a id="batch_trend" href="#"> Batch Trends </a></li>
						<li><a id="seller_trend" href="#"> Sellers Trends </a></li>
						<li><a id="exp_trend" href="#"> Expenses Trends </a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display">ANALYTICS MODULE CONTENT GOES HERE</div>
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
            $("#top_batch").click(function(){
                $("#mod_display").load("forms/top_batch.php"); 
            });
			$("#top_product").click(function(){
                $("#mod_display").load("forms/top_product.php"); 
            });
			$("#top_seller").click(function(){
                $("#mod_display").load("forms/top_seller.php"); 
            });
			$("#sales_trend").click(function(){
                $("#mod_display").load("forms/sales_trends.php"); 
            });
			$("#prod_trend").click(function(){
                $("#mod_display").load("forms/product_trends.php"); 
            });
			$("#batch_trend").click(function(){
                $("#mod_display").load("forms/batch_trends.php"); 
            });
			$("#seller_trend").click(function(){
                $("#mod_display").load("forms/sellers_trends.php"); 
            });
			$("#exp_trend").click(function(){
                $("#mod_display").load("forms/expenses_trends.php"); 
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

