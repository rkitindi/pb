<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$sid = "";
	$bname = "";
	$cname = "";
	$address = "";
	$email = "";
	$phone = "";
	$supcat = "";
	
class supplierdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates supplier DETAILS before Insert

	function validate_supplier_details($sid,$bname,$cname,$address,$email,$phone,$supcat){
		
		if(empty($sid)){
			echo "SUPPLIER ID cannot be empty";  
            exit;			
	    }elseif($this->check_supplier_exist($sid) >= 1){
			echo "SUPPLIER RECORD exists in database";
			exit;
		}elseif(empty($bname)){
			echo "BUSINESS NAMES cannot be empty";  
            exit;			
	    }elseif(empty($cname)){
			echo "CONTACT NAMES cannot be empty";  
            exit;			
	    }elseif(!preg_match("/^[a-zA-Z ]*$/",$cname)){
			echo "Only letters and white space allowed";
			exit;
		}elseif(empty($address)){
			echo "Please enter a BUSINESS ADDRESS";
			exit;
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid email format";	
			exit;
		}elseif(empty($phone)){
			echo "phone cannot be empty";
			exit;
		}elseif($this->validate_phone_number($phone) == false){
			echo "Invalid phone number";
			exit;
		}elseif($supcat =="Please Select from List"){
			echo "PLEASE SELECT SUPPLIER CATEGORY FROM LIST";
			exit;
		}else{
			$this->insert_supplier_details($sid,$bname,$cname,$address,$email,$phone,$supcat);	
		}
	}

// This function checks if supplier exist in database
	function check_supplier_exist($sid){
		$query = $this->link->prepare("SELECT * FROM supplierinfo_prod WHERE SupplierId = ?");
     	$values = array($sid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function checks if phone number is correct	
	function validate_phone_number($phone){
		$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT); // Allow +, - and . in phone number
		$phone_to_check = str_replace("-", "", $filtered_phone_number);  // Remove "-" from number
     	if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
			return false;
		}else{
			return true;
		}
	} 
	
	
// Insert Function
    function insert_supplier_details($sid,$bname,$cname,$address,$email,$phone,$supcat){
		$query = $this->link->prepare("INSERT INTO supplierinfo_prod (SupplierId, BusinessName, ContactName, Address, EmailAddress, PhoneNumber, CategoryId) VALUES (?,?,?,?,?,?,?)");
		$values = array($sid,$bname,$cname,$address,$email,$phone,$supcat);
		$query->execute($values);
		echo "SUPPLIER DETAILS added successfully";		
    }	
}


$action = new supplierdetailActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$sid = trim($_POST['sid'] ?? '');
	$bname = trim($_POST['bname'] ?? '');
	$cname = trim($_POST['cname'] ?? '');
	$address = trim($_POST['address'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$phone = trim($_POST['phone'] ?? '');
	$supcat = trim($_POST['supcat'] ?? '');
	$dob = trim($_POST['dob'] ?? '');
	$etype = trim($_POST['etype'] ?? '');
	echo $action->validate_supplier_details($sid,$bname,$cname,$address,$email,$phone,$supcat,$dob,$etype);	
	
}	


?>