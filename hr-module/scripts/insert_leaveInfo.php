<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$ltype = "";
	$sdate = "";
	$edate = "";
	$stax = "";
	
	class employeeLeaveInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employee_details($eid,$ltype,$sdate,$edate){
			$query = $this->link->prepare("INSERT INTO pb_db.leaveinfo_hr (EmployeeId, LeaveTypeId, StartDate, EndDate) VALUES (?,?,?,?)");
			$values = array($eid,$ltype,$sdate,$edate);
			$query->execute($values);
		}	

	}


	$action = new employeeLeaveInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$ltype = trim($_POST['ltype'] ?? '');
		$sdate = trim($_POST['sdate'] ?? '');
		$edate = trim($_POST['edate'] ?? '');
	 
		echo $action->insert_employee_details($eid,$ltype,$sdate,$edate);	
		echo "Employee Leave Info Inserted Successfully!!";
		
	}		


?>