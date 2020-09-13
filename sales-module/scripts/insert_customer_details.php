<?php

// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$cid = "";
	$bname = "";
	$cname = "";
	$address = "";
	$email = "";
	$phone = "";
	
class customerdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates customer DETAILS before Insert

	function validate_customer_details($cid,$bname,$cname,$address,$email,$phone){
		
		if(empty($cid)){
			echo "customer ID cannot be empty";  
            exit;			
	    }elseif($this->check_customer_exist($cid) >= 1){
			echo "customer RECORD exists in database";
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
		}else{
			
			$this->insert_customer_details($cid,$bname,$address,$email,$phone,$cname);	
			echo "customer DETAILS added successfully";
		}
	}

// This function checks if customer exist in database
	function check_customer_exist($cid){
		$query = $this->link->prepare("SELECT * FROM pb_db.customerdetails_sal WHERE customerId = ?");
     	$values = array($cid);
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
    function insert_customer_details($cid,$bname,$address,$email,$phone,$cname){
		$query = $this->link->prepare("INSERT INTO pb_db.customerdetails_sal (customerId, BusinessName, Location, EmailAddress, PhoneNumber, ContactName) VALUES (?,?,?,?,?,?)");
		$values = array($cid,$bname,$address,$email,$phone,$cname);
		$query->execute($values);				
    }	
}


$action = new customerdetailActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$cid = trim($_POST['cid'] ?? '');
	$bname = trim($_POST['bname'] ?? '');
	$cname = trim($_POST['cname'] ?? '');
	$address = trim($_POST['address'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$phone = trim($_POST['phone'] ?? '');
	echo $action->validate_customer_details($cid,$bname,$cname,$address,$email,$phone);	
	
}	


?>