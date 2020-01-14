<?php

	//Start Session
	session_start();
	
	
	// Include Queries
	include "scripts/fe_queries.php";

	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='index.html'; </script>";
		exit;
		
	}else{
	
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
	
	
		// Create Objects
		$motd_list = new queryFRONTEND();	
		$User_name = new queryFRONTEND();
		$user_role = new queryFRONTEND();
		$user_dept = new queryFRONTEND();
		$user_permissions = new queryFRONTEND();
	
		// Query Data from Database
		$motd = $motd_list->fetch_MOTD();
		$name = $User_name->fetch_employee_name($e_id);
		$role_name = $user_role->fetch_role_name($r_id);
		$dept_name = $user_dept->fetch_user_dept($e_id);
		$perm_list = $user_permissions->fetch_user_permission($r_id);
		
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PRINCESS BANANA ERP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet"  type="text/css" href="style.css">
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
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
				 <li><a type="button" class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
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
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>					
			<?php } ?>
            </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
            <div id="login_0">You are logged in as:  <?php echo $name; ?>,  Please work responsibly!</div>
			<div id="login_1">
				<div id="form_wrapper">
					<div id="text_section">
						<h2 style="color:blue;">COLLECTED INFORMATION</h2> 
						<h3 style="color:blue;">Your role is:   <?php echo $role_name; ?> </h3>
						<h3 style="color:blue;">Your department is:  <?php echo $dept_name; ?></h3>
						<h3 style="color:blue;">Your permissions  are:  <?php if ("insert" == array_search("insert",$perm_list)){echo $perm_list[0];}else{echo "NO INSERT";} ?></h3>
					</div>
				</div>
			</div>
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
	
		$("#repopro").click(function(){
			$("#form_wrapper").load("forms/problems/report_problem.php"); 
		});	
		
		$("#logout_btn").click(function(){
            $.get("scripts/login.php", $("#logout_form").serialize(), function(response) {
				$("#form_wrapper").html(response);
			});
			return false;
        });
			
	</script>
   </body>
</html>

