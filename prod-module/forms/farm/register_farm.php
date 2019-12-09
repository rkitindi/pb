<?php
	// Include setup.php file
	include "../../scripts/production_setup.php";
	
	// read the product categories from the database
	$returned_supdetail_list = new setupPRODUCTION();
	$results = $returned_supdetail_list ->fetch_banana_farmer_supplier_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FARM DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY FARM DETAILS BELOW</div>
			<form id="motd-form">
				<div id="form_section2">	
					<label for="fname">Farm Name:</label><br>
					<input type="text" id="fname" name="fname" required placeholder="Type Farm Name"><br>
					<label for="fsize">Farm Size (Hectres):</label><br>
					<input type="number" id="fsize" name="fsize" required placeholder="Select Farm Size"><br>
					<label for="bname">Business Name:</label><br>
					<select name="bname">
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
               	$.post("scripts/insert_farm_details.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
			
		
		</script>
		

</body>
</html>