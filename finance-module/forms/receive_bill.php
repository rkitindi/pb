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
			<div id="form_section1">INSERT BILL DETAILS INTO THE SYSTEM CLICK SUBMIT BUTTON</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">				
					<label for="sold">Date Received:</label>
					<input type="date" id="sold" name="sold" required placeholder="Date Bill was received"><br>
					<label for="cash">Bill Type:</label><br>
					<input type="text" id="cash" name="paid_cash" required placeholder="What is this bill for"><br>
					<label for="cash">Account Number:</label><br>
					<input type="text" id="cash" name="paid_cash" required placeholder="What is this bill for"><br>
					<label for="cheque">Bill Amount:</label><br>
					<input type="number" id="cheque" name="paid_cheque" required placeholder="How much is it"><br>
					<label for="btransfer">Upload Bill:</label><br>
					<input type="file" id="btransfer" name="bank_transfer" required placeholder="Validate Bank Transfer Receipts"><br>
					<label for="dispatch">Bill ACCEPTED or NOT ACCEPTED?</label><br>
            		<input type="radio" id="1" name="dispatch" value="1"><label for="1">Accepted</label>
            		<input type="radio" id="0" name="dispatch" value="0"><label for="0">Not Accepted</label><br>
					<label for="pos">Comment if NOT ACCEPTED</label><br>
					<input type="text" id="pos" name="pos-id" required placeholder="Specify reasons for not accepting"><br>
					<label for="btransfer">POS ID:</label><br>
					<input type="text" id="btransfer" name="bank_transfer" required placeholder="This bill is for which POS"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
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