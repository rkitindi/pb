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
		$r_id = $_SESSION['RoleID'];
		
		// Include setup.php file
		include "../../scripts/sales_queries.php";
		
		// Create Objects
		$user_pos = new querySALES();
		$pcode_list = new querySALES();
		
		// Query Data from Database
		$posid = $user_pos->fetch_pos_id($e_id);
		$pcode = $pcode_list->fetch_accounting_dispatched_list($posid);
	}
	
	
	//Create object
	//$pcode_list = new querySALES();
	
	// Define variables and initialize with empty values
	//$posid = "";
	
	//if($_SERVER["REQUEST_METHOD"] == "POST"){	
	//	$posid = trim($_POST['posid'] ?? '');		
	//	$pcode = $pcode_list->fetch_accounting_dispatched_list($posid);	
	//}
	
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
			<div id="form_section1">SUPPLY PRODUCT DETAILS BELOW</div>
			<form id="prodform">
				<div id="form_section2">	
					<label for="dprod">Product Code</label><br>
					<select name="dprod">
						<option selected>Please Select from List</option>
							<?php foreach ($pcode as $key => $item): ?> 
								<?php $dref = $item['DispatchRefNum'];  $pcode = $item['ProductCode']; $disp = $item['Dispatched']; ?>	 
								<option value="<?php echo $dref; ?>">PCODE: <?php echo $pcode; ?> | DISPATCHED:  <?php echo $disp; ?> boxes </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="quantity">Quantity Received</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Select or Type"><br>
					<label for="drec">Date Received</label><br>
					<input type="date" id="drec" name="drec" required placeholder="Type or Select from list"><br>						
					<label for="received">Confirmation</label><br>
            		<input type="radio" id="received" name="received" value="Y"><label for="Y">Received</label>
            		<input type="radio" id="received" name="received" value="N"><label for="N">Not Received</label><br><br>
					<label for="comment">Comments</label><br>
					<input type="text" id="comment" name="comment" required placeholder="Explain why not received or why received less than dispatched"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	
        $("#btnSubmit").click(function(){
            $.post("scripts/insert_received_products.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>