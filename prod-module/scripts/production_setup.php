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
	
	function fetch_role_name($r_id){
		$query = $this->link->prepare("select RoleName from `pb_db`.`UserRole_ADM` where RoleID = ?");
     	try{
			$values = array($r_id);
			$query->execute($values);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $key => $item){ 
				$rname = $item['RoleName'];	
				return $rname;				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
	}
	
    function fetch_user_dept($e_id){
		$query = $this->link->prepare("SELECT Department_HR.DepartmentName AS D_NAME FROM `pb_db`.`Department_HR` JOIN `pb_db`.`EmployeeDeptInfo_HR` ON `pb_db`.`EmployeeDeptInfo_HR`.DepartmentId = `pb_db`.`Department_HR`.DepartmentId  WHERE `pb_db`.`EmployeeDeptInfo_HR`.EmployeeId = ?");
     	try{
			$values = array($e_id);
			$query->execute($values);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $key => $item){ 
				$dname = $item['D_NAME'];	
				return $dname;				
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
	}	

	function fetch_user_permission($r_id){
		// set array
		$perm_list = array();
		$query = $this->link->prepare("select `Role_Perm_ADM`.PermissionName AS PERM FROM `pb_db`.`Role_Perm_ADM` JOIN `pb_db`.`UserRole_ADM` ON `pb_db`.`UserRole_ADM`.RoleName = `pb_db`.`Role_Perm_ADM`.RoleName WHERE `pb_db`.`UserRole_ADM`.RoleID = ?");
     	try{
			$values = array($r_id);
			$query->execute($values);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $key => $item){ 
				$perm_list[] = $item['PERM'];	
				return $perm_list;
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
	}
	
}

?>