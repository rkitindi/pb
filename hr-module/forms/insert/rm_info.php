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
		$managers = new setupHR();
		$employeelist = new setupHR();
		$rmlist = $managers->fetch_employee_list_manager();
		$list = $employeelist->fetch_employee_list_rm();
	
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE RM DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYEE DEPARTMENT DETAILS</div>
			<form id="rminfo-form">
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $deptid = $item['EmployeeId']; $deptname = $item['NAME']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="rmname">Reporting Manager Name</label><br>
					<select name="rmname" id="rmname">
						<option selected>Please Select from List</option>
							<?php foreach ($rmlist as $key => $item): ?> 
								<?php $rmid = $item['EmployeeId']; $rmname = $item['NAME']; ?>	 
								<option value="<?php echo $rmid; ?>"><?php echo $rmname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>	
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
		
			$(document).ready(function () {
		
				$("#submit-btn").click(function(){
					
					var employeeid = $("#eid").val();
					var rmid = $("#rmname").val();
					
					if (employeeid === 'Please Select from List') {
						alert("Please select Employee from the list and then proceed!");
						$('#eid').focus();
						return false;
					}else if (rmid === 'Please Select from List') {
						alert("Please select Employee Department from the list and then proceed!");
						$('#rmname').focus();
						return false;
					}else{					
					
						$.post("scripts/insert_emprminfo.php", $("#rminfo-form").serialize(), function(response) {
							$("#mod_display").html(response);
						});
						
					}					
					
					return false;
				});
			
			});
			
		</script>
		

</body>
</html>