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
					<input type="button" value="BILL ACCOUNT NUMBERS" id="bac"><br>
					<input type="button" value="BILL PAYMENTS" id="bp"><br>				
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#bac").click(function(){
                $("#mod_display").load("forms/expenses/bill_account_num_ops.html"); 
            });
			$("#bp").click(function(){
                $("#mod_display").load("forms/expenses/bill_payments.html"); 
            });
		</script>
</body>
</html>