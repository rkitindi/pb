
<?php
	// Include setup.php file
	include "scripts/admin_queries.php";
	
	// read the product categories from the database
	$message = new queryADMIN();
	$motd = $message->fetch_MOTD();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PRINCESS BANANA ERP</title>
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
                 <li><a href="../frontend/index.html">HOME</a></li>
                 <li><a href="../hr-module/hr-mod.html">HR</a></li>
				 <li><a href="../prod-module/prod-mod.html">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.html">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.html">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.html">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.html">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.html">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.html">TRENDS</a></li>
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
           <div id="section_2">Report Problem</div>
           <div id="section_3">Logout</div>
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
     </script> 
	</body>
</html>

