<?php

	// Include config file
	require_once "class.config.php";

	// Define variables and initialize with empty values
   	$deptname = "";
	$deptdesc = "";

 

	class departmentActions{

		public $link; 


		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();   
			return $this->link;
		}

		// Insert Function
		function insert_deptname($deptname,$deptdesc){
			$query = $this->link->prepare("INSERT INTO `Department_HR` (DepartmentName, Description) VALUES (?,?)");
			$values = array($deptname,$deptdesc);
			$query->execute($values);	
		}	
	}

	$action = new departmentActions();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$deptname = trim($_POST['deptname'] ?? '');
		$deptdesc = trim($_POST['deptdesc'] ?? '');
		echo $action->insert_deptname($deptname,$deptdesc);
		echo "DEPARTMENT NAME added successfully";	
	}	


?>