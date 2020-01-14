<?php
	// Include setup.php file
	include "../../scripts/sales_queries.php";
	
	// read the product categories from the database
	$pos_list = new querySALES();
	$results = $pos_list->fetch_pos_list();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY POS DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="posid">Point of Sales</label><br>
					<select name="posid">
						<option selected>Please Select from List</option>
							<?php foreach ($results as $key => $item): ?> 
								<?php $posid = $item['POSId']; $posname = $item['POSName']; ?>	 
								<option value="<?php echo $posid; ?>"><?php echo $posname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("forms/products//receive_product.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>