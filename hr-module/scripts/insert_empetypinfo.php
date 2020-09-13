<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$etype = "";

	
	class employmentTypeInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employee_details($eid,$etype){
			$query = $this->link->prepare("INSERT INTO pb_db.employmenttypeinfo_hr (EmployeeId, EmpTypeId) VALUES (?,?)");
			$values = array($eid,$etype);
			$query->execute($values);
		}	


	}


	$action = new employmentTypeInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$etype = trim($_POST['etype'] ?? '');
	 
		echo $action->insert_employee_details($eid,$etype);	
		echo "Employment Type Record Inserted Successfully!!";
		
	}		


?>