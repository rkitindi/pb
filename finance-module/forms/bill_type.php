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
					<input type="button" value="RECEIVE WATER BILL" id="water"><br>
					<input type="button" value="RECEIVE PHONE BILL" id="phone"><br>
					<input type="button" value="RECEIVE ELECTRICITY BILL" id="electricity"><br>
					<input type="button" value="RECEIVE TRACK INVOICE" id="track"><br>
					<input type="button" value="RECEIVE CASES INVOICE" id="boxes"><br>
					<input type="button" value="RECEIVE BANANA FRUITS INVOICE" id="banana"><br>
					<input type="button" value="RECEIVE TAX INVOICE" id="tax">
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#water").click(function(){
                $("#mod_display").load("forms/receive_water_bill.php"); 
            });
			$("#phone").click(function(){
                $("#mod_display").load("forms/receive_phone_bill.php"); 
            });
			$("#electricity").click(function(){
                $("#mod_display").load("forms/receive_electricity_bill.php"); 
            });
			$("#track").click(function(){
                $("#mod_display").load("forms/receive_track_invoice.php"); 
            });
			$("#boxes").click(function(){
                $("#mod_display").load("forms/receive_boxes_invoice.php"); 
            });
			$("#banana").click(function(){
                $("#mod_display").load("forms/receive_banana_invoice.php"); 
            });
			$("#tax").click(function(){
                $("#mod_display").load("forms/receive_tax_invoice.php"); 
            });
		</script>
</body>
</html>