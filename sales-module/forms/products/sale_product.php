<?php

	//Start Session
	session_start();
	
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
			
		// Include setup.php file
		include "../../scripts/sales_queries.php";
		
		// Create Objects
		$user_pos = new querySALES();
		$pcode_list = new querySALES();
		$customer_list = new querySALES();
		
		// Query Data from Database
		$posid = $user_pos->fetch_pos_id($e_id);
		$pcode = $pcode_list->fetch_pcode_list($posid);
		$cname = $customer_list->fetch_customer_list();
		
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SALES RECEIVE PRODUCT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1" class="summary_eventType">SUPPLY PRODUCT DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="prid">Product Code</label><br>
					<select name="prid" id="prid" class="select">
						<option selected>Please Select from List</option>
							<?php foreach ($pcode as $key => $item): ?> 
								<?php $prid = $item['ProductReceiptId'];  $pcode = $item['ProductCode']; $stock = $item['Stock']; ?>	 
								<option value="<?php echo $prid; ?>">PCODE: <?php echo $pcode; ?> | STOCK:  <?php echo $stock; ?> boxes </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quantity">Sold Quantity</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Select or Type"><br>
					<label for="price">Selling Unit Price </label><br>
					<input type="number" id="price" name="price" required placeholder="Confirm Unit Price"><br>
					<label for="pmet">Payment Method:</label>
            		<input type="radio" id="cash" name="pmet" value="cash"><label for="cash">CASH</label>
            		<input type="radio" id="credit" name="pmet" value="credit"><label for="credit">CREDIT</label><br><br>
					<label for="cname">Customer Name</label><br>
					<select name="cname">
						<option selected>Please Select from List</option>
							<?php foreach ($cname as $key => $item): ?> 
								<?php $cid = $item['CustomerId'];  $cname = $item['BusinessName']; ?>	 
								<option value="<?php echo $cid; ?>"><?php echo $cname; ?></option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="sdate">Sales Date:</label><br>
					<input type="date" id="sdate" name="sdate" required placeholder="Please specify sales date"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert_sold_products.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		 	
		$("#prid").change(function(){	
			var selectedtext = $('#prid :selected').text();
			$.post("scripts/sales_queries.php", {name: selectedtext}, function(response) {			
				var myVariable = response;
				$("#price").attr("placeholder", myVariable);
			});
		});
			
			
   	</script>

</body>
</html>