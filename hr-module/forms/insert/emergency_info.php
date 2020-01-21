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
		$list = $employeelist->fetch_employee_list_emergency();
	
	}
	
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD EMPLYEE EMERGENCY</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYEE EMERGENCY DETAILS</div>
			<form id="emerg-form" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $eid = $item['EmployeeId']; $ename = $item['NAME']; ?>	 
								<option value="<?php echo $eid; ?>"><?php echo $ename; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="fname">First names:</label><br>
						<input type="text" id="fname" name="fname" required placeholder="example (Ana Maria)"><br>
					<label for="lname">Last names:</label><br>
						<input type="text" id="lname" name="lname" required placeholder="example (Carlos Gonzalez)"><br>
					<label for="email">Email:</label><br>
						<input type="text" id="email" name="email" required placeholder="test@test.test"><br>
					<label for="phone">Phone:</label><br>
						<input type="number" id="phone" name="phone" required placeholder="10 digits phone number, example 5512345678"><br>	
					<label for="address">Contact Home Address:</label><br>
						<input type="text" id="address" name="address" required placeholder="Full address including county and zip code"><br>
					<label for="relate">Relationship:</label><br>
						<input type="radio" id="relate" name="relate" value="Parent"><label for="relate">Parent</label>
						<input type="radio" id="relate" name="relate" value="Child"><label for="relate">Child</label>
						<input type="radio" id="relate" name="relate" value="Sibling"><label for="relate">Sibling</label>
						<input type="radio" id="relate" name="relate" value="Friend"><label for="relate">Friend</label>
						<input type="radio" id="relate" name="relate" value="other"><label for="relate">other</label>
						<input type="text" id="others" name="others" required placeholder="If other please specify"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET"/> </div>
				</div>
			</form>
	</div>
	
		<script>
		
		$(document).ready(function () {
			$("#submit").click(function () {
				var employeeid = $("#eid").val();
				var firstname = $("#fname").val();
				var lastname = $("#lname").val();
				var emailaddress = $("#email").val();
				var phonenumber = $("#phone").val();
				var filter = /^\d*(?:\.\d{1,2})?$/;
				var address = $("#address").val();	
				var others = $("#others").val();
				var relationship = $("input[name='relate']:checked").val();
				
				if (employeeid === 'Please Select from List') {
					alert("Please select Employee from the list and then proceed!");
					$('#eid').focus();
					return false;
				}else if(firstname==''){
						alert("FIRST NAMES cannot be empty!");
						$('#fname').focus(); 
						return false;
				}else if(lastname==''){
						alert("LAST NAMES cannot be empty!");
						$('#lname').focus(); 
						return false;
				}else if( emailaddress!=='' && !isValidEmailAddress(emailaddress) ){ 
					alert("Email Address provided is invalid!");
					$('#email').focus(); 
					return false;				
				}else if(phonenumber==''){
					alert("Phone Number cannot be empty!");
					$('#phone').focus(); 
					return false;
				}else if(filter.test(phonenumber) && phonenumber.length !== 10){
					alert("10 digits Phone Number must be provided!");
					$('#phone').focus(); 
					return false;
				}else if(address==''){
					alert("Contact HOME Address cannot be empty!");
					$('#address').focus(); 
					return false;
				}else if($('input[name="relate"]:checked').length == 0){
					alert("RELATIONSHIP cannot be empty!");
					$('#relate').focus(); 
					return false;
		    	}else if((relationship=='other') && (others=='')){
						alert("Please specify Other!");
						$('#others').focus(); 
						return false;
		    	}else{
			
					$.post("scripts/insert_emergencyinfo.php", $("#emerg-form").serialize(), function(response){
						$("#mod_display").html(response);
					});
					
				} 
				return false;
			});
		});
		

		function isValidEmailAddress(emailAddress){
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		}
		
		</script>
		

</body>
</html>