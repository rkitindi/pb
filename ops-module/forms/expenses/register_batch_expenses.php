<?php
	// Include setup.php file
	include "../../scripts/accounting_queries.php";
	
	// read the product categories from the database
	$control_number_list = new queryACCOUNTING();
	$controlnumber = $control_number_list->fetch_batchnumber_cycle_exp_list()
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BATCH EXPENSE DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY BATCH EXPENSES DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="cnum">Control Number:</label><br>
					<select name="cnum">
						<option selected>Please Select from List</option>
							<?php foreach ($controlnumber as $key => $item): ?> 
								<?php $cnum = $item['ControlNumber']; $cyc = $item['RangeCycle']; $pc = $item['ProductCount']; $rmng = $item['Remain'];   ?>	 
								<option value="<?php echo $cnum; ?>.<?php echo $cyc; ?>">CONTROL#: <?php echo $cnum; ?> | PRODUCT COUNT: <?php echo $pc; ?> | STOCK: <?php echo $rmng; ?> PRODUCTS</option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="fcost">Freight Cost:</label><br>
					<input type="number" id="fcost" name="fcost" required placeholder="Freight Cost (MXN)"><br>
					<label for="iva">Percentage IVA TAX (%):</label><br>
					<input type="number" id="iva" name="iva" required placeholder="Specify % of Freight Cost (exmaple 16%)"><br>
					<label for="riva">Percentage RET IVA TAX(%):</label><br>
					<input type="number" id="riva" name="riva" required placeholder="Specify % of Freight Cost (example 4%)"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert__batch_expense.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>