<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SALES RECEIPTS OPERATIONS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CLICK APPROPIATE BUTTON TO PROCEED</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">	
					<input type="button" value="PRINT PREVIEW" id="sreceive"><br>
					<input type="button" value="EDIT RECEIPT" id="ereceive"><br>	
					<input type="button" value="DELETE RECEIPT" id="dreceive"><br>					
				</div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#sreceive").click(function(){
                $("#mod_display").load("forms/printing/search_receipt.php"); 
            });
			$("#ereceive").click(function(){
                $("#mod_display").load("forms/printing/edit_search_receipt.php"); 
            });
			$("#dreceive").click(function(){
                $("#mod_display").load("forms/printing/del_search_receipt.php"); 
            });
		</script>
</body>
</html>