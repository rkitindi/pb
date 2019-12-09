<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$deptname = "";
	$deptdesc = "";

 

class departmentActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_deptname_details($deptname,$deptdesc) {
		
		if(empty($deptname)){
			echo "Please ENTER DEPARTMENT NAME from list.";  
            exit;			
	    }elseif($this->check_deptname_exist($deptname) >= 1){
			echo "DEPARTMENT NAME RECORD exists in database";
			exit;
		}else{
			$this->insert_deptname($deptname,$deptdesc);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_deptname_exist($deptname){
		$query = $this->link->prepare("SELECT * FROM `Department_HR` WHERE DepartmentName = ?");
     	$values = array($deptname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_deptname($deptname,$deptdesc){
		$query = $this->link->prepare("INSERT INTO `Department_HR` (DepartmentName, Description) VALUES (?,?)");
		$values = array($deptname,$deptdesc);
		$query->execute($values);
		echo "DEPARTMENT NAME added successfully";		
    }	
}

$action = new departmentActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$deptname = trim($_POST['deptname'] ?? '');
	$deptdesc = trim($_POST['deptdesc'] ?? '');
	echo $action->validate_deptname_details($deptname,$deptdesc);
}	


?>