<?php

// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$dprod = "";
	$quantity = "";
	$drec = "";
	$received = "";
	$comment = "";
	
class prodrecatchActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates prodrecatch DETAILS before Insert

	function validate_prodrecatch_details($dprod,$quantity,$drec,$received,$comment){
		
		$today = date("Y-m-d");
		
		if($dprod == "Please Select from List"){
			echo "Select PRODUCT you want to receive from a list";  
            exit;			
	    }elseif(empty($quantity)){
			echo "QUANTITY cannot be empty";	
			exit;
		}elseif(!is_integer($quantity) && $quantity <= 0){
			echo "QUANTITY must be POSITIVE NUMBER";  
            exit;			
	    }elseif(empty($drec)){			
			echo "Received DATE cannot be empty";
			exit;			
		}elseif( $drec > $today ){			
			echo "Received DATE cannot be later than TODAY";
			exit;			
		}elseif(empty($received)){
			echo "Confirmation is needed";	
			exit;
		}else{
			
			$dispatched = $this->fetch_dispatched($dprod);
			$record_exists = $this->check_record_exists($dprod);
			
			if ($quantity > $dispatched){
				
				echo "You cannot receive:  ".$quantity."  boxes, more than: ".$dispatched."  dispatched boxes";
				exit;
				
			}elseif( ($quantity < $dispatched) and (empty($comment))){
				
				echo "Please explain why you are receiving: ".$quantity."  boxes, less than: ".$dispatched."  boxes dispatched in comments";
				exit;
				
			}elseif($received == "N" and empty($comment)){
				
				echo "Please explain why are you not receiving in comments";
				exit;
				
			}elseif($record_exists == "TRUE"){
				
				echo "You already received this product, Please receive another product";
				exit;
				
			}else{
				
				$drec = date('Y-m-d', strtotime($drec));
				$this->insert_receivedprod_details($dprod,$quantity,$drec,$received,$comment);	
				echo "PRODUCT  received RECORD added successfully";
				
			}		

		}
	}

   // This Fetch Available Product Stock	
	function fetch_dispatched($dprod){
		
		$query = $this->link->prepare("SELECT DispatchProduct_ACC.Quantity AS Dispatched FROM DispatchProduct_ACC WHERE DispatchProduct_ACC.DispatchRefNum = ?");
		try{
			$values = array($dprod);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$stock = $item['Dispatched'];		
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $stock;
	} 
	
	// This Check If Record Exists	
	function check_record_exists($dprod){
		
		$query = $this->link->prepare("select * from `pb_db`.`ProductReceived_SAL` WHERE DispatchRefNum = ?");
		try{
			$values = array($dprod);
			$query->execute($values);
			$counts = $query->rowCount();		
			if($counts > 0){
				return "TRUE";
			}else{
				return "FALSE";
			}
		}catch (PDOException $e){die($e->getMessage());}
	
	} 
	
    // Insert Function
    function insert_receivedprod_details($dprod,$quantity,$drec,$received,$comment){
		$query = $this->link->prepare("INSERT  INTO  `pb_db`.`ProductReceived_SAL` (DispatchRefNum, Quantity, DateReceived, Received, Comments) VALUES (?,?,?,?,?)");
		$values = array($dprod,$quantity,$drec,$received,$comment);
		$query->execute($values);				
    }	
}


$action = new prodrecatchActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$dprod = trim($_POST['dprod'] ?? '');
		$quantity = trim($_POST['quantity'] ?? '');
		$drec = trim($_POST['drec'] ?? '');
		$received = trim($_POST['received'] ?? '');		
		$comment = trim($_POST['comment'] ?? '');
		
		echo $action->validate_prodrecatch_details($dprod,$quantity,$drec,$received,$comment);	

}	


?>