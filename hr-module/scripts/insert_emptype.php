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
	
	
// This function validates PERMISSION before Insert
	function validate_etype_details($etype,$etypedesc) {
		
		if(empty($etype)){
			echo "EMPL0YMENT TYPE cannot be empty.";  
            exit;			
	    }elseif($this->check_etype_exist($etype) >= 1){
			echo "EMPLOYMENT TYPE RECORD exists in database";
			exit;
		}else{
			$this->insert_etype($etype,$etypedesc);	
			echo "EMPLOYMENT TYPE:"." ".$etype." "."added successfully";	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_etype_exist($etype){
		$query = $this->link->prepare("SELECT * FROM  `pb_db`.`EmploymentType_HR` WHERE EmploymentType = ?");
     	$values = array($etype);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_etype($etype,$etypedesc){
		$query = $this->link->prepare("INSERT INTO `pb_db`.`EmploymentType_HR` (EmploymentType, Description) VALUES (?,?)");
		$values = array($etype,$etypedesc);
		$query->execute($values);
			
    }	
}

$action = new emptypeActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$etype = trim($_POST['etype'] ?? '');
	$etypedesc = trim($_POST['etypedesc'] ?? '');
	echo $action->validate_etype_details($etype,$etypedesc);
}	


?>