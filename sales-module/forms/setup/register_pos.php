<?php
	// Include setup.php file
	include "../../scripts/sales_queries.php";
	
	// read the product categories from the database
	$employees_list = new querySALES();
	$results = $employees_list->fetch_employee_list();

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
					<label for="pid">POS ID:</label><br>
					<input type="number" id="pid" name="pid" required placeholder="example 27"><br>				
					<label for="pname">POS Name:</label><br>
					<input type="text" id="pname" name="pname" required placeholder="Type POS name example X-27"><br>
					<label for="eid">Sales Person´s Name</label><br>
					<select name="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($results as $key => $item): ?> 
								<?php $eid = $item['EmployeeId']; $ename = $item['NAME']; ?>	 
								<option value="<?php echo $eid; ?>"><?php echo $ename; ?> </option>		  
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
            $.post("scripts/insert__pos_details.php", $("#prodform").serialize(), function(response) {
				$("#mod_display").html(response);
			});
			return false;
        });
		
	</script>
		

</body>
</html>