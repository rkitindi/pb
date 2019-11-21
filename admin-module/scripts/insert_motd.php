<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
 

class messageActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates MOTD before Insert
	function validate_msg($message) {
		
		// Validate Message of the Day
		if(empty($message)){
			echo "Please enter MOTD.";  
            exit;			
		}elseif(strlen($message) < 3){
			echo "MOTD must have atleast 3 characters.";
			exit;
	    }elseif($this->check_msg_exist() >= 1){
			echo "MOTD exists in database, try again tomorrow.";
			exit;
		}else{
			$this->insert_motd($message);	
		}	
	}
	
	
// This function checks if TODAY's MOTD exist in database
	function check_msg_exist(){
		$query = $this->link->prepare("SELECT * FROM `MOTD_ADM` WHERE MessageDate = ?");
     	$values = array(date("Y-m-d"));
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_motd($motd){
		$query = $this->link->prepare("INSERT INTO MOTD_ADM (MessageDate, Message) VALUES (?,?)");
		$values = array(date("Y-m-d"),$motd);
		$query->execute($values);
		echo "MOTD added successfully";		
    }	
}

$data = new messageActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	echo $data->validate_msg(trim($_POST['message']));
}	


?>