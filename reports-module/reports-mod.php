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
                 <li><a href="../ops-module/operations-mod.php">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="#">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php">ADMIN</a></li>
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
     </script>
	</body>
</html>

