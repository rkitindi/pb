<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
	$cnum = "";
	$fcost = "";
	$iva = "";
	$riva = "";
	
class prodreceiptActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates prodreceipt DETAILS before Insert

	function validate_prodreceipt_details($cnum,$fcost,$iva,$riva){
		
		$control_num = $this->get_control_num($cnum);
		$cycle = $this->get_cycle($cnum);
		$bid = $this->get_batch_id($control_num,$cycle);
		
		if($cnum == "10000000.10000000"){
			echo "Select CONTROL NUMBER from the list";  
            exit;			
	    }elseif(empty($fcost)){
			echo "FREIGHT COST cannot be empty";
			exit;
		}elseif(!is_integer($fcost) && $fcost <= 0){
			echo "FREIGHT COST cannot be negative";  
            exit;			
	    }elseif(empty($iva)){
			echo "IVA cannot be empty";	
			exit;
		}elseif(!is_integer($iva) && $iva <= 0){
			echo "IVA cannot be negative";  
            exit;			
	    }elseif(empty($riva)){
			echo "RIVA cannot be empty";
			exit;
		}elseif(!is_integer($riva) && $riva <= 0){
			echo "RIVA cannot be negative";  
            exit;			
	    }elseif($this->check_record_exist($bid) >= 1){
			echo "THIS PRODUCT RECORD exists in database";
			exit;
		}else{			
		
			$iva = $this->calculate_iva($iva,$fcost);
			$riva = $this->calculate_riva($riva,$fcost);
					
			$this->insert_batchexp_details($bid,$fcost,$iva,$riva);	
			echo "BATCH COST details inserted successfully!!!";
		}
	}

// This function checks if prodreceipt exist in database
	function check_record_exist($bid){		
		
		$query = $this->link->prepare("SELECT  * FROM  pb_db.batchexp_acc WHERE  BatchId = ?");
     	$values = array($bid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function retrieve batchID	
	function get_batch_id($control_num,$cycle){
		
		$query = $this->link->prepare("SELECT BatchId FROM pb_db.batchdetails_acc WHERE ControlNumber = ? and RangeCycle = ?");
		try{
			$values = array($control_num,$cycle);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$bid = $item['BatchId'];	
				return $bid;				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
	} 
	

	// This function returns control number
	function get_control_num($cnum){			    

		$part = explode(".", $cnum);
		return $part[0];	
		
	}
	
	// This function returns cycle
	function get_cycle($cnum){			

		$part = explode(".", $cnum);
		return $part[1];	
		
	}
	
    
	// This function returns IVA
	function calculate_iva($iva,$fcost){			    

		$result = ($iva/100)*($fcost);
		return $result;	
		
	}
	
	// This function returns RIVA
	function calculate_riva($riva,$fcost){			

		$result = ($riva/100)*($fcost);
		return $result;	
		
	}
	
	// Insert Function
    function insert_batchexp_details($bid,$fcost,$iva,$riva){
		$query = $this->link->prepare("INSERT INTO pb_db.batchexp_acc (BatchId, FreighCost, iva, retiva) VALUES (?,?,?,?)");
		$values = array($bid,$fcost,$iva,$riva);
		$query->execute($values);				
    }	
}


$action = new prodreceiptActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(trim($_POST['cnum'] ?? '') == "Please Select from List"){
		
		$cnum = "10000000.10000000";
		$fcost = trim($_POST['fcost'] ?? '');
		$iva = trim($_POST['iva'] ?? '');
		$riva = trim($_POST['riva'] ?? '');
		echo $action->validate_prodreceipt_details($cnum,$fcost,$iva,$riva);	
		
	}else{
		
		$cnum = trim($_POST['cnum'] ?? '');
		$fcost = trim($_POST['fcost'] ?? '');
		$iva = trim($_POST['iva'] ?? '');
		$riva = trim($_POST['riva'] ?? '');
		echo $action->validate_prodreceipt_details($cnum,$fcost,$iva,$riva);	
		
	}	
	
	
}	


?>