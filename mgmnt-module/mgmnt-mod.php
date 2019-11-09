<!DOCTYPE html>
<html>
    <head>
        <title>PRINCESS BANANA ERP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
				 <li><a href="#">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php">ADMIN</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">Enterprise Resources Planning - MANAGEMENT MODULE</div>
             <div id="mod_menu"> 
			 MANAGEMENT MENU
				<div class="list-type1">
					<ol>
						<li><a id="aexp" href="#">Approve Expenses</a></li>
						<li><a id="aupd" href="#">Approve Updates</a></li>
						<li><a id="adel" href="#">Approve Deletes</a></li>
					    <li><a id="apay" href="#">Approve Payments</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display">NOTIFY USER FOR ANY  APPROVAL REQUIREMENT HERE</div>
			 <div id="sitemessages"><marquee behavior="scroll" direction="left">Checkout slide-in text here</marquee></div>
        </div>
        <!-- FOOTER -->
        <div id="footer">
           <div id="section_1">Developed by: Enafritech<br>www.enafritech.com</div>
           <div id="section_2">Report Problem</div>
           <div id="section_3">Logout</div>
        </div>
	</div>
	<script type="text/javascript"> 
            $("#aexp").click(function(){
                $("#mod_display").load("forms/expenses/expenses-ops.html"); 
            });
			$("#aupd").click(function(){
                $("#mod_display").load("forms/updates/updates-ops.html"); 
            });
			$("#adel").click(function(){
                $("#mod_display").load("forms/deletes/deletes-ops.html"); 
            });
			$("#apay").click(function(){
                $("#mod_display").load("forms/payments/payments-ops.html"); 
            });
     </script>
	</body>
</html>

