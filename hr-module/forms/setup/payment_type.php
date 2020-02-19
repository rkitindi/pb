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
			<form id="ptype-form" novalidate>
				<div id="form_section2">				
					<label for="ptype">Payment Type</label><br>
					<input type="text" id="ptype" name="ptype" required placeholder="Examples CASH, CHECK, BANKTRANSFER, PAYPAL, OXXO" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="ptypedesc">Description:</label><br>
					<input type="text" id="ptypedesc" name="ptypedesc" required placeholder="Type payment type description"><br>
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
					
			var ptype = $("#ptype").val();
			
			if (ptype === '') {
				alert("Payment Type cannot be empty!");
				$('#ptype').focus();
				return false;
			}else{					
				
				$.post("scripts/setup.php", {ptype: ptype}, function(response){
					var results = response;	
					if(results == 1){
						alert("PAYMENT TYPE RECORD exists in database!");
						$('#ptype').focus(); 
						return false;
					}else {
						
						$.post("scripts/insert_paytype.php", $("#ptype-form").serialize(), function(response) {
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