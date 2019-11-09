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
                 <li><a href="../admin-module/admin-mod.php">ADMINISTRATION</a></li>
				 <li><a href="../prod-module/prod-mod.php">PRODUCTION</a></li>
                 <li><a href="#">OPERATIONS</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../proc-module/proc-mod.php">STORE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
             <div id="mod_title">Enterprise Resources Planning - OPERATIONS MODULE</div>
             <div id="mod_menu"> 
			 OPERATIONS MENU
				<div class="list-type1">
					<ol>
						<li><a id="reg_track" href="#">Register Trucks</a></li>
						<li><a id="reg_exp" href="#">Register Expenses</a></li>
					    <li><a id="exp_type" href="#">Expense Types</a></li>
						<li><a id="reg_loc" href="#">Register POS</a></li>
						<li><a id="prod_cat" href="#">Product Categories</a></li>
						<li><a id="reg_batch" href="#">Register Batch</a></li>
						<li><a id="reg_prod" href="#">Register Product</a></li>
						<li><a id="disp_prod" href="#">Dispatch Product</a></li>
						<li><a id="reg_supp" href="#">Register Supplier</a></li>
						<li><a id="reg_cust" href="#">Register Customer</a></li>
						<li><a id="reg_busi" href="#">Business Types</a></li>
						<li><a id="diff_prod" href="#">Diffective Product</a></li>
						<li><a id="updates" href="#">UPDATE RECORDS</a></li>
						<li><a id="deletes" href="#">DELETE RECORDS</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display"> OPERATIONS CONTENT GOES HERE</div>
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
            $("#reg_track").click(function(){
                $("#mod_display").load("forms/register_track.php"); 
            });
			$("#exp_type").click(function(){
                $("#mod_display").load("forms/register_exp_type.php"); 
            });
			$("#reg_exp").click(function(){
                $("#mod_display").load("forms/register_expenses.php"); 
            });
			$("#reg_batch").click(function(){
                $("#mod_display").load("forms/register_batch.php"); 
            });
			$("#disp_prod").click(function(){
                $("#mod_display").load("forms/dispatch_product.php"); 
            });
			$("#prod_cat").click(function(){
                $("#mod_display").load("forms/product_category.php"); 
            });
			$("#reg_prod").click(function(){
                $("#mod_display").load("forms/register_product.php"); 
            });
			$("#reg_supp").click(function(){
                $("#mod_display").load("forms/register_supplier.php"); 
            });
			$("#reg_cust").click(function(){
                $("#mod_display").load("forms/register_customer.php"); 
            });
			$("#reg_loc").click(function(){
                $("#mod_display").load("forms/register_pos.php"); 
            });
			$("#diff_prod").click(function(){
                $("#mod_display").load("forms/search_product.php"); 
            });
			$("#updates").click(function(){
                $("#mod_display").load("forms/updates.html"); 
            });
		    $("#deletes").click(function(){
                $("#mod_display").load("forms/deletes.html"); 
            });
			$("#reg_busi").click(function(){
                $("#mod_display").load("forms/register_business_types.php"); 
            });
     </script>
	</body>
</html>

