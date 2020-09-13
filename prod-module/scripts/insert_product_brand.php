<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$bname = "";
	$description = "";

 

class productbrandActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_productbrand_details($bname,$description) {
		
		if(empty($bname)){
			echo "Please ENTER PRODUCT brand.";  
            exit;			
	    }elseif($this->check_productbrand_exist($bname) >= 1){
			echo "PRODUCT brand RECORD exists in database";
			exit;
		}else{
			$this->insert_productbrand($bname,$description);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_productbrand_exist($bname){
		$query = $this->link->prepare("SELECT * FROM productbrand_prod WHERE brandName = ?");
     	$values = array($bname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_productbrand($bname,$description){
		$query = $this->link->prepare("INSERT INTO productbrand_prod (brandName, Description) VALUES (?,?)");
		$values = array($bname,$description);
		$query->execute($values);
		echo "PRODUCT brand added successfully";		
    }	
}

$action = new productbrandActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$bname = trim($_POST['bname'] ?? '');
	$description = trim($_POST['description'] ?? '');
	echo $action->validate_productbrand_details($bname,$description);
}	


?>