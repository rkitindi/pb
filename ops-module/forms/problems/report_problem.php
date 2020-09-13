<?php

//Start Session
session_start();
	
if(!isset($_SESSION)){
	
	// Redirect user to index page	
	echo "<script> location.href='../../frontend/index.html'; </script>";
	exit;
		
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REPORT PROBLEMS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">DESCRIBE PROBLEM YOU ARE EXPERIENCING BELOW</div>
			<form id="problem-form" onsubmit="return validateForm()">
				<div id="form_section2">	
					<label for="pdesc">Please provide as much detail as possible so we can better identify the problem. What is the exact error message that you received?</label><br>
					<textarea id="pdesc" name="pdesc"></textarea><br><br>
					<span class="error">This field is required</span>
					<label for="repodate">When (date) did the problem occur?</label><br>
					<input type="date" id="repodate" name="repodate" required placeholder="Type/Select Date problem occured"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET"></div> 
				</div>
			</form>
	</div>
	
		<script> 
		
		$(document).ready(function(){
			$("#submit-btn").click(function(){
				var textarea_value = $("#pdesc").val();
				var reportdate = $("#repodate").val();
				var CurrentDate = new Date();
				var CurrentFormattedDate = formatDate(CurrentDate);
				if(textarea_value=='') {
					alert("Please describe a problem in Textarea!");
					$('#pdesc').focus(); 
					return false;
				}else if(reportdate==''){
					alert("Report Date cannot be empty!");
					$('#repodate').focus();
					return false;
				}else if(reportdate > CurrentFormattedDate){
					alert("Report date cannot be greater than the current date!");
					$('#repodate').focus();
					return false;
				}else{
					$.post("scripts/insert_reported_problem.php", $("#problem-form").serialize(), function(response) {
						$("#mod_display").html(response);
					});
					return false;
				}
            });
		});
		
		function formatDate(date){
			var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();
			if (month.length < 2) 
			month = '0' + month;
			if (day.length < 2) 
				day = '0' + day;
			return [year, month, day].join('-');
		}
		
		</script>
		

</body>
</html>