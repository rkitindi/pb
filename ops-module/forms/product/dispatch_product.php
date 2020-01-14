<?php
	// Include setup.php file
	include "../../scripts/accounting_queries.php";
	
	// read the product categories from the database
	$product_rn_list = new queryACCOUNTING();
	$point_sale_list = new queryACCOUNTING();

	$receiptnumber = $product_rn_list->fetch_product_receiptnumber_list();
	$pos = $point_sale_list->fetch_pointofsale_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRODUCT DISPATCH</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY PRODUCT DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="prrn">Product Code and Control Number:</label><br>
					<select name="prrn">
						<option selected>Please Select from List</option>
							<?php foreach ($receiptnumber as $key => $item): ?> 
								<?php $receiptn = $item['ProductReceiptNumber']; $pcode = $item['ProductCode']; $cnum = $item['ControlNumber']; $stock = $item['Stock']; ?>	 
								<option value="<?php echo $receiptn; ?>">PCODE: <?php echo $pcode; ?> | C-NUMBER: <?php echo $cnum; ?> | STOCK: <?php echo $stock; ?>  boxes</option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="pos">Point of Sale</label><br>
					<select name="pos">
						<option selected>Please Select from List</option>
							<?php foreach ($pos as $key => $item): ?> 
								<?php $posid = $item['POSId']; $posname = $item['POSName']; ?>	 
								<option value="<?php echo $posid; ?>"><?php echo $posname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quantity">Quantity</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Specify Quantity  in Boxes" step="1" pattern="\d+"/><br>
					<label for="ddisp">Dispatch Date</label><br>
					<input type="date" id="ddisp" name="ddisp" required placeholder="Type or Select from list"><br>
					<label for="dispatch">Confirmation:  </label>
            		<input type="radio" id="dispatch" name="dispatch" value="Y"><label for="dispatch">Dispatched</label>
            		<input type="radio" id="dispatch" name="dispatch" value="N"><label for="dispatch">Not Dispatched</label><br><br>
					<label for="comm">Comments if not dispatched</label><br>
					<input type="text" id="comm" name="comm" required placeholder="Specify comments if not dispatched"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert__product_dispatch.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>