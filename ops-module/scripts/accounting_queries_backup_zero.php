<?php
// Include config file
require_once "class.config.php";


class queryACCOUNTING{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
		
	function fetch_batchnumber_cycle_list(){
		
		$dispatched = $this->get_product_dispatched_count();
		$received = $this->get_product_received_count();
		
		$query = $this->link->prepare("SELECT `pb_db`.`BatchDetails_ACC`.ControlNumber, `pb_db`.`BatchDetails_ACC`.RangeCycle, `pb_db`.`BatchDetails_ACC`.ProductCount  FROM `pb_db`.`BatchDetails_ACC` WHERE (`pb_db`.`BatchDetails_ACC`.BatchId NOT IN (SELECT `pb_db`.`ReceiveProduct_ACC`.BatchId FROM `pb_db`.`ReceiveProduct_ACC` WHERE `pb_db`.`ReceiveProduct_ACC`.BatchId IS NOT NULL)) OR (? <= ?)");
		$values = array($received,$dispatched);
     	try{
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	
	
	function get_product_dispatched_count(){
		
		$query = $this->link->prepare("SELECT `pb_db`.`BatchDetails_ACC`.ProductCount FROM `pb_db`.`BatchDetails_ACC`, `pb_db`.`ReceiveProduct_ACC` WHERE `pb_db`.`BatchDetails_ACC`.BatchId = `pb_db`.`ReceiveProduct_ACC`.BatchId");
		try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$b = $item['ProductCount'];				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $b;
	} 
	
	function get_product_received_count(){
		
		$query = $this->link->prepare("SELECT COUNT(`pb_db`.`ReceiveProduct_ACC`.ProductCode) AS RECEIVED FROM `pb_db`.`ReceiveProduct_ACC`, `pb_db`.`BatchDetails_ACC`  WHERE `pb_db`.`ReceiveProduct_ACC`.BatchId = `pb_db`.`BatchDetails_ACC`.BatchId");
		try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$a = $item['RECEIVED'];				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $a;
	} 

	function fetch_expensetype_list(){
		$query = $this->link->prepare("SELECT  ExpTypeId, ExpenseType FROM  `ExpenseType_PROD`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	
	
	function fetch_banana_farmer_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 3");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
		function fetch_truck_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 1");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_case_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 2");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_banana_reseller_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 4");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
		
	function fetch_pesticide_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 5");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_fertilizer_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 6");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_quality_list(){
		$query = $this->link->prepare("SELECT QualityId, QualityName FROM  productquality_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_product_brand_list(){
		$query = $this->link->prepare("SELECT BrandId, BrandName FROM  ProductBrand_Prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_allproduct_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  `SupplierInfo_PROD` WHERE CategoryId = 3 or CategoryId = 4");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_truck_list(){
		$query = $this->link->prepare("SELECT `pb_db`.`TruckInfo_PROD`.RegNumber, `pb_db`.`SupplierInfo_PROD`.BusinessName FROM `pb_db`.`TruckInfo_PROD`, `pb_db`.`SupplierInfo_PROD` WHERE `pb_db`.`TruckInfo_PROD`.SupplierId  = `pb_db`.`SupplierInfo_PROD`.SupplierId; ");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_product_code_list(){
		$query = $this->link->prepare("SELECT ProductCode FROM  `pb_db`.`ProductInfo_PROD`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
    function fetch_farmname_list(){
		$query = $this->link->prepare("SELECT FarmId, FarmName FROM  `pb_db`.`FarmInfo_PROD`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_casename_list(){
		$query = $this->link->prepare("SELECT CaseCode, CaseName FROM  `pb_db`.`CaseDetails_PROD`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
}

?>