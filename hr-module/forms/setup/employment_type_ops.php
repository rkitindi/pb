<?php

	//Start Session
	session_start(); 
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;
		
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup HR</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CLICK APPROPIATE BUTTON TO PROCEED</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<input type="button" value="ADD EMPLOYMENT TYPE" id="etype"><br>
					<input type="button" value="UPDATE EMPLOYMENT TYPE" id="ptype"><br>
					<input type="button" value="DELETE EMPLOYMENT TYPE" id="pschedules"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#etype").click(function(){
                $("#mod_display").load("forms/setup/employment_type.php"); 
            });
			$("#ptype").click(function(){
                $("#mod_display").load("forms/setup/search_employment_type.html"); 
            });
			$("#pschedules").click(function(){
                $("#mod_display").load("forms/setup/del_search_employment_type.html"); 
            });
		</script>
</body>
</html>