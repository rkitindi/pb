<?php

	//Start Session
	session_start();
	
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
			
		// Include setup.php file
		include "../../../scripts/sales_queries.php";
		
		// Create Objects
		$user_pos = new querySALES();
		$pcode_list = new querySALES();
		
		// Query Data from Database
		$posid = $user_pos->fetch_pos_id($e_id);
		$pcode = $pcode_list->fetch_pcode_list($posid);
		
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DEFFECTIVE PRODUCT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
		<div id="form_section1" class="summary_eventType">SUPPLY DEFFECTIVE PRODUCT DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="prid">Product Code:</label><br>
					<select name="prid" id="prid" class="select">
						<option selected>Please Select from List</option>
							<?php foreach ($pcode as $key => $item): ?> 
								<?php $prid = $item['ProductReceiptId'];  $pcode = $item['ProductCode']; $stock = $item['Stock']; ?>	 
								<option value="<?php echo $prid; ?>">PCODE: <?php echo $pcode; ?> | STOCK:  <?php echo $stock; ?> boxes </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quantity">Quantity:</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Select or Type"><br><br>
					<label for="deff">CONFIRMATION: </label>
            		<input type="radio" id="deff" name="deff" value="Y"><label for="Y">Confirmed</label>
            		<input type="radio" id="deff" name="deff" value="N"><label for="N">Not Confirmed</label><br><br>
					<label for="comment">Comments:</label><br>
					<input type="text" id="comment" name="comment" required placeholder="Explain why not confirmed!"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>

	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert_deffective_products.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });

   	</script>

</body>
</html>