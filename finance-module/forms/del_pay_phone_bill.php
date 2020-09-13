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
			<div id="form_section1">CONFIRM PHONE BILL PAYMENT DETAILS THEN CLICK DELETE BUTTON</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<label for="sold">Date Received:</label><br>
					<input type="date" id="sold" name="sold" required placeholder="Date Bill was received"><br>
					<label for="anumber">Phone Number:</label><br>
					<input type="text" id="anumber" name="acount_number" required placeholder="Select Account number"><br>
					<label for="amount">Bill Amount:</label><br>
					<input type="number" id="amount" name="bill_amount" required placeholder="How much is it"><br>
					<label for="btransfer">Download Actual Bill:</label><br>
					<input type="text" id="btransfer" name="bank_transfer" required placeholder="Validate Bank Transfer Receipts"><br>
					<label for="bill">Bill PAID or NOT PAID?</label><br>
            		<input type="radio" id="1" name="bill" value="1"><label for="1">Paid</label>
            		<input type="radio" id="0" name="bill" value="0"><label for="0">Not Paid</label><br><br>
					<label for="pos">Comment if NOT PAID</label><br>
					<input type="text" id="pos" name="pos-id" required placeholder="Specify reasons for not PAYING"><br>
					<label for="btransfer">POS ID:</label><br>
					<input type="text" id="btransfer" name="bank_transfer" required placeholder="This bill is for which POS"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input type="submit" name="insert" value="DELETE"></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
</body>
</html>