<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$bname = "";
	$bcode = "";
	$bcnumber = "";
	$acnum = "";
	$clabe = "";
	$actype = "";
	
	class employeeLeaveInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employee_details($eid,$bname,$bcode,$bcnumber,$acnum,$clabe,$actype){
			$query = $this->link->prepare("INSERT INTO `pb_db`.`BankInfo_HR` (EmployeeId, BankName, BankCode, BranchCodeNumber, AccountNumber, CLABE, AccountType) VALUES (?,?,?,?,?,?,?)");
			$values = array($eid,$bname,$bcode,$bcnumber,$acnum,$clabe,$actype);
			$query->execute($values);
		}	

	}


	$action = new employeeLeaveInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$bname = trim($_POST['bname'] ?? '');
		$bcode = trim($_POST['bcode'] ?? '');
		$bcnumber = trim($_POST['bcnumber'] ?? '');
		$acnum = trim($_POST['acnum'] ?? '');
		$clabe = trim($_POST['clabe'] ?? '');
		$actype = trim($_POST['actype'] ?? '');
	 
		echo $action->insert_employee_details($eid,$bname,$bcode,$bcnumber,$acnum,$clabe,$actype);	
		echo "Employee Bank Info Inserted Successfully!!";
		
	}		


?>