<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$fname = "";
	$fsize = "";
	$bname = "";

	
class farmdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates farm DETAILS before Insert

	function validate_farm_details($fname,$fsize,$bname){
		if(empty($fname)){
			echo "FARM NAME cannot be empty";  
            exit;			
	    }elseif($this->check_farm_exist($fname) >= 1){
			echo "FARM RECORD exists in database";
			exit;
		}elseif(!is_numeric($fsize) || $fsize < 1 ){
			echo "ONLY NUMMBERS STARTING 1 ARE ALLOWED";  
            exit;			
	    }elseif($bname =="Please Select from List"){
			echo "PLEASE SELECT BUSINESS NAME FROM LIST";
			exit;
		}else{
			$this->insert_farm_details($fname,$fsize,$bname);	
		}
	}

// This function checks if farm exist in database
	function check_farm_exist($fname){
		$query = $this->link->prepare("SELECT * FROM `farmInfo_PROD` WHERE farmId = ?");
     	$values = array($fname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// Insert Function
    function insert_farm_details($fname,$fsize,$bname){
		$query = $this->link->prepare("INSERT INTO `FarmInfo_PROD` (FarmName, FarmSize, SupplierId) VALUES (?,?,?)");
		$values = array($fname,$fsize,$bname);
		$query->execute($values);
		echo "farm DETAILS added successfully";		
    }	
}


$action = new farmdetailActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$fname = trim($_POST['fname'] ?? '');
	$fsize = trim($_POST['fsize'] ?? '');
	$bname = trim($_POST['bname'] ?? '');
	echo $action->validate_farm_details($fname,$fsize,$bname);	
	
}	


?>