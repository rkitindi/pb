<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$ptype = "";
	$ptypedesc = "";

 
	class paytypeActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}

		// Insert Function
		function insert_etype($ptype,$ptypedesc){
			$query = $this->link->prepare("INSERT INTO `PaymentType_HR` (PaymentType, Description) VALUES (?,?)");
			$values = array($ptype,$ptypedesc);
			$query->execute($values);				
		}	
	}

	$action = new paytypeActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$ptype = trim($_POST['ptype'] ?? '');
		$ptypedesc = trim($_POST['ptypedesc'] ?? '');
		echo $action->insert_etype($ptype,$ptypedesc);
		echo "PAYMENT TYPE added successfully!!";	
	}	


?>