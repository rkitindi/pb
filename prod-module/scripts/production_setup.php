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
		$query = $this->link->prepare("SELECT CategoryId, CategoryName FROM  suppliercategory_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	

	function fetch_expensetype_list(){
		$query = $this->link->prepare("SELECT  ExpTypeId, ExpenseType FROM  expensetype_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	
	
	function fetch_banana_farmer_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 3");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
		function fetch_truck_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 1");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_case_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 2");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_banana_reseller_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 4");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
		
	function fetch_pesticide_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 5");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_fertilizer_supplier_list(){
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 6");
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
		$query = $this->link->prepare("SELECT SupplierId, BusinessName FROM  supplierinfo_prod WHERE CategoryId = 3 or CategoryId = 4");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_truck_list(){
		$query = $this->link->prepare("SELECT pb_db.truckinfo_prod.RegNumber, pb_db.supplierinfo_prod.BusinessName FROM pb_db.truckinfo_prod, pb_db.supplierinfo_prod WHERE pb_db.truckinfo_prod.SupplierId  = pb_db.supplierinfo_prod.SupplierId; ");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_product_code_list(){
		$query = $this->link->prepare("SELECT ProductCode FROM  pb_db.productinfo_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
    function fetch_farmname_list(){
		$query = $this->link->prepare("SELECT FarmId, FarmName FROM  pb_db.farminfo_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_casename_list(){
		$query = $this->link->prepare("SELECT CaseCode, CaseName FROM  pb_db.casedetails_prod");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_MOTD(){
		$query = $this->link->prepare("SELECT Message FROM pb_db.motd_adm ORDER BY MessageID DESC LIMIT 1");
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
		$query = $this->link->prepare("select RoleName from pb_db.userrole_adm where RoleID = ?");
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
		$query = $this->link->prepare("SELECT department_hr.DepartmentName AS D_NAME FROM pb_db.department_hr JOIN pb_db.employeedeptinfo_hr ON pb_db.employeedeptinfo_hr.DepartmentId = pb_db.department_hr.DepartmentId  WHERE pb_db.employeedeptinfo_hr.EmployeeId = ?");
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
		$query = $this->link->prepare("select role_perm_adm.PermissionName AS PERM FROM pb_db.role_perm_adm JOIN pb_db.userrole_adm ON pb_db.userrole_adm.RoleName = pb_db.role_perm_adm.RoleName WHERE pb_db.userrole_adm.RoleID = ?");
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