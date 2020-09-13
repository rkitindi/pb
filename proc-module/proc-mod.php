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
             <div id="mod_title">Enterprise Resources Planning - STORE MODULE</div>
             <div id="mod_menu"> 
			 STORE MODULE MENU
				<div class="list-type1">
					<ol>
					   <li><a id="ritem" href="#">Register Items</a></li>
						<li><a id="porder" href="#">Order Cases</a></li>
						<li><a id="uitem" href="#">Update Item</a></li>
						<li><a id="ditem" href="#">Delete Item</a></li>
						<li><a id="rorder" href="#">Receive Order</a></li>
						<li><a id="ureceived" href="#">Update Received</a></li>
						<li><a id="dreceieved" href="#">Delete Received</a></li>
						<li><a id="dispatch" href="#">Dispatch Received</a></li>
						<li><a id="udispatch" href="#">Update Dispatched</a></li>
						 <li><a id="ddispatch" href="#">Delete Dispatched</a></li>
					</ol>
				</div> 
			 </div>
			 <div id="mod_display">DISPLAY OUT OF STOCK ALARM HERE</div>
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
            $("#porder").click(function(){
                $("#mod_display").load("forms/order_boxes.php"); 
            });
			$("#uitem").click(function(){
                $("#mod_display").load("forms/update_item.php"); 
            });
			$("#ditem").click(function(){
                $("#mod_display").load("forms/delete_item.php"); 
            });
			$("#rorder").click(function(){
                $("#mod_display").load("forms/search_order.php"); 
            });
			$("#ureceived").click(function(){
                $("#mod_display").load("forms/search_received.php"); 
            });
			$("#dreceieved").click(function(){
                $("#mod_display").load("forms/del_search_received.php"); 
            });
			$("#dispatch").click(function(){
                $("#mod_display").load("forms/disp_search_received.php"); 
            });
			$("#udispatch").click(function(){
                $("#mod_display").load("forms/search_dispatched.php"); 
            });
			$("#ddispatch").click(function(){
                $("#mod_display").load("forms/del_search_dispatched.php"); 
            });
			$("#ritem").click(function(){
                $("#mod_display").load("forms/register_item.php"); 
            });
     </script>
	</body>
</html>

