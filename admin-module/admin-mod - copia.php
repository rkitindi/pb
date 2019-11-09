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
                 <li><a href="../hr-module/hr-mod.php">HR</a></li>
				 <li><a href="../prod-module/prod-mod.php">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php">OPERATIONS</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="#">ADMIN</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">PRINCESS BANANA ERP - ADMINISTRATION MODULE</div>
			 <div id="mod_menu">
			 ADMINISTRATION MENU
				<div class="list-type1">
					<ol>
						<li><a id="create_role" href="#">Creat Role</a></li>
						<li><a id="upd_role" href="#">Update Role</a></li>
						<li><a id="del_role" href="#">Delete Role</a></li>
						<li><a id="create_user" href="#">Create User</a></li>
						<li><a id="upd_user" href="#">Update user</a></li>
						<li><a id="del_user" href="#">Delete User</a></li>	
					</ol>
				</div>
			 </div>
			 <div id="mod_display"> ADMINISTRATION CONTENT GOES HERE</div>
			 <div id="sitemessages"><marquee behavior="scroll" direction="left">Checkout slide-in text here</marquee></div>
        </div>
        <!-- FOOTER -->
        <div id="footer">
           <div id="section_1">Developed by: Enafritech <br> www.enafritech.com</div>
           <div id="section_2">Report Problem</div>
           <div id="section_3">Logout</div>
        </div>
	</div>
	<script type="text/javascript"> 
            $("#create_role").click(function(){
                $("#mod_display").load("forms/create_role.php"); 
            });
			$("#create_user").click(function(){
                $("#mod_display").load("forms/create_user.php"); 
            });
			$("#create_emp").click(function(){
                $("#mod_display").load("forms/register_employee.php"); 
            });
			$("#upd_role").click(function(){
                $("#mod_display").load("forms/search_role.php"); 
            });
			$("#upd_user").click(function(){
                $("#mod_display").load("forms/search_user.php"); 
            });
			$("#upd_emp").click(function(){
                $("#mod_display").load("forms/update_employee.php"); 
            });
			$("#del_role").click(function(){
                $("#mod_display").load("forms/del_search_role.php"); 
            });
			$("#del_user").click(function(){
                $("#mod_display").load("forms/del_search_user.php"); 
            });
			$("#del_emp").click(function(){
                $("#mod_display").load("forms/delete_employee.php"); 
            });
     </script> 
	</body>
</html>

