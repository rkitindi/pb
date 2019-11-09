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
					<input type="button" value="CASES" id="case"><br>
					<input type="button" value="BANANA TREES" id="banana"><br>				
					<input type="button" value="FERTILIZERS" id="fert"><br>									
					<input type="button" value="PESTISIDES" id="pest"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#case").click(function(){
                $("#mod_display").load("forms/inventory/cases/cases_operations-types.html"); 
            });
			$("#banana").click(function(){
                $("#mod_display").load("forms/inventory/banana_trees/banana_trees_operations.php"); 
            });
			$("#fert").click(function(){
                $("#mod_display").load("forms/inventory/fertilizers/fertilizers_operations.php"); 
            });
			$("#pest").click(function(){
                $("#mod_display").load("forms/inventory/pestcides/pestcides_operations.php"); 
            });
		</script>
</body>
</html>