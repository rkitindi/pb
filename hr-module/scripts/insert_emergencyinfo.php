<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$eid = "";
	$fname = "";
   	$lname = "";
	$email = "";
    $phone = "";
	$address = "";
	$relate = "";
	$others = "";
	
	class EmergencyInfoActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_emergency_details($eid,$fname,$lname,$email,$phone,$address,$relate,$others){
			$query = $this->link->prepare("INSERT INTO emergencycontact_hr (EmployeeId, FirstNames, LastNames, Email, Phone, Address, Relationship, Other) VALUES (?,?,?,?,?,?,?,?)");
			$values = array($eid,$fname,$lname,$email,$phone,$address,$relate,$others);
			$query->execute($values);
		}	
	}

	$insert_action = new EmergencyInfoActions();
	$validate_email = new EmergencyInfoActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$eid = trim($_POST['eid'] ?? '');
		$fname = trim($_POST['fname'] ?? '');
		$lname = trim($_POST['lname'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$phone = trim($_POST['phone'] ?? '');
		$address = trim($_POST['address'] ?? '');
		$relate = trim($_POST['relate'] ?? '');
		$others = trim($_POST['others'] ?? '');
		echo $insert_action ->insert_emergency_details($eid,$fname,$lname,$email,$phone,$address,$relate,$others );
		echo "EMERGENCY DETAILS FOR  ".$eid."  SUCCESSFULLY ADDED!!";	
			
	

	}	


?>