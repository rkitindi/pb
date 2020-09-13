<?php
	// Include setup.php file
	include "../../../prod-module/scripts/production_setup.php";
	
	// read the product categories from the database
	$product_code_list = new setupPRODUCTION();
	$farm_name_list = new setupPRODUCTION();
	$case_name_list = new setupPRODUCTION();
	$prodcode = $product_code_list->fetch_product_code_list();
	$farmname = $farm_name_list->fetch_farmname_list();
	$cases = $case_name_list->fetch_casename_list();
	
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
			<form id="prodform">
				<div id="form_section2">	
					<label for="pcode">Product Code:</label><br>
					<select name="pcode">
						<option selected>Please Select from List</option>
							<?php foreach ($prodcode as $key => $item): ?> 
								<?php $pcode = $item['ProductCode']; $ppcode = $item['ProductCode']; ?>	 
								<option value="<?php echo $pcode; ?>"><?php echo $ppcode; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="cnum">Control Number:</label><br>
					<input type="number" id="cnum" name="cnum" required placeholder="ENTER BATCH CONTROL NUMBER" step="1" pattern="\d+" /><br>
					<label for="cynum">Cycle Number:</label><br>
					<input type="number" id="cynum" name="cynum" required placeholder="ENTER CYCLE NUMBER" step="1" pattern="\d+" /><br>
					<label for="fname">Farm Name:</label><br>
					<select name="fname">
						<option selected>Please Select from List</option>
							<?php foreach ($farmname as $key => $item): ?> 
								<?php $fid = $item['FarmId']; $fname = $item['FarmName']; ?>	 
								<option value="<?php echo $fid; ?>"><?php echo $fname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quantity">Quantity</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Specify Quantity  in Boxes" step="1" pattern="\d+"/><br>
					<label for="cid">Banana Case:</label><br>
					<select name="cid">
						<option selected>Please Select from List</option>
							<?php foreach ($cases as $key => $item): ?> 
								<?php $ccode = $item['CaseCode']; $cname = $item['CaseName']; ?>	 
								<option value="<?php echo $ccode; ?>"><?php echo $cname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="darr">Date Received:</label><br>
					<input type="date" id="darr" name="darr" required placeholder="Select or Type"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert__product_receipt.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>