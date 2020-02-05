<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$baname = "";
	$bacode = "";
	$brname = "";
	$brcode = "";
	$acnum = "";
	$clabe = "";
	$actype = "";
	
	class employeeBankInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_employee_details($eid,$baname,$bacode,$brname,$brcode,$acnum,$clabe,$actype){
			$query = $this->link->prepare("INSERT INTO `pb_db`.`BankInfo_HR` (EmployeeId, BankName, BankCode, BranchName, BranchCodeNumber, AccountNumber, CLABE, AccountType) VALUES (?,?,?,?,?,?,?,?)");
			$values = array($eid,$baname,$bacode,$brname,$brcode,$acnum,$clabe,$actype);
			$query->execute($values);
		}	

	}


	$action = new employeeBankInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$eid = trim($_POST['eid'] ?? '');
		$baname = trim($_POST['baname'] ?? '');
		$bacode = trim($_POST['bacode'] ?? '');
		$brname = trim($_POST['brname'] ?? '');
		$brcode = trim($_POST['brcode'] ?? '');
		$acnum = trim($_POST['acnum'] ?? '');
		$clabe = trim($_POST['clabe'] ?? '');
		$actype = trim($_POST['actype'] ?? '');
	 
		echo $action->insert_employee_details($eid,$baname,$bacode,$brname,$brcode,$acnum,$clabe,$actype);	
		echo "Employee Bank Info Inserted Successfully!!";
		
	}		


?>