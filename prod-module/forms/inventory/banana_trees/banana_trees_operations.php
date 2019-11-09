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
					<input type="button" value="REGISTER BANANA TREES BATCH" id="rbatch"><br>
					<input type="button" value="UPDATE BANANA TREES BATCH" id="ubatch"><br>
					<input type="button" value="DELETE BANANA TREES BATCH" id="dbatch"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#rbatch").click(function(){
                $("#mod_display").load("forms/inventory/banana_trees/register_batch.php"); 
            });
			$("#ubatch").click(function(){
                $("#mod_display").load("forms/inventory/banana_trees/search_batch.php"); 
            });
			$("#dbatch").click(function(){
                $("#mod_display").load("forms/inventory/banana_trees/del_search_batch.php"); 
            });
		</script>
</body>
</html>