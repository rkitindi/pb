<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$eid = "";
	$deptname = "";
	$tittle = "";
	$rm = "";
	
	class employeedeptInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employeedeptinfo_details($eid,$deptname,$tittle,$rm){
			$query = $this->link->prepare("INSERT INTO `EmployeeDeptInfo_HR` (EmployeeId, DepartmentId, PositionTitle, RMID) VALUES (?,?,?,?)");
			$values = array($eid,$deptname,$tittle,$rm);
			$query->execute($values);
		}	

	}


	$action = new employeedeptInfoActions();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$deptname = trim($_POST['deptname'] ?? '');
		$tittle = trim($_POST['tittle'] ?? '');
		$rm = trim($_POST['rm'] ?? '');
		
		echo $action->insert_employeedeptinfo_details($eid,$deptname,$tittle,$rm);	
		echo "Department Info for employee  ".$eid." has been inserted successfully!!";
		
	}	


?>