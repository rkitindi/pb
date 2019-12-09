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
	
	
// This function validates PERMISSION before Insert
	function validate_etype_details($ptype,$ptypedesc) {
		
		if(empty($ptype)){
			echo "PAYMENT TYPE cannot be empty";  
            exit;			
	    }elseif($this->check_etype_exist($ptype) >= 1){
			echo "PAYMENT TYPE RECORD exists in database";
			exit;
		}else{
			$this->insert_etype($ptype,$ptypedesc);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_etype_exist($ptype){
		$query = $this->link->prepare("SELECT * FROM `PaymentType_HR` WHERE PaymentType = ?");
     	$values = array($ptype);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_etype($ptype,$ptypedesc){
		$query = $this->link->prepare("INSERT INTO `PaymentType_HR` (PaymentType, Description) VALUES (?,?)");
		$values = array($ptype,$ptypedesc);
		$query->execute($values);
		echo "EMPLOYMENT TYPE added successfully";		
    }	
}

$action = new paytypeActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$ptype = trim($_POST['ptype'] ?? '');
	$ptypedesc = trim($_POST['ptypedesc'] ?? '');
	echo $action->validate_etype_details($ptype,$ptypedesc);
}	


?>