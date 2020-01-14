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
		include "../../scripts/sales_queries.php";
		
		// Create Objects
		$user_pos = new querySALES();
		$customer_debt_list = new querySALES();
		
		// Query Data from Database
		$posid = $user_pos->fetch_pos_id($e_id);
		$debtlist = $customer_debt_list->fetch_sales_ref_number($posid);
		
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COLLECT PAYMENTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
		<div id="form_section1" class="summary_eventType">SUPPLY PAYMENT DETAILS BELOW</div>
			<form id="payform" enctype="multipart/form-data">
				<div id="form_section2">	
					<label for="stid">Sales Receipt Number:</label><br>
					<select name="stid" id="stid" class="select">
						<option selected>Please Select from List</option>
							<?php foreach ($debtlist as $key => $item): ?> 
								<?php $srn = $item['SalesRef'];  $name = $item['ContactName']; ?>	 
								<option value="<?php echo $srn; ?>">SALES RECEIPT NUMBER:  <?php echo $srn; ?> | CUSTOMER NAME:  <?php echo $name; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="amount">Amount (MXN):</label><br>
					<input type="number" id="amount" name="amount" required placeholder="Confirm total amount to be paid" step="1" pattern="\d+"><br><br>
					<label for="paymet">Payment Method:  </label>
            		<input type="radio" id="paymet" name="paymet" value="cash"><label for="cash">CASH</label>
            		<input type="radio" id="paymet" name="paymet" value="check"><label for="check">CHECK</label>
					<input type="radio" id="paymet" name="paymet" value="transfer"><label for="transfer">BANK TRANSFER</label><br><br>
					<label for="paydate">Payment Date:</label><br>
					<input type="date" id="paydate" name="paydate" required placeholder="Select or Type"><br>
					<label for="fileToUpload">Upload Check or Bank Transfer Receipt:</label><br>
					<input type="file" id="fileToUpload" name="fileToUpload" required placeholder="Upload Product Image"><br>
					<label for="confirmed">Confirmation:   </label>
            		<input type="radio" id="confirmed" name="confirmed" value="Y"><label for="Y">FINISHED PAYMENT</label>
            		<input type="radio" id="confirmed" name="confirmed" value="N"><label for="N">NOT FINISHED</label><br><br>
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
	
		$(document).ready(function () {

			$("#btnSubmit").click(function (event) {

				//stop submit the form, we will post it manually.
				event.preventDefault();

				// Get form
				var form = $('#payform')[0];

				// Create an FormData object 
				var data = new FormData(form);

				// disabled the submit button
				$("#btnSubmit").prop("disabled", true);

				$.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					url: "scripts/insert_payment_details.php",
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					success: function (data){
						$("#mod_display").text(data);
						console.log("SUCCESS : ", data);
						$("#btnSubmit").prop("disabled", false);
					},
					error: function (e){
						$("#mod_display").text(e.responseText);
						console.log("ERROR : ", e);
						$("#btnSubmit").prop("disabled", false);
					}
				});
			});
		});
		
		$("#stid").change(function(){	
			var selectedSRN = $('#stid :selected').val();
			$.post("scripts/sales_queries.php", {SRN: selectedSRN}, function(response) {			
				var myVariable = response;
				$("#amount").attr("placeholder", myVariable);		
			});
		});

   	</script>

</body>
</html>