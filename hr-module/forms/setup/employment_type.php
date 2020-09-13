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
    <title>ADD EMPLOYMENT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYMENT</div>
			<form id="etype-form" novalidate>
				<div id="form_section2">				
					<label for="etype">Employment Type</label><br>
					<input type="text" id="etype" name="etype" required placeholder="Examples FULLTIME, PARTTIME, CONTRACTOR, CASUAL" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="etypedesc">Description:</label><br>
					<input type="text" id="etypedesc" name="etypedesc" required placeholder="Type role description"><br>
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
					
			var etype = $("#etype").val();
			
			if (etype === '') {
				alert("Employment Type cannot be empty!");
				$('#etype').focus();
				return false;
			}else{					
				
				$.post("scripts/setup.php", {ETYPE: etype}, function(response){
					var results = response;	
					if(results == 1){
						alert("EMPLOYMENT TYPE RECORD exists in database!");
						$('#etype').focus(); 
						return false;
					}else {
						
						$.post("scripts/insert_emptype.php", $("#etype-form").serialize(), function(response) {
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