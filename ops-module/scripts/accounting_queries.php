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
		
		$query = $this->link->prepare("select batchdetails_acc.ControlNumber, batchdetails_acc.RangeCycle, batchdetails_acc.ProductCount, (batchdetails_acc.ProductCount - COUNT(receiveproduct_acc.ProductCode)) AS Remain FROM receiveproduct_acc RIGHT JOIN batchdetails_acc ON batchdetails_acc.BatchId=receiveproduct_acc.BatchId GROUP BY 1 HAVING COUNT(receiveproduct_acc.ProductCode) < batchdetails_acc.ProductCount ORDER BY receiveproduct_acc.ProductCode ASC");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}	
	
    function fetch_product_receiptnumber_list(){
		
		$query = $this->link->prepare("SELECT receiveproduct_acc.ProductReceiptNumber, receiveproduct_acc.ProductCode, batchdetails_acc.ControlNumber, (receiveproduct_acc.Quantity - COALESCE(SUM(dispatchproduct_acc.Quantity),0)) AS Stock FROM dispatchproduct_acc RIGHT JOIN receiveproduct_acc on dispatchproduct_acc.ProductReceiptNumber = receiveproduct_acc.ProductReceiptNumber JOIN batchdetails_acc ON receiveproduct_acc.BatchId = batchdetails_acc.BatchId  GROUP BY 1 HAVING Stock > 0");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_pointofsale_list(){
		$query = $this->link->prepare("SELECT  pb_db.posinfo_sal.POSId, pb_db.posinfo_sal.POSName FROM  pb_db.posinfo_sal");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_batchnumber_cycle_exp_list(){
		
		$query = $this->link->prepare("select receiveproduct_acc.BatchId, batchdetails_acc.ControlNumber, batchdetails_acc.RangeCycle, batchdetails_acc.ProductCount, (batchdetails_acc.ProductCount - COUNT(receiveproduct_acc.ProductCode)) AS Remain FROM receiveproduct_acc RIGHT JOIN batchdetails_acc ON batchdetails_acc.BatchId=receiveproduct_acc.BatchId GROUP BY 1 HAVING receiveproduct_acc.BatchId NOT IN (SELECT  BatchId FROM  pb_db.batchexp_acc)");
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
		$query = $this->link->prepare("SELECT Department_HR.DepartmentName AS D_NAME FROM pb_db.department_hr JOIN pb_db.employeedeptinfo_hr ON pb_db.employeedeptinfo_hr.DepartmentId = pb_db.department_hr.DepartmentId  WHERE pb_db.employeedeptinfo_hr.EmployeeId = ?");
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



	





	
	
	
	function get_product_dispatched_count(){
		
		$query = $this->link->prepare("SELECT pb_db.batchdetails_acc.ProductCount FROM pb_db.batchdetails_acc, pb_db.receiveproduct_acc WHERE pb_db.batchdetails_acc.BatchId = pb_db.receiveproduct_acc.BatchId");
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
		
		$query = $this->link->prepare("SELECT COUNT(pb_db.receiveproduct_acc.ProductCode) AS RECEIVED FROM pb_db.receiveproduct_acc, pb_db.batchdetails_acc  WHERE pb_db.receiveproduct_acc.BatchId = pb_db.batchdetails_acc.BatchId");
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
		$query = $this->link->prepare("SELECT BrandId, BrandName FROM  productbrand_rod");
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
		$query = $this->link->prepare("SELECT pb_db.iruckinfo_prod.RegNumber, pb_db.supplierinfo_prod.BusinessName FROM pb_db.iruckinfo_prod, pb_db.supplierinfo_prod WHERE pb_db.iruckinfo_prod.SupplierId  = pb_db.supplierinfo_prod.SupplierId; ");
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
	
}

?>