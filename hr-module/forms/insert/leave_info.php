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
		$leavetyperecords = new setupHR();
		$employeelist = new setupHR();
		$leavetype = $leavetyperecords->fetch_leavetypes_list();
		$list = $employeelist->fetch_employee_list_leave();
	
	}	


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE LEAVE INFO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1"> FILL EMPLOYEE LEAVE INFO BELOW</div>
			<form id="leaveinfo-form" novalidate>
				<div id="form_section2">				
					<label for="eid">Employee ID</label><br>
					<select name="eid" id="eid">
						<option selected>Please Select from List</option>
							<?php foreach ($list as $key => $item): ?> 
								<?php $empid = $item['EmployeeId']; $name = $item['NAME']; ?>	 
								<option value="<?php echo $empid; ?>"><?php echo $name; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="ltype">Leave Type:</label><br>
					<select name="ltype" id="ltype">
						<option selected>Please Select from List</option>
							<?php foreach ($leavetype as $key => $item): ?> 
								<?php $ltid = $item['LeaveTypeId']; $ltype = $item['LeaveType']; ?>	 
								<option value="<?php echo $ltid; ?>"><?php echo $ltype; ?> </option>		  
							<?php endforeach; ?>
					</select>
					<label for="sdate">Start Date:</label><br>
					<input type="date" id="sdate" name="sdate" required placeholder="Select"><br>
					<label for="edate">End Date:</label><br>
					<input type="date" id="edate" name="edate" required placeholder="Select"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input type="submit" id="submit-btn" name="insert" value="SUBMIT" /></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>

	<script> 
		
		$("#submit-btn").click(function(){
					
			var employeeid = $("#eid").val();
			var ltype = $("#ltype").val();
			var sdate = $("#sdate").val();
			var edate = $("#edate").val();
			var CurrentDate = new Date();
			var today = formatDate(CurrentDate);
			if (employeeid === 'Please Select from List'){
				alert("Please select Employee from the list and then proceed!");
				$('#eid').focus();
				return false;
			}else if (ltype === 'Please Select from List'){
				alert("Please select Leave Type from the list and then proceed!");
				$('#ltype').focus();
				return false;
			}else if (sdate === ''){
				alert("Start Date cannot be empty!");
				$('#sdate').focus();
				return false;
			}else if (edate === ''){
				alert("End Date cannot be empty!");
				$('#edate').focus();
				return false;
			}else if (sdate > edate){
				alert("Start Date cannot be later than End Date!");
				$('#sdate').focus();
				return false;
			}else if(sdate < today){
				alert("Start DATE cannot be before TODAY!");
				$('#sdate').focus();
				return false;
			}else{					

				$.post("scripts/insert_leaveInfo.php", $("#leaveinfo-form").serialize(), function(response) {
					$("#mod_display").html(response);
				});

			}	
			
			return false;
			
		});

		function formatDate(CurrentDate){
			var d = new Date(CurrentDate),
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