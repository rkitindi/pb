<?php
	// Include setup.php file
	include "../../scripts/production_setup.php";
	
	// read the product categories from the database
	$returned_supdetail_list = new setupPRODUCTION();
	$results = $returned_supdetail_list ->fetch_truck_supplier_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TRUCK DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY TRUCK DETAILS BELOW</div>
			<form id="motd-form">
				<div id="form_section2">	
					<label for="treg">Registration Number:</label><br>
					<input type="text" id="treg" name="treg" required placeholder="Type TRUCK Registration Number" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)" onkeydown="limit(this);" onkeyup="limit(this);"><br>
					<label for="tmake">Make:</label><br>
					<input type="text" id="tmake" name="tmake" required placeholder="Example NISSAN, TOYOTA"><br>
					<label for="tmodel">Model:</label><br>
					<input type="text" id="tmodel" name="tmodel" required placeholder="Example XTRAIL"><br>
					<label for="tcap">Truck Capacity:</label><br>
					<input type="number" id="tcap" name="tcap" required placeholder="Select Truck Capacity (TONS)"><br>
					<label for="tdriver">Driver Full Name:</label><br>
					<input type="text" id="tdriver" name="tdriver" required placeholder="Type Truck Driver name"><br>
					<label for="tsup">Truck Supplier:</label><br>
					<select name="tsup">
						<option selected>Please Select from List</option>
							<?php foreach ($results as $key => $item): ?> 
								<?php $supid = $item['SupplierId']; $supname = $item['BusinessName']; ?>	 
								<option value="<?php echo $supid; ?>"><?php echo $supname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>					
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
            $("#search").click(function(){
               	$.post("scripts/insert_truck_details.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
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