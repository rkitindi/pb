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
    <title>ADD DEPARTMENT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD DEPARTMENT</div>
			<form id="dept-form" novalidate>
				<div id="form_section2">				
					<label for="deptname">Department name</label><br>
					<input type="text" id="deptname" name="deptname" required placeholder="examples HR, FINANCE, ADMINSTRATION, ACCOUNTING, SALES, PRODUCTION" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)"><br>
					<label for="deptdesc">Description:</label><br>
					<input type="text" id="deptdesc" name="deptdesc" required placeholder="Type Department description"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
	<script> 
	

		function AvoidSpace(event) {
			var k = event ? event.which : window.event.keyCode;
			if (k == 32) return false;
		}
		
		$("#submit-btn").click(function(){
		
			var deptname = $("#deptname").val();
			
			if (deptname === '') {
				alert("DEPARTMENT cannot be empty!");
				$('#deptname').focus();
				return false;
			}else{					
				
				$.post("scripts/setup.php", {deptname: deptname}, function(response){
					var results = response;	
					if(results == 1){
						alert("DEPARTMENT RECORD exists in database!");
						$('#deptname').focus(); 
						return false;
					}else {
						
						$.post("scripts/insert_department.php", $("#dept-form").serialize(), function(response) {
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