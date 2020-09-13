<?php

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SEARCH RECEIPT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO SEARCH CUSTOMER</div>
			<form>
				<div id="form_section2">				
					<label for="SRN">Sales Receipt Number:</label><br>
					<input type="text" id="SRN" name="SRN" required placeholder="Search or Select from the list"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submitbtn" type="submit" name="insert" value="SEARCH"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
		<script> 
            $("#submitbtn").click(function(){
                $("#mod_display").load("forms/printing/sales_receipt.php"); 
            });
		</script>
</body>
</html>