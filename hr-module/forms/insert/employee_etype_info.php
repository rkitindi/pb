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
		$returned_employmenttypelist = new setupHR();
		$departmentlist = $returned_departmentlist->fetch_department_list();
		$employmenttypelist = $returned_employmenttypelist->fetch_employmenttype_list();
	
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
			<form id="motd-form">
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($employmenttypelist as $key => $item): ?> 
								<?php $deptid = $item['EmpTypeId']; $deptname = $item['EmploymentType']; ?>	 
								<option value="<?php echo $deptid; ?>"><?php echo $deptname; ?> </option>		  
							<?php endforeach; ?>
					</select>
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
               	$.post("scripts/insert_empetypinfo.php", $("#motd-form").serialize(), function(response) {
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