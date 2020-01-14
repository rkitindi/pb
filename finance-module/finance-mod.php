<?php

	//Start Session
	session_start();
	
	// Include setup.php file
	include "scripts/finance_queries.php";
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
		$r_id = $_SESSION['RoleID'];
		
		// Create Objects
		$motd_list = new queryFINANCE();	
		$user_role = new queryFINANCE();
		$user_dept = new queryFINANCE();
		$user_permissions = new queryFINANCE();
		
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
				if( ($role_name == "admin") OR ($dept_name == "administration")){?>
				 <!-- VISIBLE TO ADMIN ONLY -->
                 <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a href="../hr-module/hr-mod.php" class="btn btn-primary btn-xs">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php" class="btn btn-primary btn-xs">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php" class="btn btn-primary btn-xs">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php" class="btn btn-primary btn-xs">SALES</a></li>
				 <li><a href="#" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php" class="btn btn-primary btn-xs">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php" class="btn btn-primary btn-xs">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php" class="btn btn-primary btn-xs">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php" class="btn btn-primary btn-xs">ADMIN</a></li>
			<?php }else{ ?>
			    <!-- VISIBLE TO FINANCE DEPARTMENT ONLY -->
			     <li><a class="btn btn-primary btn-xs" disabled>HOME</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>HR</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>PRODUCTION</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>ACCOUNTING</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>SALES</a></li>
				 <li><a href="#" class="btn btn-primary btn-xs">FINANCE</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>MANAGEMENT</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>REPORTS</a></li>
                 <li><a class="btn btn-primary btn-xs" disabled>TRENDS</a></li>
				 <li><a class="btn btn-primary btn-xs" disabled>ADMIN</a></li>
			<?php } ?>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">Enterprise Resources Planning - FINANCE MODULE</div>
             <div id="mod_menu"> 
			 FINANCE MENU
				<div class="list-type1">
					<ol>
						<li><a id="receivesales" href="#">Receive Sale</a></li>
						<li><a id="recbill" href="#">Receive Invoice</a></li>
						<li><a id="billupdate" href="#">Update Invoice</a></li>
						<li><a id="billdelete" href="#">Delete Invoice</a></li>
						<li><a id="pay" href="#">Make payment</a></li>
					    <li><a id="payupdate" href="#">Update payment</a></li>
						<li><a id="paydelete" href="#">Delete payment</a></li>
						<li><a id="depomoney" href="#">Deposit Money</a></li>
						<li><a id="depositupd" href="#">Update Deposit</a></li>
						<li><a id="depositdel" href="#">Delete Deposit</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display"> FINANCE CONTENT GOES HERE</div>
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
	
        $("#receivesales").click(function(){
            $("#mod_display").load("forms/search_sale.php"); 
        });
		
		$("#recbill").click(function(){
            $("#mod_display").load("forms/bill_type.php"); 
        });
		
		$("#pay").click(function(){
            $("#mod_display").load("forms/payment_type.php"); 
        });
			
		$("#payupdate").click(function(){
            $("#mod_display").load("forms/payment_type_update.php"); 
        });
			
		$("#paydelete").click(function(){
            $("#mod_display").load("forms/payment_type_delete.php"); 
        });
			
		$("#depomoney").click(function(){
            $("#mod_display").load("forms/depo_money.php"); 
        });
			
		$("#depositupd").click(function(){
            $("#mod_display").load("forms/search_deposit.php"); 
        });
			
		$("#depositdel").click(function(){
            $("#mod_display").load("forms/del_serch_deposit.php"); 
        });
			
		$("#billupdate").click(function(){
            $("#mod_display").load("forms/update_bill_type.php"); 
        });
		
		$("#billdelete").click(function(){
            $("#mod_display").load("forms/delete_bill_type.php"); 
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

