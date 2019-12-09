<?php
	// Include setup.php file
	include "../../../prod-module/scripts/production_setup.php";
	
	// read the product categories from the database
	$truck_supplier_list = new setupPRODUCTION();
	$product_supplier_list = new setupPRODUCTION();
	$truck = $truck_supplier_list->fetch_truck_list();
	$supplier = $product_supplier_list->fetch_allproduct_supplier_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BATCH DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY BATCH DETAILS BELOW</div>
			<form id="batchform" enctype="multipart/form-data">
				<div id="form_section2">	
					<label for="cnum">Control Number:</label><br>
					<input type="number" id="cnum" name="cnum" required placeholder="ENTER BATCH CONTROL NUMBER" step="1" pattern="\d+" /><br>
					<label for="supid">Supplier ID:</label><br>
					<select name="supid">
						<option selected>Please Select from List</option>
							<?php foreach ($supplier as $key => $item): ?> 
								<?php $bid = $item['SupplierId']; $bname = $item['BusinessName']; ?>	 
								<option value="<?php echo $bid; ?>"><?php echo $bname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="truckid">Truck ID:</label><br>
					<select name="truckid">
						<option selected>Please Select from List</option>
							<?php foreach ($truck as $key => $item): ?> 
								<?php $tid = $item['RegNumber']; $supname = $item['BusinessName']; ?>	 
								<option value="<?php echo $tid; ?>"><?php echo $supname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>
					<label for="ddisp">Date Dispatched:</label><br>
					<input type="date" id="ddisp" name="ddisp" required placeholder="Select or Type"><br>
					<label for="darr">Date Arrived:</label><br>
					<input type="date" id="darr" name="darr" required placeholder="Select or Type"><br>
					<label for="fileToUpload">Upload Batch Document:</label><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					<input type="file" id="fileToUpload" name="fileToUpload" /><br>
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
				var form = $('#batchform')[0];

				// Create an FormData object 
				var data = new FormData(form);

				// disabled the submit button
				$("#btnSubmit").prop("disabled", true);

				$.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					url: "scripts/insert_batch_details.php",
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
		
		function AvoidSpace(event) {
			var k = event ? event.which : window.event.keyCode;
			if (k == 32) return false;
		}
			
		function limit(element){
			var max_chars = 8;
			if(element.value.length > max_chars) {
					element.value = element.value.substr(0, max_chars);
			}
		}		
		
	</script>
		

</body>
</html>