<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$pid = "";
	$pname = "";
    $eid = "";

 

class posActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_pos_details($pid,$pname,$eid) {
		
		if(empty($pid)){
			echo "POS ID cannot be empty";  
            exit;			
	    }elseif($this->check_pos_exist($pid) >= 1){
			echo "EXPENSE TYPE RECORD exists in database";
			exit;
		}elseif(empty($pname)){
			echo "POS NAME cannot be empty";  
            exit;			
	    }elseif($eid == "Please Select from List"){
			echo "Sales Person Name cannot be empty";  
            exit;			
	    }else{
			
			$this->insert_pos_details($pid,$pname,$eid);	
			echo "POS: ".$pname." Record Added Successfully";
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_pos_exist($pid){
		$query = $this->link->prepare("SELECT * FROM pb_db.posinfo_sal WHERE POSId = ?");
     	$values = array($pid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_pos_details($pid,$pname,$eid){
		$query = $this->link->prepare("INSERT INTO pb_db.posinfo_sal (POSId, POSName, EmployeeID) VALUES (?,?,?)");
		$values = array($pid,$pname,$eid);
		$query->execute($values);				
    }	
}

$action = new posActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$pid = trim($_POST['pid'] ?? '');
	$pname = trim($_POST['pname'] ?? '');
	$eid = trim($_POST['eid'] ?? '');
	echo $action->validate_pos_details($pid,$pname,$eid);
}	


?>