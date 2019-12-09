<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$exptype = "";
	$description = "";

 

class expensetypeActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_exptype_details($exptype,$description) {
		
		if(empty($exptype)){
			echo "Please ENTER EXPENSE TYPE.";  
            exit;			
	    }elseif($this->check_exptype_exist($exptype) >= 1){
			echo "EXPENSE TYPE RECORD exists in database";
			exit;
		}else{
			$this->insert_exptype($exptype,$description);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_exptype_exist($exptype){
		$query = $this->link->prepare("SELECT * FROM `ExpenseType_PROD` WHERE ExpenseType = ?");
     	$values = array($exptype);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_exptype($exptype,$description){
		$query = $this->link->prepare("INSERT INTO `ExpenseType_PROD` (ExpenseType, Description) VALUES (?,?)");
		$values = array($exptype,$description);
		$query->execute($values);
		echo "EXPENSE TYPE added successfully";		
    }	
}

$action = new expensetypeActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$exptype = trim($_POST['exptype'] ?? '');
	$description = trim($_POST['description'] ?? '');
	echo $action->validate_exptype_details($exptype,$description);
}	


?>