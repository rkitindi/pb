<?php

// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	$insert_date = date("Y-m-d h:i:s A");
   	$prid = "";
	$quantity = "";
	$deff = "";
	$rdate = "";
	$comment = "";

	
class deffectiveproductActions{

    public $link; 

    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates deffectiveproduct DETAILS before Insert

	function validate_deffectiveproduct_details($prid,$quantity,$deff,$rdate,$comment){
		
		$today = date("Y-m-d");
		
		if($prid == "Please Select from List"){
			echo "Select PRODUCT you want to REPORT DEFFECTIVE a list";  
            exit;			
	    }elseif(empty($quantity)){
			echo "SPECIFY how many boxes are deffective, please!";
			exit;
		}elseif(!is_integer($quantity) && $quantity <= 0){
			echo "QUANTITY must be POSITIVE NUMBER";  
            exit;			
	    }elseif(empty($deff)){
			echo "CONFIRMATION is needed";	
			exit;
		}else{
			
			$stock = $this->fetch_stock($prid);
			
			if ($quantity > $stock){
				
				echo "You cannot report:  ".$quantity."  boxes are deffective, more than: ".$stock."  boxes in stock.";
				exit;
				
			}elseif($deff == "N" and empty($comment)){
				
				echo "Explain on comments why not confirmed to be deffective";
				exit;
				
			}else{
				
				$this->insert_deffectiveproduct_details($prid,$quantity,$deff,$rdate,$comment);	
				echo "RECORD added successfully!!!";
				
			}		

		}
	}

   // This Fetch Available Product Stock	
	function fetch_stock($prid){
		
		$query = $this->link->prepare("select productreceived_sal.ProductReceiptId, dispatchproduct_acc.POSId, receiveproduct_acc.ProductCode, (productreceived_sal.Quantity - COALESCE(SUM(saleproductreceived_sal.Quantity),0) - COALESCE(SUM(DISTINCT registerdeffectiveprod_sal.Quantity),0)) AS Stock FROM productreceived_sal LEFT JOIN saleproductreceived_sal ON saleproductreceived_sal.ProductReceiptId = productreceived_sal.ProductReceiptId LEFT JOIN registerdeffectiveprod_sal ON registerdeffectiveprod_sal.ProductReceiptId = productreceived_sal.ProductReceiptId JOIN dispatchproduct_acc ON dispatchproduct_acc.DispatchRefNum = productreceived_sal.DispatchRefNum JOIN receiveproduct_acc ON receiveproduct_acc.ProductReceiptNumber = dispatchproduct_acc.ProductReceiptNumber GROUP BY 1 HAVING Stock > 0 AND productreceived_sal.ProductReceiptId = ?");
		try{
			$values = array($prid);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$stock = $item['Stock'];		
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $stock;
	} 
	
    // Insert Function
    function insert_deffectiveproduct_details($prid,$quantity,$deff,$rdate,$comment){
		$query = $this->link->prepare("INSERT  INTO  pb_db.registerdeffectiveprod_sal (ProductReceiptId, Quantity, Confirmation, DateReported, Comments) VALUES (?,?,?,?,?)");
		$values = array($prid,$quantity,$deff,$rdate,$comment);
		$query->execute($values);				
    }	
	
}


$action = new deffectiveproductActions();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$prid = trim($_POST['prid'] ?? '');
	$quantity = trim($_POST['quantity'] ?? '');
	$deff = trim($_POST['deff'] ?? '');		
	$comment = trim($_POST['comment'] ?? '');
 
	echo $action->validate_deffectiveproduct_details($prid,$quantity,$deff,$rdate,$comment);	

}	


?>