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
			<div id="form_section1">WHAT DO YOU WANT TO DO?</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">	
					<input type="button" value="ADD MESSAGE" id="amotd"><br>
					<input type="button" value="UPDATE MESSAGE" id="umotd"><br>				
					<input type="button" value="DELETE MESSAGE" id="dmotd">	
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#amotd").click(function(){
                $("#mod_display").load("forms/settings/motd/add_message.php"); 
            });
			$("#umotd").click(function(){
                $("#mod_display").load("forms/settings/motd/search_message.php"); 
            });
			$("#dmotd").click(function(){
                $("#mod_display").load("forms/settings/motd/del_search_message.php"); 
            });
		</script>
</body>
</html>