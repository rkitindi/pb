<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$eid = "";
	$rname = "";
	$lname = "";
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
	function validate_login_details($eid,$rname,$lname,$password,$cpassword) {
		
		if(empty($eid)){
				echo "Please enter a employee_id.";
				exit;
		}elseif($this->check_employee_exist($eid) = 0){
			echo "Employee doesnt exist exists in database, please supply correct employee id";
			exit;
		}elseif($rname == "Please Select Role from List"){
			echo "Please select ROLE NAME from list.";  
            exit;			
	    }elseif($this->check_loginname_exist($lname) >= 1){
			echo "LOGIN NAME already exists in database, please choose another login name";
			exit;
		}elseif(strlen($lname) < 4){
			echo "Login name must have atleast 4 characters.";
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
			$rid = $this->fetch_role_id($rname);
			$this->insert_login_details($eid,$rid,$lname,$password,$cpassword);	
		}	
	}
	
// This function checks if EMPLOYEE exist in database
	function check_employee_exist($eid){
		$query = $this->link->prepare("SELECT * FROM `PersonalInfo_HR` WHERE EmployeeId = ?");
     	$values = array($eid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function checks if LOGIN NAME exist in database
	function check_loginname_exist($lname){
		$query = $this->link->prepare("SELECT * FROM `UserDetails_ADM` WHERE LoginName = ?");
     	$values = array($lname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function fetches Role ID
	function fetch_role_id($rname){
		$query = $this->link->prepare("SELECT RoleID FROM `userrole_adm` WHERE RoleName = ?");
     	$values = array($rname);
		try{
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_NUM);
			foreach($result as $val){
				foreach($val as $value){
					$rid = $value[0];
				}					
			}						
		}catch (PDOException $e){die($e->getMessage());}
		return $rid; 
	}	
		
// Insert Function
    function insert_login_details($eid,$rname,$lname,$password,$cpassword){
		$query = $this->link->prepare("INSERT INTO `UserRole_ADM` (RoleName, RoleDescription, PermissionID) VALUES (?,?,?)");
		$values = array($rname,$rdesc,$totalPerm);
		$query->execute($values);
		echo "MOTD added successfully";		
    }	
	
}

$data = new userActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$eid = trim($_POST['eid'] ?? '');
	$rname = trim($_POST['rname'] ?? '');
	$lname = trim($_POST['lname'] ?? '');
	$password = PASSWORD_HASH(trim($_POST['password'] ?? '', PASSWORD_DEFAULT);
	$cpassword = PASSWORD_HASH(trim($_POST['cpassword'] ?? '', PASSWORD_DEFAULT);
	echo $data->validate_login_details($eid,$rname,$lname,$password,$cpassword);	
}	


?>