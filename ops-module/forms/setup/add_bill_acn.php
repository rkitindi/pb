<?php
	// Include setup.php file
	//include "../../scripts/production_setup.php";
	
	// read the product categories from the database
	//$returned_supdetail_list = new setupPRODUCTION();
	//$results = $returned_supdetail_list ->fetch_banana_farmer_supplier_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BILL ACCOUNT NUMBER</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY BILL ACCOUNT NUMBER DETAILS BELOW</div>
			<form id="motd-form">
				<div id="form_section2">	
					<label for="act">Account type:</label><br>
					<input type="text" id="act" name="ac_tyoe" required placeholder="example ELECTRICITY, WATER, PHONE"><br>
					<label for="acname">Account Name:</label><br>
					<input type="text" id="acname" name="acname" required placeholder="Account name as shouwn on BILL"><br>
					<label for="acnum">Account number or Service Number:</label><br>
					<input type="number" id="acnum" name="acnum" required placeholder="Account number as shown on the Bill"><br>
					<label for="posid">POS ID:</label><br>
					<select name="posid">
						<option selected>Please Select from List</option>
							<?php foreach ($results as $key => $item): ?> 
								<?php $supid = $item['SupplierId']; $supname = $item['BusinessName']; ?>	 
								<option value="<?php echo $supid; ?>"><?php echo $supname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>					
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
            $("#search").click(function(){
               	$.post("scripts/insert_bill_acn.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
			
		
		</script>
		

</body>
</html>