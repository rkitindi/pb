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
	
	
// This function validates PERMISSION before Insert
	function validate_leavetype_details($lvtype,$paysstatus,$leavedesc) {
		
		if(empty($lvtype)){
			echo "LEAVE TYPE cannot be empty.";  
            exit;			
	    }elseif(empty($paysstatus)){
			echo "PAYMENT STATUS cannot be empty";
			exit;
		}elseif($this->check_leavetype_exist($lvtype) >= 1){
			echo "LEAVE TYPE RECORD exists in database";
			exit;
		}else{
			$this->insert_leavetype($lvtype,$paysstatus,$leavedesc);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_leavetype_exist($lvtype){
		$query = $this->link->prepare("SELECT * FROM `LeaveType_HR` WHERE LeaveType = ?");
     	$values = array($lvtype);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_leavetype($lvtype,$paysstatus,$leavedesc){
		$query = $this->link->prepare("INSERT INTO `LeaveType_HR` (LeaveType, PaymentStatus, Description) VALUES (?,?,?)");
		$values = array($lvtype,$paysstatus,$leavedesc);
		$query->execute($values);
		echo "LEAVE TYPE added successfully";		
    }	
}

$action = new leavetypeActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$lvtype = trim($_POST['lvtype'] ?? '');
	$paysstatus = trim($_POST['paysstatus'] ?? '');
	$leavedesc = trim($_POST['leavedesc'] ?? '');
	echo $action->validate_leavetype_details($lvtype,$paysstatus,$leavedesc);
}	


?>