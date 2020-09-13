<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$etype = "";
	$etypedesc = "";
 

	class emptypeActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}
	
		// Insert Function
		function insert_etype($etype,$etypedesc){
			$query = $this->link->prepare("INSERT INTO pb_db.employmenttype_hr (EmploymentType, Description) VALUES (?,?)");
			$values = array($etype,$etypedesc);
			$query->execute($values);
			
		}	
	}

	$action = new emptypeActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$etype = trim($_POST['etype'] ?? '');
		$etypedesc = trim($_POST['etypedesc'] ?? '');
		echo $action->insert_etype($etype,$etypedesc);		
		echo "EMPLOYMENT TYPE RECORD INSERTED SUCCESSFULLY!";
	}	


?>