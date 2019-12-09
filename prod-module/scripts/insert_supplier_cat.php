<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$supcat = "";
	$description = "";
	$catid = "";

 

class suppliercatActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_supcat_details($catid,$supcat,$description) {
		
		if(empty($supcat)){
			echo "Please ENTER SUPPLIER CATEGORY";  
            exit;			
	    }elseif($this->check_supcat_exist($catid) >= 1){
			echo "SUPPLIER CATEGORY RECORD exists in database";
			exit;
		}else{
			$this->insert_supcat($catid,$supcat,$description);	
			echo "SUPPLIER CATEGORY  ".$supcat."  is added successfully";
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_supcat_exist($catid){
		$query = $this->link->prepare("SELECT * FROM `SupplierCategory_PROD` WHERE CategoryId = ?");
     	$values = array($catid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_supcat($catid,$supcat,$description){
		$query = $this->link->prepare("INSERT INTO `SupplierCategory_PROD` (CategoryId, CategoryName, Description) VALUES (?,?,?)");
		$values = array($catid,$supcat,$description);
		$query->execute($values);				
    }	
}

$action = new suppliercatActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$supcat = trim($_POST['supcat'] ?? '');
	$description = trim($_POST['description'] ?? '');
	$catid = trim($_POST['catid'] ?? '');
	echo $action->validate_supcat_details($catid,$supcat,$description);
}	


?>