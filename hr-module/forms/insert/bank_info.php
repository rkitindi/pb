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
		$employeelist = new setupHR();
		$list = $employeelist->fetch_employee_list_binfo();
	}	
	
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE BANK INFO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1"> SUPPLY EMPLOYEE BANK INFORMATION BELOW</div>
			<form id="bankinfo-form" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $empid = $item['EmployeeId']; $name = $item['NAME']; ?>	 
								<option value="<?php echo $empid; ?>"><?php echo $name; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="baname">Bank Name:</label><br>
					<input type="text" id="baname" name="baname" required placeholder="Speficy Ful Bank Name"><br>
					<label for="bacode">Bank Code:</label><br>
					<input type="text" id="bacode" name="bacode" required placeholder="Bank Code"><br>
					<label for="brname">Branch  Name:</label><br>
					<input type="text" id="brname" name="brname" required placeholder="Speficy Ful Branch Name"><br>
					<label for="brcode">Branch Code:</label><br>
					<input type="number" id="brcode" name="brcode" required placeholder="Branch Code Number"><br>
					<label for="acnum">Bank Acount Number:</label><br>
					<input type="number" id="acnum" name="acnum" required placeholder="Account Number"><br>
					<label for="clabe">CLABE:</label><br>
					<input type="number" id="clabe" name="clabe" required placeholder="CLABE"><br>
					<label for="actype">Account Type:</label><br>
					<input type="text" id="actype" name="actype" required placeholder="Account Type"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input type="submit" id="submit-btn" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>

	<script> 
		
		$("#submit-btn").click(function(){
					
			var employeeid = $("#eid").val();
			var baname = $("#baname").val();
			var brname = $("#brname").val();
			var bacode = $("#bacode").val();
			var brcode = $("#brcode").val();
			var acnum = $("#acnum").val();
			var clabe = $("#clabe").val();
			var actype = $("#actype").val();
			if (employeeid === 'Please Select from List'){
				alert("Please select Employee from the list and then proceed!");
				$('#eid').focus();
				return false;
			}else if (baname === ''){
				alert("Bank Name cannot be empty!");
				$('#baname').focus();
				return false;
			}else if (bacode === ''){
				alert("Bank Code cannot be empty!");
				$('#bacode').focus();
				return false;
			}else if (brname === ''){
				alert("Branch Name cannot be empty!");
				$('#brname').focus();
				return false;
			}else if (brcode === ''){
				alert("Branch Code Number cannot be empty!");
				$('#brcode').focus();
				return false;
			}else if (acnum === ''){
				alert("Account Number cannot be empty!");
				$('#acnum').focus();
				return false;
			}else if ( acnum.length !== 10 ){
				alert("Account Number must be 10 Digits!");
				$('#acnum').focus();
				return false;
			}else if (clabe === ''){
				alert("CLABE cannot be empty!");
				$('#clabe').focus();
				return false;
			}else if (clabe.length !== 18 ){
				alert("CLABE must be 18 Digits!");
				$('#clabe').focus();
				return false;
			}else if (actype === ''){
				alert("Account Type cannot be empty!");
				$('#actype').focus();
				return false;
			}else{					

				$.post("scripts/insert_bankInfo.php", $("#bankinfo-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});

			}	
			
			return false;
			
		});
		
	</script>
	
</body>
</html>