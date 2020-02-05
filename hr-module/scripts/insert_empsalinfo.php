<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$pschedule = "";
	$bsalary = "";
	$ssec = "";
	$stax = "";
	$ftax = "";
	$income = "";
	
	class employeeSalInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employee_details($eid,$pschedule,$bsalary,$ssec,$stax,$ftax,$income){
			$query = $this->link->prepare("INSERT INTO `pb_db`.`SalaryInfo_HR` (EmployeeId, PayScheduleId, BaseSalary, SocialSec, StateTax, FederalTax, NetIncome) VALUES (?,?,?,?,?,?,?)");
			$values = array($eid,$pschedule,$bsalary,$ssec,$stax,$ftax,$income);
			$query->execute($values);
		}	


	}


	$action = new employeeSalInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$pschedule = trim($_POST['pschedule'] ?? '');
		$bsalary = trim($_POST['bsalary'] ?? '');
		$ssec = trim($_POST['ssec'] ?? '');
		$stax = trim($_POST['stax'] ?? '');
		$ftax = trim($_POST['ftax'] ?? '');
		$income = trim($_POST['income'] ?? '');
	 
		echo $action->insert_employee_details($eid,$pschedule,$bsalary,$ssec,$stax,$ftax,$income);	
		echo "Employee Salary Info Inserted Successfully!!";
		
	}		


?>