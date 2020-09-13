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
					<input type="button" value="REGISTER SUPPLY CATEGORY" id="rsupcat"><br>
					<input type="button" value="UPDATE SUPPLY CATEGORY" id="usupcat"><br>				
					<input type="button" value="DELETE SUPPLY CATEGORY" id="dsupcat"><br>
					<input type="button" value="REGISTER SUPPLIER" id="rsupp"><br>
					<input type="button" value="UPDATE SUPPLIER" id="usupp"><br>				
					<input type="button" value="DELETE SUPPLIER" id="dsupp"><br>					
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#rsupcat").click(function(){
                $("#mod_display").load("forms/supplier/register_supp_cat.php"); 
            });
			$("#usupcat").click(function(){
                $("#mod_display").load("forms/supplier/search_supp_cat.php"); 
            });
			$("#dsupcat").click(function(){
                $("#mod_display").load("forms/supplier/del_search_supp_cat.php"); 
            });
			$("#rsupp").click(function(){
                $("#mod_display").load("forms/supplier/register_supplier.php"); 
            });
			$("#usupp").click(function(){
                $("#mod_display").load("forms/supplier/search_supplier.php"); 
            });
			$("#dsupp").click(function(){
                $("#mod_display").load("forms/supplier/del_search_supplier.php"); 
            });
		</script>
</body>
</html>