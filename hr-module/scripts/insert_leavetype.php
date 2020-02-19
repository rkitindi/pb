<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$lvtype = "";
	$paysstatus = "";
	$leavedesc = "";

 

	class leavetypeActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_leavetype($lvtype,$paysstatus,$leavedesc){
			$query = $this->link->prepare("INSERT INTO `LeaveType_HR` (LeaveType, PaymentStatus, Description) VALUES (?,?,?)");
			$values = array($lvtype,$paysstatus,$leavedesc);
			$query->execute($values);		
		}	
	}

	$action = new leavetypeActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$lvtype = trim($_POST['lvtype'] ?? '');
		$paysstatus = trim($_POST['paysstatus'] ?? '');
		$leavedesc = trim($_POST['leavedesc'] ?? '');
		echo $action->insert_leavetype($lvtype,$paysstatus,$leavedesc);
		echo "LEAVE TYPE added successfully";	
	}	


?>