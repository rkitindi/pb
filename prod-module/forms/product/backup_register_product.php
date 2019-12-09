<?php
	// Include setup.php file
	include "../../scripts/production_setup.php";
	
	// read the product categories from the database
	$returned_supdetail_list = new setupPRODUCTION();
	$returned_quality_list = new setupPRODUCTION();
	$returned_quality_list = new setupPRODUCTION();
	$supdet = $returned_supdetail_list ->fetch_truck_supplier_list();
	$qualdet = $returned_quality_list ->fetch_quality_list();
	$branddet = $returned_quality_list ->fetch_product_brand_list();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRODUCT DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY PRODUCT DETAILS BELOW</div>
			<form id="prodform" enctype="multipart/form-data">
				<div id="form_section2">	
					<label for="pcode">Product Code:</label><br>
					<input type="text" id="pcode" name="pcode" required placeholder="EXANMPLE PROD001" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)" onkeydown="limit(this);" onkeyup="limit(this);"><br>
					<label for="bname">Brand Name:</label><br>
					<select name="bname">
						<option selected>Please Select from List</option>
							<?php foreach ($branddet as $key => $item): ?> 
								<?php $bid = $item['BrandId']; $bname = $item['BrandName']; ?>	 
								<option value="<?php echo $bid; ?>"><?php echo $bname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quality">Quality:</label><br>
					<select name="quality">
						<option selected>Please Select from List</option>
							<?php foreach ($qualdet as $key => $item): ?> 
								<?php $supid = $item['QualityId']; $supname = $item['QualityName']; ?>	 
								<option value="<?php echo $supid; ?>"><?php echo $supname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="fileToUpload">Product Photo:</label><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
					<input type="file" id="fileToUpload" name="fileToUpload"><br>
					<label for="sprice">Selling Price:</label><br>
					<input type="number" id="sprice" name="sprice" required placeholder="PRICE (MXN)"><br>
					<label for="psup">Product Supplier:</label><br>
					<select name="psup">
						<option selected>Please Select from List</option>
							<?php foreach ($supdet as $key => $item): ?> 
								<?php $supid = $item['SupplierId']; $supname = $item['BusinessName']; ?>	 
								<option value="<?php echo $supid; ?>"><?php echo $supname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>					
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET"></div>
				</div>
			</form>
	</div>
	
		<script> 
		
            $("#search").click(function(){
               	$.post("scripts/insert_product_details.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
			
			function AvoidSpace(event) {
				var k = event ? event.which : window.event.keyCode;
				if (k == 32) return false;
			}
			
			function limit(element){
				var max_chars = 7;
				if(element.value.length > max_chars) {
					element.value = element.value.substr(0, max_chars);
				}
			}
		
		</script>
		

</body>
</html>