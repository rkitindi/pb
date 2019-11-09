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
				 <li><a href="#">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php">ADMIN</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">Enterprise Resources Planning - PRODUCTIONS MODULE</div>
             <div id="mod_menu"> 
			 PRODUCTIONS MENU
				<div class="list-type1">
					<ol>
						<li><a id="supp" href="#">Suppliers</a></li>
						<li><a id="farm" href="#">Farms</a></li>
						<li><a id="trucks" href="#">Trucks</a></li>
						<li><a id="product" href="#">Products</a></li>
						<li><a id="inventory" href="#">Inventory</a></li>
						<li><a id="expenses" href="#">Expenses</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display">PRODUCTION CONTENT GOES HERE</div>
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
            $("#farm").click(function(){
                $("#mod_display").load("forms/farm/farm_operations.php"); 
            });
			$("#product").click(function(){
                $("#mod_display").load("forms/product/product_operations-types.html"); 
            });
			$("#expenses").click(function(){
                $("#mod_display").load("forms/expenses/expenses_operations.php"); 
            });
			$("#inventory").click(function(){
                $("#mod_display").load("forms/inventory/inventory_operations.php"); 
            });
			$("#trucks").click(function(){
                $("#mod_display").load("forms/truck/truck_operations.php"); 
            });
			$("#supp").click(function(){
                $("#mod_display").load("forms/supplier/supplier_operation-types.php"); 
            });
     </script>
	</body>
</html>

