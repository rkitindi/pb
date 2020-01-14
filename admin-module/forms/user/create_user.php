<?php
	// Include setup.php file
	include "../../scripts/admin_queries.php";
	
	// read the product categories from the database
	$employees_list = new queryADMIN();
	$role_list = new queryADMIN();
	$employees = $employees_list->fetch_employee_list();
    $roles = $role_list->fetch_role_list();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CREATE USER</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>

	<div id="form_wrapper">
			<div id="form_section1">SUPPLY USER LOGIN DETAILS BELOW</div>
			<form id="role-form">
				<div id="form_section2">	
					<label for="eid">Employment Name:</label><br>
					<select name="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($employees as $key => $item): ?> 
								<?php $eid = $item['EmployeeId']; $ename = $item['NAME']; ?>	 
								<option value="<?php echo $eid; ?>"><?php echo $ename; ?></option>		  
							<?php endforeach; ?>
					</select><br>
				    <label for="rid">Role Name:</label><br>				
					<select name="rid">
						<option selected>Please Select from List</option>
							<?php foreach ($roles as $key => $item): ?> 
								<?php $rid = $item['RoleID']; $rname = $item['RoleName']; ?>	 
								<option value="<?php echo $rid; ?>"><?php echo $rname; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="password">Password:</label><br>
					<input type="password" id="password" name="password" required placeholder="Type your password"><br>
					<label for="cpassword">Confirm Password:</label><br>
					<input type="password" id="cpassword" name="cpassword" required placeholder="Verify your password"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="search" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
	
		<script> 
            $("#search").click(function(){
               	$.post("scripts/insert_user.php", $("#role-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});
			return false;
            });
		</script>		

</body>
</html>