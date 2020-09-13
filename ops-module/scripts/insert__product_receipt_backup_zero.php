<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$pcode = "";
	$cnum = "";
	$cynum = "";
	$fname = "";
	$quantity = "";
	$cid = "";
	$darr = "";
	
class prodreceiptActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates prodreceipt DETAILS before Insert

	function validate_prodreceipt_details($pcode,$cnum,$cynum,$fname,$quantity,$cid,$darr){
		$bid = $this->get_batch_id($cnum,$cynum);
		$today = date("Y-m-d");
		if($pcode == "Please Select from List"){
			echo "Select PRODUCT CODE from a list";  
            exit;			
	    }elseif(empty($cnum)){
			echo "CONTROL NUMBER cannot be empty";  
            exit;			
	    }elseif(!is_integer($cnum) && $cnum <= 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif(empty($cynum)){
			echo "CYCLE NUMBER cannot be empty";  
            exit;			
	    }elseif(!is_integer($cynum) && $cynum <= 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($fname == "Please Select from List"){
			echo "Select FARM NAME from a list";
			exit;
		}elseif(empty($quantity)){
			echo "QUANTITY cannot be empty";	
			exit;
		}elseif(!is_integer($quantity) && $quantity <= 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($cid == "Please Select from List"){
			echo "Select CASE NAME from a list";
			exit;
		}elseif(empty($darr)){			
			echo "DATE RECEIVED cannot be empty";
			exit;			
		}elseif( $darr > $today ){			
			echo "DATE RECEIVED cannot be later than TODAY";
			exit;			
		}elseif($this->check_prodreceipt_exist($pcode,$bid) >= 1){
			echo "THIS PRODUCT RECORD exists in database";
			exit;
		}else{
			$bid = $this->get_batch_id($cnum,$cynum);
			$this->insert_prodreceipt_details($pcode,$bid,$fname,$quantity,$cid,$darr);	
			$receipt = $this->get_prodreceipt_number($pcode,$bid);
			echo "PRODUCT:  ".$pcode." DETAILS added successfully, PRODUCT RECEIPT NUMBER IS:  ".$receipt;
		}
	}

// This function checks if prodreceipt exist in database
	function check_prodreceipt_exist($pcode,$bid){
		$query = $this->link->prepare("SELECT * FROM pb_db.receiveproduct_acc WHERE ProductCode = ? and BatchId = ?");
     	$values = array($pcode,$bid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function retrieve batchID	
	function get_batch_id($cnum,$cynum){
		
		$query = $this->link->prepare("SELECT BatchId FROM pb_db.batchdetails_acc WHERE ControlNumber = ? and RangeCycle = ?");
		try{
			$values = array($cnum,$cynum);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$bid = $item['BatchId'];	
				return $bid;				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
	} 
	
	// This function retrieve batchID	
	function get_prodreceipt_number($pcode,$bid){
		
		$query = $this->link->prepare("SELECT ProductReceiptNumber FROM pb_db.receiveproduct_acc WHERE ProductCode=? and BatchId=?");
		try{
			$values = array($pcode,$bid);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$rnum = $item['ProductReceiptNumber'];				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $rnum;
	} 
	
// Insert Function
    function insert_prodreceipt_details($pcode,$bid,$fname,$quantity,$cid,$darr){
		$query = $this->link->prepare("INSERT INTO pb_db.receiveproduct_acc (ProductCode, BatchId, FarmId, Quantity, CaseCode, DateReceived) VALUES (?,?,?,?,?,?)");
		$values = array($pcode,$bid,$fname,$quantity,$cid,$darr);
		$query->execute($values);				
    }	
}


$action = new prodreceiptActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$pcode = trim($_POST['pcode'] ?? '');
	$cnum = trim($_POST['cnum'] ?? '');
	$cynum = trim($_POST['cynum'] ?? '');
	$fname = trim($_POST['fname'] ?? '');
	$quantity = trim($_POST['quantity'] ?? '');
	$cid = trim($_POST['cid'] ?? '');
	$darr = trim($_POST['darr'] ?? '');
	echo $action->validate_prodreceipt_details($pcode,$cnum,$cynum,$fname,$quantity,$cid,$darr);	
	
}	


?>