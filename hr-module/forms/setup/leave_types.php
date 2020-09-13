<?php

	//Start Session
	session_start();
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;
		
	}
	
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD LEAVE TYPE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD LEAVE TYPE</div>
			<form id="ltype-form" novalidate>
				<div id="form_section2">				
					<label for="lvtype">Leave Type</label><br>
					<input type="text" id="lvtype" name="lvtype" required placeholder="examples SICK, MATERNITY, PATERNITY, ANNUAL, STUDY, EMERGENCY" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="paysstatus">Payment Status</label><br>
					<input type="text" id="paysstatus" name="paysstatus" required placeholder="examples PAID, UNPAID" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="leavedesc">Description:</label><br>
					<input type="text" id="leavedesc" name="leavedesc" required placeholder="Type leave type description"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 
	

		function AvoidSpace(event) {
			var k = event ? event.which : window.event.keyCode;
			if (k == 32) return false;
		}

		$("#submit-btn").click(function(){
		
			var lvtype = $("#lvtype").val();
			var paysstatus = $("#paysstatus").val();
			
			if (lvtype === '') {
				alert("LEAVE Type cannot be empty!");
				$('#lvtype').focus();
				return false;
			}else if (paysstatus === '') {
				alert("PAYMENT Status cannot be empty!");
				$('#paysstatus').focus();
				return false;
			}else{					
				
				$.post("scripts/setup.php", {lvtype: lvtype}, function(response){
					var results = response;	
					if(results == 1){
						alert("LEAVE TYPE RECORD exists in database!");
						$('#lvtype').focus(); 
						return false;
					}else {
						
						$.post("scripts/insert_leavetype.php", $("#ltype-form").serialize(), function(response) {
							$("#mod_display").html(response);
						});						
						
					}
					
				});	

			
			}					
	
			return false;
			
		});
		
			
	</script>
		

</body>
</html>