<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$qname = "";
	$description = "";

 

class productqualityActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_productquality_details($qname,$description) {
		
		if(empty($qname)){
			echo "Please ENTER PRODUCT QUALITY.";  
            exit;			
	    }elseif($this->check_productquality_exist($qname) >= 1){
			echo "PRODUCT QUALITY RECORD exists in database";
			exit;
		}else{
			$this->insert_productquality($qname,$description);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_productquality_exist($qname){
		$query = $this->link->prepare("SELECT * FROM productquality_prod WHERE QualityName = ?");
     	$values = array($qname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_productquality($qname,$description){
		$query = $this->link->prepare("INSERT INTO productquality_prod (QualityName, Description) VALUES (?,?)");
		$values = array($qname,$description);
		$query->execute($values);
		echo "PRODUCT QUALITY added successfully";		
    }	
}

$action = new productqualityActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$qname = trim($_POST['qname'] ?? '');
	$description = trim($_POST['description'] ?? '');
	echo $action->validate_productquality_details($qname,$description);
}	


?>