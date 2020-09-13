<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
 

class permissionActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_perm($pname,$pdesc) {
		
		if($pname == "Please Select Permission from List"){
			echo "Please select PERMISSION NAME from list.";  
            exit;			
	    }elseif($this->check_perm_exist($pname) >= 1){
			echo "PERMISSION exists in database";
			exit;
		}else{
			$this->insert_perm($pname,$pdesc);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_perm_exist($pname){
		$query = $this->link->prepare("SELECT * FROM userpermission_adm WHERE PermissionName = ?");
     	$values = array($pname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_perm($pname,$pdesc){
		$query = $this->link->prepare("INSERT INTO userpermission_adm (PermissionName, Description) VALUES (?,?)");
		$values = array($pname,$pdesc);
		$query->execute($values);
		echo "PERMISSION added successfully";		
    }	
}

$data = new permissionActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	echo $data->validate_perm(trim($_POST['pname']),trim($_POST['pdesc']));
}	


?>