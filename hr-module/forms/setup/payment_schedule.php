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
    <title>ADD PAYMENT TYPE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD PAYMENT TYPE</div>
			<form id="pschedule-form" novalidate>
				<div id="form_section2">				
					<label for="payschedule">Payment Schedule</label><br>
					<input type="text" id="payschedule" name="payschedule" required placeholder="exmaples HOURLY, DAILY, WEEKLY, BIWEEKLY, MONTHLY" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="paydesc">Description:</label><br>
					<input type="text" id="paydesc" name="paydesc" required placeholder="Type payment schedule description"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /> </div>
				</div>
			</form>
	</div>
	
	<script> 
	
		
		function AvoidSpace(event) {
			var k = event ? event.which : window.event.keyCode;
			if (k == 32) return false;
		}
		
		$("#submit-btn").click(function(){
		
			var payschedule = $("#payschedule").val();
			
			if (payschedule === '') {
				alert("Payment Type cannot be empty!");
				$('#payschedule').focus();
				return false;
			}else{					
				
				$.post("scripts/setup.php", {payschedule: payschedule}, function(response){
					var results = response;	
					if(results == 1){
						alert("PAYMENT TYPE RECORD exists in database!");
						$('#payschedule').focus(); 
						return false;
					}else {
						
						$.post("scripts/insert_payschedule.php", $("#pschedule-form").serialize(), function(response) {
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