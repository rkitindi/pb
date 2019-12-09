<?php
	// Include setup.php file
	include "../scripts/setup.php";
	
	// read the product categories from the database
	$returned_departmentlist = new setupHR();
	$returned_employmenttypelist = new setupHR();
	$departmentlist = $returned_departmentlist->fetch_department_list();
	$employmenttypelist = $returned_employmenttypelist->fetch_employmenttype_list();	
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
			<form id="motd-form">
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<input type="text" id="eid" name="eid" required placeholder="Employee ID (eg rk0001)" style="text-transform:uppercase" onkeypress="return AvoidSpace(event)" onkeydown="limit(this);" onkeyup="limit(this);"><br>
					<label for="fname">First names:</label><br>
					<input type="text" id="fname" name="fname" required placeholder="example (Ana Maria)"><br>
					<label for="lname">Last names:</label><br>
					<input type="text" id="lname" name="lname" required placeholder="example (Carlos Gonzalez)"><br>
					<label for="sdate">Start Date:</label><br>
					<input type="date" id="sdate" name="sdate" required placeholder="Select"><br>	
					<label for="deptname">Department name</label><br>
					<select name="deptname">
						<option selected>Please Select from List</option>
							<?php foreach ($departmentlist as $key => $item): ?> 
								<?php $deptid = $item['DepartmentId']; $deptname = $item['DepartmentName']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>					
					<label for="tittle">Position Tittle:</label><br>
					<input type="text" id="tittle" name="tittle" required placeholder="Type employee title"><br>
					<label for="gender">Gender:</label>
					<input type="radio" id="gender" name="gender" value="M"><label for="M">Male</label>
            		<input type="radio" id="gender" name="gender" value="F"><label for="F">Female</label><br>
					<label for="dob">Date of Birth:</label><br>
					<input type="date" id="dob" name="dob" required placeholder="Select DOB"><br>
					<label for="etype">Employement Type:</label><br>
					<select name="etype">
						<option selected>Please Select from List</option>
							<?php foreach ($employmenttypelist as $key => $item): ?> 
								<?php $deptid = $item['EmpTypeId']; $deptname = $item['EmploymentType']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
            $("#search").click(function(){
               	$.post("scripts/insert_personalinfo.php", $("#motd-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
			
			function limit(element){
				var max_chars = 6;
				if(element.value.length > max_chars) {
					element.value = element.value.substr(0, max_chars);
				}
			}
			
		</script>
		

</body>
</html>