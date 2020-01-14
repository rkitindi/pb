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
		
		$query = $this->link->prepare("select ProductReceived_SAL.ProductReceiptId, DispatchProduct_ACC.POSId, ReceiveProduct_ACC.ProductCode, (ProductReceived_SAL.Quantity - COALESCE(SUM(SaleProductReceived_SAL.Quantity),0) - COALESCE(SUM(DISTINCT RegisterDeffectiveProd_SAL.Quantity),0)) AS Stock FROM ProductReceived_SAL LEFT JOIN SaleProductReceived_SAL ON SaleProductReceived_SAL.ProductReceiptId = ProductReceived_SAL.ProductReceiptId LEFT JOIN RegisterDeffectiveProd_SAL ON RegisterDeffectiveProd_SAL.ProductReceiptId = ProductReceived_SAL.ProductReceiptId JOIN DispatchProduct_ACC ON DispatchProduct_ACC.DispatchRefNum = ProductReceived_SAL.DispatchRefNum JOIN ReceiveProduct_ACC ON ReceiveProduct_ACC.ProductReceiptNumber = DispatchProduct_ACC.ProductReceiptNumber GROUP BY 1 HAVING Stock > 0 AND ProductReceived_SAL.ProductReceiptId = ?");
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
		$query = $this->link->prepare("INSERT  INTO  `pb_db`.`SaleProductReceived_SAL` (ProductReceiptId, Quantity, UnitPrice, SalesDate, PaymentMethod, CustomerID, RecordInsertDate) VALUES (?,?,?,?,?,?,?)");
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