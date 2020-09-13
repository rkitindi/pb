<?php
	// Include setup.php file
	include "../../scripts/production_setup.php";
	
	// read the product categories from the database
	$returned_supcat_list = new setupPRODUCTION();
	$results = $returned_supcat_list->fetch_supcat_list();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SUPPLIER DETAIÑS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO REGISTER SUPPLIER DETAILS</div>
			<form id="motd-form">
				<div id="form_section2">	
					<label for="sid">Supplier ID:</label><br>
					<input type="text" id="sid" name="sid" required placeholder="examples SUP001, SUP002" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)" onkeydown="limit(this);" onkeyup="limit(this);"><br>				
					<label for="bname">Business Name:</label><br>
					<input type="text" id="bname" name="bname" required placeholder="Type Business Name"><br>
					<label for="cname">Contact Name:</label><br>
					<input type="text" id="cname" name="cname" required placeholder="Type Name Contact Name"><br>
					<label for="address">Business Address:</label><br>
					<input type="text" id="address" name="address" required placeholder="Type Address"><br>
					<label for="email">Email:</label><br>
					<input type="text" id="email" name="email" required placeholder="Type email Address"><br>
					<label for="phone">Phone Number:</label><br>
					<input type="text" id="phone" name="phone" required placeholder="Type Phone Number"><br>
					<label for="supcat">Supply Category:</label><br>
					<select name="supcat">
						<option selected>Please Select from List</option>
							<?php foreach ($results as $key => $item): ?> 
								<?php $catid = $item['CategoryId']; $catname = $item['CategoryName']; ?>	 
								<option value="<?php echo $catid; ?>"><?php echo $catname; ?> </option>		  
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
               	$.post("scripts/insert_supplier_details.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
			
			function AvoidSpace(event) {
				var k = event ? event.which : window.event.keyCode;
				if (k == 32) return false;
			}
			
			function limit(element){
				var max_chars = 6;
				if(element.value.length > max_chars) {
					element.value = element.value.substr(0, max_chars);
				}
			}
			
		</script>
		

</body>
</html>