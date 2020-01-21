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
    <title>ADD EMPLYEE DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYEE DETAILS</div>
			<form id="empdetails" enctype="multipart/form-data" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<input type="text" id="eid" name="eid" required placeholder="Employee ID (eg rk0001)" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)" onkeydown="limit(this);" onkeyup="limit(this);"><br>
					<label for="fname">First names</label><br>
					<input type="text" id="fname" name="fname" required placeholder="example (Ana Maria)"><br>
					<label for="lname">Last names:</label><br>
					<input type="text" id="lname" name="lname" required placeholder="example (Carlos Gonzalez)"><br>
					<label for="gender">Gender:</label>
					<input type="radio" id="gender" name="gender" value="M"><label for="M">Male</label>
            		<input type="radio" id="gender" name="gender" value="F"><label for="F">Female</label><br><br>
					<label for="dob">Date of Birth:</label><br>
					<input type="date" id="dob" name="dob" required placeholder="Select DOB"><br>
					<label for="sdate">Start Date:</label><br>
					<input type="date" id="sdate" name="sdate" required placeholder="Select"><br>	
					<label for="address">Employee Home Address:</label><br>
					<input type="text" id="address" name="address" required placeholder="Full address including county and zip code"><br>
				    <label for="fileToUpload">Upload EmployeeID Photo:</label><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					<input type="file" id="fileToUpload" name="fileToUpload" /><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="btnSubmit" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
		
			$(document).ready(function (){
				$("#btnSubmit").click(function (event){
					var employeeid = $("#eid").val();
					var firstname = $("#fname").val();
					var lastname = $("#lname").val();
					var gender = $("#gender").val();
					var dob = $("#dob").val();
					var start_date = $("#sdate").val();
					var address = $("#address").val();
					var CurrentDate = new Date();
					var CurrentFormattedDate = formatDate(CurrentDate);
					var birthDate = new Date(dob);
					var age = CurrentDate.getFullYear() - birthDate.getFullYear();
					if(employeeid=='') {
						alert("EMPLOYEE ID cannot be empty!");
						$('#eid').focus(); 
						return false;
					}else if(firstname=='') {
						alert("FIRST NAMES cannot be empty!");
						$('#fname').focus(); 
						return false;
					}else if(lastname=='') {
						alert("LAST NAMES cannot be empty!");
						$('#lname').focus(); 
						return false;
					}else if($('input[name="gender"]:checked').length == 0){
						alert("GENDER cannot be empty!");
						$('#gender').focus(); 
						return false;
					}else if(dob==''){
						alert("DATE OF BIRTH CANNOT BE EMPTY!");
						$('#dob').focus();
						return false;
					}else if(dob > CurrentFormattedDate){
						alert("Date of Birth cannot be later than TODAY!");
						$('#dob').focus();
						return false;
					}else if(age < 15){
						alert("Employee is too young!");
						$('#dob').focus();
						return false;
					}else if(age > 65){
						alert("Employee is too old!");
						$('#dob').focus();
						return false;
					}else if(start_date==''){
						alert("Please enter a START DATE!");
						$('#sdate').focus();
						return false;
					}else if(start_date > CurrentFormattedDate){
						alert("Start DATE cannot be later than TODAY!");
						$('#sdate').focus();
						return false;
					}else if(address=='') {
						alert("HOME Address cannot be empty!");
						$('#address').focus(); 
						return false;
					}else{

						//stop submit the form, we will post it manually.
						event.preventDefault();

						// Get form
						var form = $('#empdetails')[0];

						// Create an FormData object 
						var data = new FormData(form);

						// disabled the submit button
						$("#btnSubmit").prop("disabled", true);

						$.ajax({
							type: "POST",
							enctype: 'multipart/form-data',
							url: "scripts/insert_personalinfo.php",
							data: data,
							processData: false,
							contentType: false,
							cache: false,
							timeout: 600000,
							success: function (data){
								$("#mod_display").text(data);
								console.log("SUCCESS : ", data);
								$("#btnSubmit").prop("disabled", false);
							},
							error: function (e){
								$("#mod_display").text(e.responseText);
								console.log("ERROR : ", e);
								$("#btnSubmit").prop("disabled", false);
							}
						});							
								
					}				

				}
			});
		
			function limit(element){
				var max_chars = 6;
				if(element.value.length > max_chars) {
					element.value = element.value.substr(0, max_chars);
				}
			}
			
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