<?php
// Include config file
require_once "class.config.php";


class setupPRODUCTION{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	function fetch_supcat_list(){
		$query = $this->link->prepare("SELECT CategoryId, CategoryName FROM  `SupplierCategory_PROD`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
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
	
}

?>