<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$treg = "";
	$tmake = "";
	$tmodel = "";
	$tcap = "";
	$tdriver = "";
	$tsup = "";
	
class truckdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates truck DETAILS before Insert

	function validate_truck_details($treg,$tmake,$tmodel,$tcap,$tdriver,$tsup){
		if(empty($treg)){
			echo "Truck REGISTRATION NUMBER cannot be empty";  
            exit;			
	    }elseif($this->check_truck_exist($treg) >= 1){
			echo "truck RECORD exists in database";
			exit;
		}elseif(empty($tmake)){
			echo "Truck MAKE cannot be empty";  
            exit;			
	    }elseif(empty($tmodel)){
			echo "Truck MODEL cannot be empty";  
            exit;			
	    }elseif(empty($tcap)){
			echo "Truck CAPACITY cannot be empty";  
            exit;			
	    }elseif(!is_numeric($tcap) || $tcap < 1 ){
			echo "ONLY NUMMBERS STARTING 1 ARE ALLOWED";  
            exit;			
	    }elseif(empty($tdriver)){
			echo "DRIVER NAME cannot be empty";  
            exit;			
	    }elseif(!preg_match("/^[a-zA-Z ]*$/",$tdriver)){
			echo "Only letters and white space allowed";
			exit;
		}elseif($tsup =="Please Select from List"){
			echo "PLEASE SELECT supplier NAME FROM LIST";
			exit;
		}else{
			$this->insert_truck_details($treg,$tmake,$tmodel,$tcap,$tdriver,$tsup);	
		}
	}

// This function checks if truck exist in database
	function check_truck_exist($treg){
		$query = $this->link->prepare("SELECT * FROM `truckInfo_PROD` WHERE RegNumber = ?");
     	$values = array($treg);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// Insert Function
    function insert_truck_details($treg,$tmake,$tmodel,$tcap,$tdriver,$tsup){
		$query = $this->link->prepare("INSERT INTO `truckInfo_PROD` (RegNumber, Make, Model, Capacity, DriverName, SupplierId) VALUES (?,?,?,?,?,?)");
		$values = array($treg,$tmake,$tmodel,$tcap,$tdriver,$tsup);
		$query->execute($values);
		echo "truck DETAILS added successfully";		
    }	
}


$action = new truckdetailActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$treg = trim($_POST['treg'] ?? '');
	$tmake = trim($_POST['tmake'] ?? '');
	$tmodel = trim($_POST['tmodel'] ?? '');
	$tcap = trim($_POST['tcap'] ?? '');
	$tdriver = trim($_POST['tdriver'] ?? '');
	$tsup = trim($_POST['tsup'] ?? '');
	echo $action->validate_truck_details($treg,$tmake,$tmodel,$tcap,$tdriver,$tsup);	
	
}	


?>