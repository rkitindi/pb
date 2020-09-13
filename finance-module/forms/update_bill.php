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
			<div id="form_section1"> VALIDATE OR CHANGE BILL DETAILS BELOW THEN UPDATE BUTTON</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<label for="sold">Receiving Date:</label><br>
					<input type="date" id="sold" name="sold" required placeholder="Confirm or change Date Bill was received"><br>
					<label for="billtyype">Bill Type:</label><br>
					<input type="text" id="billtype" name="bill_type" required placeholder="confirm or change bill type"><br>
					<label for="billamount">Bill Amount:</label><br>
					<input type="number" id="billamount" name="bill_amount" required placeholder="confirm or change bill amount"><br>
					<label for="billamount">Account number:</label><br>
					<input type="text" id="billamount" name="bill_amount" required placeholder="confirm or change bill amount"><br>
					<label for="dispatch">Confirm or change Bill Status</label><br>
            		<input type="radio" id="1" name="dispatch" value="1"><label for="1">Accepted</label>
            		<input type="radio" id="0" name="dispatch" value="0"><label for="0">Not Accepted</label><br><br>
					<label for="btransfer">POS ID:</label><br>
					<input type="text" id="btransfer" name="bank_transfer" required placeholder="Confirm or change POS ID"><br>
					<label for="btransfer">Upload NEW Bill if needed:</label><br>
					<input type="file" id="btransfer" name="bank_transfer" required placeholder="Validate Bank Transfer Receipts"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="UPDATE"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#search").click(function(){
                $("#mod_display").load("forms/receive_sale.php"); 
            });
		</script>
</body>
</html>