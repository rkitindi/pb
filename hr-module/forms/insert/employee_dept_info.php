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
		$returned_departmentlist = new setupHR();
		$employeelist = new setupHR();
		$departmentlist = $returned_departmentlist->fetch_department_list();
		$list = $employeelist->fetch_employee_list_dept();
	
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE DEPARTMENT DETAILS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">FILL THIS FORM BELOW TO ADD EMPLOYEE DEPARTMENT DETAILS</div>
			<form id="deptinfo-form" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $deptid = $item['EmployeeId']; $deptname = $item['NAME']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="deptname">Department name</label><br>
					<select name="deptname" id="deptname">
						<option selected>Please Select from List</option>
							<?php foreach ($departmentlist as $key => $item): ?> 
								<?php $deptid = $item['DepartmentId']; $deptname = $item['DepartmentName']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select><br>	
					<label for="tittle">Position Tittle:</label><br>
					<input type="text" id="tittle" name="tittle" required placeholder="Employee title"><br>
					<label for="rm">Reporting Manager</label><br>
					<select name="rm" id="rm"></select><br>	
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="submit-btn" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
		
			$(document).ready(function (){
				
				$("#eid").change(function(){	
					var employee_id = $("#eid").val();
					$("#deptname").change(function(){	
						var dept_id = $("#deptname").val();		
						var options = "";
						$.post("scripts/setup.php", {EID: employee_id, DID: dept_id}, function(response){		
						
							var results = response;	
							var myArray = JSON.parse(results);

							for(var i = -1; i < myArray.length; i++) { 
							
								if (i == -1){
									options += "<option selected>Please Select from List</option>";
								}else{									
									options += "<option value="+ myArray[i].EmployeeId+">"+ myArray[i].NAME +" | "+ myArray[i].PositionTitle +"</option>";
								}								
								
							} 
							document.getElementById("rm").innerHTML = options;
							
						});
						
					});
				});
				
				
				$("#submit-btn").click(function(){
					
					var employeeid = $("#eid").val();
					var deptid = $("#deptname").val();
					var tittle = $("#tittle").val();
					var rm = $("#rm").val();
					
					if (employeeid === 'Please Select from List') {
						alert("Please select Employee from the list and then proceed!");
						$('#eid').focus();
						return false;
					}else if (deptid === 'Please Select from List') {
						alert("Please select Employee Department from the list and then proceed!");
						$('#deptname').focus();
						return false;
					}else if(tittle==''){
						alert("Position Tittle cannot be empty!");
						$('#tittle').focus(); 
						return false;
					}else if (rm === 'Please Select from List') {
						alert("Please select RM from the list and then proceed!");
						$('#rm').focus();
						return false;
					}else{					
					
						$.post("scripts/insert_empdeptinfo.php", $("#deptinfo-form").serialize(), function(response) {
							$("#mod_display").html(response);
						});
						
					}					
					
					return false;
				});
			
			});
			
		</script>
		

</body>
</html>