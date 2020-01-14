<?php
// Include config file
require_once "class.config.php";


class queryADMIN{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
    function fetch_employee_list(){
		$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM UserDetails_ADM);");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_MOTD(){
		$query = $this->link->prepare("SELECT Message FROM `pb_db`.`MOTD_ADM` ORDER BY MessageID DESC LIMIT 1");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){ 
				$msg = $item['Message'];									  
			}
		}catch (PDOException $e){die($e->getMessage());}
		return $msg;
	}
	
	function fetch_pos_list(){
		$query = $this->link->prepare("SELECT  `pb_db`.`POSInfo_SAL`.POSId, `pb_db`.`POSInfo_SAL`.POSName FROM  `pb_db`.`POSInfo_SAL`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_accounting_dispatched_list($posid){
		
		$query = $this->link->prepare("SELECT DispatchProduct_ACC.DispatchRefNum, DispatchProduct_ACC.Quantity AS Dispatched, ReceiveProduct_ACC.ProductCode FROM DispatchProduct_ACC, ReceiveProduct_ACC WHERE (ReceiveProduct_ACC.ProductReceiptNumber = DispatchProduct_ACC.ProductReceiptNumber) AND (DispatchProduct_ACC.POSId = ?) AND (DispatchProduct_ACC.DispatchRefNum NOT IN (SELECT DispatchRefNum FROM ProductReceived_SAL))");
     	try{
			$values = array($posid);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_role_list(){
		$query = $this->link->prepare("select * from UserRole_ADM;");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	
	
	
	
	function fetch_batchnumber_cycle_list(){
		
		$query = $this->link->prepare("select BatchDetails_ACC.ControlNumber, BatchDetails_ACC.RangeCycle, BatchDetails_ACC.ProductCount, (BatchDetails_ACC.ProductCount - COUNT(ReceiveProduct_ACC.ProductCode)) AS Remain FROM ReceiveProduct_ACC RIGHT JOIN BatchDetails_ACC ON BatchDetails_ACC.BatchId=ReceiveProduct_ACC.BatchId GROUP BY 1 HAVING COUNT(ReceiveProduct_ACC.ProductCode) < BatchDetails_ACC.ProductCount ORDER BY ReceiveProduct_ACC.ProductCode ASC");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	
	
    function fetch_product_receiptnumber_list(){
		
		$query = $this->link->prepare("select ReceiveProduct_ACC.ProductReceiptNumber, (ReceiveProduct_ACC.Quantity - SUM(DispatchProduct_ACC.Quantity)) AS Stock FROM DispatchProduct_ACC RIGHT JOIN ReceiveProduct_ACC ON ReceiveProduct_ACC.ProductReceiptNumber=DispatchProduct_ACC.ProductReceiptNumber GROUP BY 1");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_pointofsale_list(){
		$query = $this->link->prepare("SELECT  `pb_db`.`POSInfo_SAL`.POSId, `pb_db`.`POSInfo_SAL`.POSName FROM  `pb_db`.`POSInfo_SAL`");
     	try{
			$query->execute();
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