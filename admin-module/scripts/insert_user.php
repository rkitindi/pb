<?php
// Include config file
require_once "class.config.php";

    // Define variables and initialize with empty values
   	$eid = "";
	$rid = "";
	$password = "";
	$cpassword = "";

	
class userActions{

    public $link; 

    function __construct(){
		
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
		
    }
	
	
    // This function validates LOGIN DETAILS before Insert
	function validate_login_details($eid,$rid,$password,$cpassword){
		
		$lname = $eid;
		
		if($eid == "Please Select from List"){
			
			echo "Please select employee from list";
			exit;
			
		}elseif($rid == "Please Select from List"){
			
			echo "Please select USER ROLE from list.";  
            exit;		
			
	    }elseif($this->check_loginname_exist($lname) >= 1){
			
			echo "Record already exists, please register another employee";
			exit;
			
		}elseif(empty($password)){
			
			echo "Please enter a password";	
			
		}elseif(strlen($password) < 8){
			
			echo "Password must have atleast 8 characters.";
			exit;
			
		}elseif(empty($cpassword)){
			
			echo "Please confirm password";	
			
		}elseif($password != $cpassword){
			
			echo "Password did not match.";
			exit;
			
		}else{
		
			$password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
			$this->insert_login_details($eid,$rid,$lname,$password);	
			echo "Account created successfully, your Login Id is:  ".$lname;	
			
		}	
	}
	
	
   // This function checks if LOGIN NAME exist in database
	function check_loginname_exist($lname){
		
		$query = $this->link->prepare("SELECT * FROM `UserDetails_ADM` WHERE LoginName = ?");
     	$values = array($lname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
		
	}	
	
   // Insert Function
    function insert_login_details($eid,$rid,$lname,$password){
		
		$query = $this->link->prepare("INSERT INTO `pb_db`.`UserDetails_ADM` (EmployeeID, RoleID, LoginName, Password) VALUES (?,?,?,?)");
		$values = array($eid,$rid,$lname,$password);
		$query->execute($values);	
		
    }	
	
}


$data = new userActions();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$eid = trim($_POST['eid'] ?? '');
	$rid = trim($_POST['rid'] ?? '');
	$password = trim($_POST['password'] ?? '');
	$cpassword = trim($_POST['cpassword'] ?? '');
	echo $data->validate_login_details($eid,$rid,$password,$cpassword);	
	
}

?>