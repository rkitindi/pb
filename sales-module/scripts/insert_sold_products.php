<?php

// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	$insert_date = date("Y-m-d h:i:s A");
   	$prid = "";
	$quantity = "";
	$price = "";
	$pmet = "";
	$cname = "";
	$sdate = "";
	
class soldproductActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates soldproduct DETAILS before Insert

	function validate_soldproduct_details($prid,$quantity,$price,$pmet,$cname,$sdate,$insert_date){
		
		$today = date("Y-m-d");
		
		if($prid == "Please Select from List"){
			echo "Select PRODUCT you want to sell from a list";  
            exit;			
	    }elseif(empty($quantity)){
			echo "QUANTITY cannot be empty";
			exit;
		}elseif(!is_integer($quantity) && $quantity <= 0){
			echo "QUANTITY must be POSITIVE NUMBER";  
            exit;			
	    }elseif(empty($price)){			
			echo "Selling Price cannot be empty";
			exit;			
		}elseif(!is_integer($price) && $price <= 0){
			echo "Selling Price must be POSITIVE NUMBER";  
            exit;			
	    }elseif(empty($pmet)){
			echo "Payment Method is needed";	
			exit;
		}elseif(empty($sdate)){
			echo "Sales Date cannot be empty";	
			exit;
		}elseif( $sdate > $today ){			
			echo "Sales DATE cannot be later than TODAY";
			exit;			
		}else{
			
			$stock = $this->fetch_stock($prid);
			
			if ($quantity > $stock){
				
				echo "You cannot sell:  ".$quantity."  boxes, more than: ".$stock."  boxes in stock.";
				exit;
				
			}elseif($pmet == "credit" and $cname == "Please Select from List"){
				
				echo "You must fill customer name for all credit sales";
				exit;
				
			}elseif($pmet == "cash" and $cname == "Please Select from List"){
				
				$cname = "general";
				$sdate= date('Y-m-d', strtotime($sdate));
				$this->insert_soldproduct_details($prid,$quantity,$price,$sdate,$pmet,$cname,$insert_date);	
				echo "RECORD added successfully!!!";
				exit;
				
			}else{
				
				$sdate= date('Y-m-d', strtotime($sdate));
				$this->insert_soldproduct_details($prid,$quantity,$price,$sdate,$pmet,$cname,$insert_date);	
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
    function insert_soldproduct_details($prid,$quantity,$price,$sdate,$pmet,$cname,$insert_date){
		$query = $this->link->prepare("INSERT  INTO  pb_db.saleproductreceived_sal (ProductReceiptId, Quantity, UnitPrice, SalesDate, PaymentMethod, CustomerID, RecordInsertDate) VALUES (?,?,?,?,?,?,?)");
		$values = array($prid,$quantity,$price,$sdate,$pmet,$cname,$insert_date);
		$query->execute($values);				
    }	
}


$action = new soldproductActions();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$prid = trim($_POST['prid'] ?? '');
	$quantity = trim($_POST['quantity'] ?? '');
	$price = trim($_POST['price'] ?? '');
	$pmet = trim($_POST['pmet'] ?? '');		
	$cname = trim($_POST['cname'] ?? '');
	$sdate = trim($_POST['sdate'] ?? '');	
 
	echo $action->validate_soldproduct_details($prid,$quantity,$price,$pmet,$cname,$sdate,$insert_date);	

}	


?>