<?php

//Start Session
session_start();
	
	
// Include config file
require_once "class.config.php";

if(!isset($_SESSION)){
	
	// Redirect user to index page	
	echo "<script> location.href='../../frontend/index.html'; </script>";
	exit;
		
}else{
		
	// Define variables and initialize with empty values
   	$pdesc = "";
	$repodate = "";

	// Get Session Details
	$e_id = $_SESSION['EmployeeID'];

}

class reportproblemActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	// Insert Function
    function insert_problem_reported($e_id,$pdesc,$repodate){
		$query = $this->link->prepare("INSERT INTO `pb_db`.`REPORTPROBLEMS_ADM` (EmployeeID, ProblemDesc, DateOccured) VALUES (?,?,?)");
		$values = array($e_id,$pdesc,$repodate);
		$query->execute($values);				
    }	
}


$action = new reportproblemActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$pdesc = trim($_POST['pdesc'] ?? '');
	$repodate = trim($_POST['repodate'] ?? '');
	echo $action->insert_problem_reported($e_id,$pdesc,$repodate);	
	echo "Problem Reported Successfully!!";
}	


?>