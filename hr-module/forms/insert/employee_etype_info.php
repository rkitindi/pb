<?php

	//Start Session
	session_start();
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Include setup.php file
		include "../../scripts/setup.php";
	
		// read the product categories from the database
		$returned_employeelist = new setupHR();
		$returned_employmenttypelist = new setupHR();
		$employeelist = $returned_employeelist->fetch_employee_list_etype();
		$employmenttypelist = $returned_employmenttypelist->fetch_employmenttype_list();
	
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD EMPLYEE DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYEE´S EMPLOYMENT TYPE</div>
			<form id="etype-form">
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($employeelist as $key => $item): ?> 
								<?php $empid = $item['EmployeeId']; $name = $item['NAME']; ?>	 
								<option value="<?php echo $empid; ?>"><?php echo $name; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<select name="etype" id="etype">
						<option selected>Please Select from List</option>
							<?php foreach ($employmenttypelist as $key => $item): ?> 
								<?php $deptid = $item['EmpTypeId']; $deptname = $item['EmploymentType']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
		
		$("#submit-btn").click(function(){
					
			var employeeid = $("#eid").val();
			var etype = $("#etype").val();
					
			if (employeeid === 'Please Select from List') {
				alert("Please select Employee from the list and then proceed!");
				$('#eid').focus();
				return false;
			}else if (etype === 'Please Select from List') {
				alert("Please select Employee Type from the list and then proceed!");
				$('#etype').focus();
				return false;
			}else{					
					
				$.post("scripts/insert_empetypinfo.php", $("#etype-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
						
			}					
					
			return false;
			
		});
			
	</script>
		

</body>
</html>