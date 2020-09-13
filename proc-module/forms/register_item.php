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
					<input type="button" value="REGISTER CASE (BOXE)" id="cases"><br>
					<input type="button" value="REGISTER BANANA TREES BATCH" id="tbatch"><br>
					<input type="button" value="REGISTER BANANA TREES" id="trees"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#cases").click(function(){
                $("#mod_display").load("forms/register_cases.php"); 
            });
			$("#trees").click(function(){
                $("#mod_display").load("forms/register_trees.php"); 
            });
			$("#tbatch").click(function(){
                $("#mod_display").load("forms/register_tree_batch.php"); 
            });
		</script>
</body>
</html>