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
	
	
// This function validates PERMISSION before Insert
	function validate_etype_details($payschedule,$paydesc) {
		
		if(empty($payschedule)){
			echo "PAYMENT SCHEDULE cannot be empty";  
            exit;			
	    }elseif($this->check_etype_exist($payschedule) >= 1){
			echo "PAYMENT SCHEDULE RECORD exists in database";
			exit;
		}else{
			$this->insert_etype($payschedule,$paydesc);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_etype_exist($payschedule){
		$query = $this->link->prepare("SELECT * FROM `PaymentSchedule_HR` WHERE PaymentSchedule = ?");
     	$values = array($payschedule);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_etype($payschedule,$paydesc){
		$query = $this->link->prepare("INSERT INTO `PaymentSchedule_HR` (PaymentSchedule, Description) VALUES (?,?)");
		$values = array($payschedule,$paydesc);
		$query->execute($values);
		echo "PAYMENT SCHEDULE added successfully";		
    }	
}

$action = new paytypeActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$payschedule = trim($_POST['payschedule'] ?? '');
	$paydesc = trim($_POST['paydesc'] ?? '');
	echo $action->validate_etype_details($payschedule,$paydesc);
}	


?>