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
					<input type="button" value="RECEIVE PRODUCT" id="rprod"><br>
					<input type="button" value="UPDATE RECEIVED" id="urcvd"><br>				
					<input type="button" value="DELETE RECEIVED" id="drcvd"><br>
					<input type="button" value="DISPATCH PRODUCT" id="dispprod"><br>
					<input type="button" value="UPDATE DISPATCHED" id="udisp"><br>				
					<input type="button" value="DELETE DISPATCHED" id="ddisp"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#rprod").click(function(){
                $("#mod_display").load("forms/product/receive_product.php"); 
            });
			$("#urcvd").click(function(){
                $("#mod_display").load("forms/product/search_received.php"); 
            });
			$("#drcvd").click(function(){
                $("#mod_display").load("forms/product/del_search_received.php"); 
            });
			$("#dispprod").click(function(){
                $("#mod_display").load("forms/product/dispatch_product.php"); 
            });
			$("#udisp").click(function(){
                $("#mod_display").load("forms/product/search_dispatched.php"); 
            });
			$("#ddisp").click(function(){
                $("#mod_display").load("forms/product/del_search_dispatched.php"); 
            });
		</script>
</body>
</html>