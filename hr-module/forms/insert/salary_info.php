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
		$paymentschedule = new setupHR();
		$employeelist = new setupHR();
		$payschedule = $paymentschedule->fetch_payschedule_list();
		$list = $employeelist->fetch_employee_list_sal();
	
	}	

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE SALARY INFO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1"> FILL THIS FORM BELOW TO CREATE EMPLOYEE SALARY INFORMATION</div>
			<form id="salinfo-form" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $empid = $item['EmployeeId']; $name = $item['NAME']; ?>	 
								<option value="<?php echo $empid; ?>"><?php echo $name; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<select name="pschedule" id="pschedule">
						<option selected>Please Select from List</option>
							<?php foreach ($payschedule as $key => $item): ?> 
								<?php $sid = $item['PayScheduleId']; $sdesc = $item['PaymentSchedule']; ?>	 
								<option value="<?php echo $sid; ?>"><?php echo $sdesc; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="bsalary">Base Salary:</label><br>
					<input type="number" id="bsalary" name="bsalary" required placeholder="Amount (MXN)"><br>
					<label for="ssec">Social Security:</label><br>
					<input type="number" id="ssec" name="ssec" required placeholder="Amount (MXN)"><br>
					<label for="stax">State Tax:</label><br>
					<input type="number" id="stax" name="stax" required placeholder="Amount (MXN)"><br>
					<label for="ftax">Federal Tax:</label><br>
					<input type="number" id="ftax" name="ftax" required placeholder="Amount (MXN)"><br>
					<label for="income">Net Income:</label><br>
					<input type="number" id="income" name="income" required placeholder="Amount (MXN)"><br>
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
			var schedule = $("#pschedule").val();
			var bsalary = $("#bsalary").val();
			var ssec = $("#ssec").val();
			var stax = $("#stax").val();
			var ftax = $("#ftax").val();
			var income = $("#income").val();
					
			if (employeeid === 'Please Select from List') {
				alert("Please select Employee from the list and then proceed!");
				$('#eid').focus();
				return false;
			}else if (schedule === 'Please Select from List') {
				alert("Please select Employee Type from the list and then proceed!");
				$('#pschedule').focus();
				return false;
			}else if (bsalary === '') {
				alert("Base Salary cannot be empty!");
				$('#bsalary').focus();
				return false;
			}else if (ssec === '') {
				alert("Social Security Contribution cannot be empty!");
				$('#ssec').focus();
				return false;
			}else if (stax === '') {
				alert("State Tax cannot be empty!");
				$('#stax').focus();
				return false;
			}else if (ftax === '') {
				alert("Federal Tax cannot be empty!");
				$('#ftax').focus();
				return false;
			}else if (income === '') {
				alert("NET INCOME cannot be empty!");
				$('#income').focus();
				return false;
			}else{					
					
				$.post("scripts/insert_empsalinfo.php", $("#salinfo-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
						
			}					
					
			return false;
			
		});
			
	</script>
	
	
	
	
</body>
</html>