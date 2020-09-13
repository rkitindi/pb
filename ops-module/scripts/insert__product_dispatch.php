<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$prrn = "";
	$pos = "";
	$quantity = "";
	$ddisp = "";
	$dispatch = "";
	$comm = "";
	
class proddispatchActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates proddispatch DETAILS before Insert

	function validate_proddispatch_details($prrn,$pos,$quantity,$ddisp,$dispatch,$comm){
		
		$today = date("Y-m-d");
		
		if($prrn == "Please Select from List"){
			echo "Select PRODUCT CODE from a list";  
            exit;			
	    }elseif($pos == "Please Select from List"){
			echo "Select POINT OF SALE from the list";  
            exit;			
	    }elseif(empty($quantity)){
			echo "QUANTITY cannot be empty";	
			exit;
		}elseif(!is_integer($quantity) && $quantity <= 0){
			echo "QUANTITY must be POSITIVE NUMBER";  
            exit;			
	    }elseif(empty($ddisp)){			
			echo "DISPATCH DATE cannot be empty";
			exit;			
		}elseif( $ddisp > $today ){			
			echo "DISPATCH DATE cannot be later than TODAY";
			exit;			
		}elseif(empty($dispatch)){
			echo "Confirmation is needed";	
			exit;
		}else{
			
			$stock = $this->fetch_available_stock($prrn);
			$record_exists = $this->check_record_exists($prrn,$pos);
			
			if ($quantity > $stock){
				
				echo "You cannot dispatching:  ".$quantity."  boxes, more than available stock: ".$stock ."  boxes";
				exit;
				
			}elseif($dispatch == "N" and empty($comm)){
				
				echo "Please explain why not dispatched in comments";
				exit;
				
			}elseif($record_exists == "TRUE"){
				
				echo "Your already dispatched this product to this POINT of SALE, Please dispatch to another Point of Sale";
				exit;
				
			}else{
				
				$ddisp = date('Y-m-d', strtotime($ddisp));
				$this->insert_proddispatch_details($prrn,$pos,$quantity,$ddisp,$dispatch,$comm);	
				echo "PRODUCT  DISPATCH RECORD added successfully";
				
			}		

		}
	}

   // This Fetch Available Product Stock	
	function fetch_available_stock($prrn){
		
		$query = $this->link->prepare("SELECT (receiveproduct_acc.Quantity - COALESCE(SUM(dispatchproduct_acc.Quantity),0)) AS Stock FROM dispatchproduct_acc RIGHT JOIN receiveproduct_acc on dispatchproduct_acc.ProductReceiptNumber = receiveproduct_acc.ProductReceiptNumber WHERE receiveproduct_acc.ProductReceiptNumber = ?");
		try{
			$values = array($prrn);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$stock = $item['Stock'];		
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $stock;
	} 
	
	// This Check If Record Exists	
	function check_record_exists($prrn,$pos){
		
		$query = $this->link->prepare("select * from pb_db.dispatchproduct_acc WHERE ProductReceiptNumber=? AND POSId=?");
		try{
			$values = array($prrn,$pos);
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
    function insert_proddispatch_details($prrn,$pos,$quantity,$ddisp,$dispatch,$comm){
		$query = $this->link->prepare("INSERT  INTO  pb_db.dispatchproduct_acc (ProductReceiptNumber, POSId, Quantity, DateDispatched, Dispatched, Comments) VALUES (?,?,?,?,?,?)");
		$values = array($prrn,$pos,$quantity,$ddisp,$dispatch,$comm);
		$query->execute($values);				
    }	
}


$action = new proddispatchActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$prrn = trim($_POST['prrn'] ?? '');
		$pos = trim($_POST['pos'] ?? '');
		$quantity = trim($_POST['quantity'] ?? '');
		$ddisp = trim($_POST['ddisp'] ?? '');
		$dispatch = trim($_POST['dispatch'] ?? '');		
		$comm = trim($_POST['comm'] ?? '');
		
		echo $action->validate_proddispatch_details($prrn,$pos,$quantity,$ddisp,$dispatch,$comm);	

}	


?>