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
				 <li><a href="#">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.php">OPERATIONS</a></li>
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
             <div id="mod_title">Enterprise Resources Planning - PRODUCTIONS MODULE</div>
             <div id="mod_menu"> 
			 PRODUCTIONS MENU
				<div class="list-type1">
					<ol>
						 <li><a id="reg_farm" href="#">Register Farm</a></li>
						<li><a id="reg_batch" href="#">Register Batch</a></li>
						<li><a id="reg_prod" href="#">Register Product</a></li>
						<li><a id="disp_prod" href="#">Dispatch Product</a></li>
						<li><a id="reg_exp" href="#">Register Expenses</a></li>
						<li><a id="upd_farm" href="#">Update Farm</a></li>
						<li><a id="upd_batch" href="#">Update Batch</a></li>
						<li><a id="upd_prod" href="#">Update Product</a></li>
						<li><a id="upd_disp" href="#">Update Dispatch</a></li>
						<li><a id="del_farm" href="#">Delete Farm</a></li>
						<li><a id="del_batch" href="#">Delete Batch</a></li>
						<li><a id="del_prod" href="#">Delete Product</a></li>
						<li><a id="del_disp" href="#">Delete Dispatch</a></li>
					    
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
            $("#reg_farm").click(function(){
                $("#mod_display").load("forms/register_farm.php"); 
            });
			$("#reg_batch").click(function(){
                $("#mod_display").load("forms/register_batch.php"); 
            });
			$("#reg_prod").click(function(){
                $("#mod_display").load("forms/register_product.php"); 
            });
			$("#disp_prod").click(function(){
                $("#mod_display").load("forms/dispatch_product.php"); 
            });
			$("#reg_exp").click(function(){
                $("#mod_display").load("forms/register_expenses.php"); 
            });
			$("#upd_farm").click(function(){
                $("#mod_display").load("forms/search_farm.php"); 
            });
			$("#upd_batch").click(function(){
                $("#mod_display").load("forms/search_batch.php"); 
            });
			$("#upd_prod").click(function(){
                $("#mod_display").load("forms/search_product.php"); 
            });
			$("#del_batch").click(function(){
                $("#mod_display").load("forms/del_search_batch.php"); 
            });
			$("#del_prod").click(function(){
                $("#mod_display").load("forms/del_search_product.php"); 
            });
			$("#del_farm").click(function(){
                $("#mod_display").load("forms/del_search_farm.php"); 
            });
			$("#upd_disp").click(function(){
                $("#mod_display").load("forms/search_dispatch.php"); 
            });	
			$("#del_disp").click(function(){
                $("#mod_display").load("forms/del_search_dispatch.php"); 
            });			
     </script>
	</body>
</html>

