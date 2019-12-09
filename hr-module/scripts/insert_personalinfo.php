<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$eid = "";
	$fname = "";
	$lname = "";
	$sdate = "";
	$deptname = "";
	$tittle = "";
	$gender = "";
	$dob = "";
	$etype = "";

	
class employeedetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates EMPLOYEE DETAILS before Insert

	function validate_employee_details($eid,$fname,$lname,$sdate,$deptname,$tittle,$gender,$dob,$etype){
		
		if(empty($eid)){
			echo "EMPLOYEE ID cannot be empty";  
            exit;			
	    }elseif($this->check_employee_exist($eid) >= 1){
			echo "EMPLOYEE RECORD exists in database";
			exit;
		}elseif(empty($fname)){
			echo "FIRST NAMES cannot be empty";  
            exit;			
	    }elseif(empty($lname)){
			echo "LAST NAMES cannot be empty";  
            exit;			
	    }elseif(empty($sdate)){
			echo "Please enter a START DATE";
			exit;
		}elseif($deptname == "Please Select from List"){
			echo "Please select DEPARTMENT NAME from the list";	
			exit;
		}elseif(empty($tittle)){
			echo "TITTLE cannot be empty";
			exit;
		}elseif(empty($gender)){
			echo "GENDER cannot be empty";
			exit;
		}elseif(empty($dob)){
			echo "DATE OF BIRTH CANNOT BE EMPTY.";
			exit;
		}elseif($this->check_age($dob) < 15){
			echo "Employee is too young";
			exit;
		}elseif($this->check_age($dob) > 60){
			echo "Employee is too old";
			exit;
		}elseif($etype == "Please Select from List"){
			echo "EMPLOYMENT TYPE CANNOT ME EMPTY";
			exit;
		}else{
			$this->insert_employee_details($eid,$fname,$lname,$sdate,$deptname,$tittle,$gender,$dob,$etype);	
			echo "Employee: ".$fname." ".$lname." "."was added successfully "."Employee ID is: ".$eid;
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
	function check_age($dob){
		$age = date_diff(date_create($dob), date_create('now'))->y;
		return $age; 
	}	
	

// Insert Function
    function insert_employee_details($eid,$fname,$lname,$sdate,$deptname,$tittle,$gender,$dob,$etype){
		$query = $this->link->prepare("INSERT INTO `PersonalInfo_HR` (EmployeeId, FirstNames, LastNames, JoiningDate, DepartmentId, PositionTittle, Gender, DateofBirth, EmpTypeId) VALUES (?,?,?,?,?,?,?,?,?)");
		$values = array($eid,$fname,$lname,$sdate,$deptname,$tittle,$gender,$dob,$etype);
		$query->execute($values);
	}	



}


$action = new employeedetailActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$eid = trim($_POST['eid'] ?? '');
	$fname = trim($_POST['fname'] ?? '');
	$lname = trim($_POST['lname'] ?? '');
	$sdate = trim($_POST['sdate'] ?? '');
	$deptname = trim($_POST['deptname'] ?? '');
	$tittle = trim($_POST['tittle'] ?? '');
	$gender = trim($_POST['gender'] ?? '');
	$dob = trim($_POST['dob'] ?? '');
	$etype = trim($_POST['etype'] ?? '');
	 
	echo $action->validate_employee_details($eid,$fname,$lname,$sdate,$deptname,$tittle,$gender,$dob,$etype);	
	
}	


?>