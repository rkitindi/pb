<?php
// Include config file
require_once "../scripts/config.php";
 
?>
 
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
					<input type="button" value="ORDER CASES (BOXES)" id="cases"><br>
					<input type="button" value="ORDER PESTSIDES" id="pestiside"><br>
					<input type="button" value="ORDER FERTILIZERS" id="fertilizer"><br>
					<input type="button" value="ORDER DRINKING WATER" id="water"><br>
					<input type="button" value="ORDER CATRIDGE" id="catridge"><br>
					<input type="button" value="ORDER PRINTING PAPERS" id="papers"><br>
					<input type="button" value="ORDER SUGAR" id="sugar">
					<input type="button" value="ORDER COFFEE" id="coffee">
					<input type="button" value="ORDER MILK" id="milk">
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#cases").click(function(){
                $("#mod_display").load("forms/order_cases.php"); 
            });
			$("#pestiside").click(function(){
                $("#mod_display").load("forms/order_pestiside.php"); 
            });
			$("#pestiside").click(function(){
                $("#mod_display").load("forms/order_fertilizer.php"); 
            });
			$("#water").click(function(){
                $("#mod_display").load("forms/order_water.php"); 
            });
			$("#catridge").click(function(){
                $("#mod_display").load("forms/order_catridge.php"); 
            });
			$("#papers").click(function(){
                $("#mod_display").load("forms/order_paper.php"); 
            });
			$("#sugar").click(function(){
                $("#mod_display").load("forms/order_sugar.php"); 
            });
			$("#coffee").click(function(){
                $("#mod_display").load("forms/order_coffee.php"); 
            });
			$("#milk").click(function(){
                $("#mod_display").load("forms/order_milk.php"); 
            });
		</script>
</body>
</html>