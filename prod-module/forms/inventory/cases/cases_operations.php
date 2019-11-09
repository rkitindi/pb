<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Role</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CLICK APPROPIATE BUTTON TO PROCEED</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">	
					<input type="button" value="REGISTER CASES" id="rcase"><br>
					<input type="button" value="UPDATE CASES" id="ucase"><br>				
					<input type="button" value="DELETE CASES" id="dcase"><br>									
					<input type="button" value="ORDER CASES" id="ocase"><br>
					<input type="button" value="UPDATE ORDER" id="uorder"><br>
					<input type="button" value="DELETE ORDER" id="dorder"><br>
					<input type="button" value="RECEIVE ORDER" id="rorder"><br>
					<input type="button" value="UPDATE RECEIVED" id="ureceiv"><br>
					<input type="button" value="DELETE RECEIVED" id="dreceiv"><br>
					<input type="button" value="DISPATCH CASES" id="dispcase"><br>
					<input type="button" value="UPDATE DISPATCHED" id="udisp"><br>
					<input type="button" value="DELETE DISPATCHED" id="ddisp"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#rcase").click(function(){
                $("#mod_display").load("forms/inventory/cases/register_case.php"); 
            });
			$("#ucase").click(function(){
                $("#mod_display").load("forms/inventory/cases/search_case.php"); 
            });
			$("#dcase").click(function(){
                $("#mod_display").load("forms/inventory/cases/del_search_case.php"); 
            });
			$("#ocase").click(function(){
                $("#mod_display").load("forms/inventory/cases/order_case.php"); 
            });
			$("#uorder").click(function(){
                $("#mod_display").load("forms/inventory/cases/search_order.php"); 
            });
			$("#dorder").click(function(){
                $("#mod_display").load("forms/inventory/cases/del_search_order.php"); 
            });
			$("#rorder").click(function(){
                $("#mod_display").load("forms/inventory/cases/receive_order.php"); 
            });
			$("#ureceiv").click(function(){
                $("#mod_display").load("forms/inventory/cases/search_received.php"); 
            });
			$("#dreceiv").click(function(){
                $("#mod_display").load("forms/inventory/cases/del_search_received.php"); 
            });
			$("#dispcase").click(function(){
                $("#mod_display").load("forms/inventory/cases/dispatch_case.php"); 
            });
			$("#udisp").click(function(){
                $("#mod_display").load("forms/inventory/cases/search_dispatched.php"); 
            });
			$("#ddisp").click(function(){
                $("#mod_display").load("forms/inventory/cases/del_search_dispatched.php"); 
            });
		</script>
</body>
</html>