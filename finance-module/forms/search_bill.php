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
			<div id="form_section1"> FILL THIS FORM BELOW TO SEARCH A BILL</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<label for="billdate">Bill Date:</label><br>
					<input type="date" id="billdate" name="bill_date" required placeholder="Insert Bill Date"><br>
					<label for="billtype">Bill Type:</label><br>
					<input type="text" id="billtype" name="bill_type" required placeholder="Select Bill Type"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SEARCH"></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#search").click(function(){
                $("#mod_display").load("forms/update_bill.php"); 
            });
		</script>
</body>
</html>