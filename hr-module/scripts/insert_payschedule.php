<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$payschedule = "";
	$paydesc = "";

 

	class paytypeActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_payschedule($payschedule,$paydesc){
			$query = $this->link->prepare("INSERT INTO `PaymentSchedule_HR` (PaymentSchedule, Description) VALUES (?,?)");
			$values = array($payschedule,$paydesc);
			$query->execute($values);				
		}	
	}

	$action = new paytypeActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$payschedule = trim($_POST['payschedule'] ?? '');
		$paydesc = trim($_POST['paydesc'] ?? '');
		echo $action->insert_payschedule($payschedule,$paydesc);
		echo "PAYMENT SCHEDULE added successfully";	
	}	


?>