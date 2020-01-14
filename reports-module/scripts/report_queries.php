<?php
// Include config file
require_once "class.config.php";


class queryREPORTS{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    function fetch_employee_list(){
		$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(FirstNames, ' ', LastNames) AS NAME FROM `pb_db`.`PersonalInfo_HR` WHERE DepartmentId = 5");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
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
		$query = $this->link->prepare("SELECT Department_HR.DepartmentName AS D_NAME FROM `pb_db`.`Department_HR` JOIN `pb_db`.`PersonalInfo_HR` ON `pb_db`.`PersonalInfo_HR`.DepartmentId = `pb_db`.`Department_HR`.DepartmentId  WHERE `pb_db`.`PersonalInfo_HR`.EmployeeId = ?");
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

	function fetch_pos_id($e_id){
		$query = $this->link->prepare("SELECT  `pb_db`.`POSInfo_SAL`.POSId  FROM  `pb_db`.`POSInfo_SAL` WHERE EmployeeID = ?");
     	try{
			$values = array($e_id);
			$query->execute($values);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $key => $item){ 
				$posid = $item['POSId'];	
				return $posid;
			}			
		}catch (PDOException $e){die($e->getMessage());}
	
	}

	function fetch_pcode_list($posid){
		
		$query = $this->link->prepare("select ProductReceived_SAL.ProductReceiptId, DispatchProduct_ACC.POSId, ReceiveProduct_ACC.ProductCode, (ProductReceived_SAL.Quantity - COALESCE(SUM(SaleProductReceived_SAL.Quantity),0) - COALESCE(SUM(DISTINCT RegisterDeffectiveProd_SAL.Quantity),0)) AS Stock FROM ProductReceived_SAL LEFT JOIN SaleProductReceived_SAL ON SaleProductReceived_SAL.ProductReceiptId = ProductReceived_SAL.ProductReceiptId LEFT JOIN RegisterDeffectiveProd_SAL ON RegisterDeffectiveProd_SAL.ProductReceiptId = ProductReceived_SAL.ProductReceiptId JOIN DispatchProduct_ACC ON DispatchProduct_ACC.DispatchRefNum = ProductReceived_SAL.DispatchRefNum JOIN ReceiveProduct_ACC ON ReceiveProduct_ACC.ProductReceiptNumber = DispatchProduct_ACC.ProductReceiptNumber GROUP BY 1 HAVING Stock > 0 AND DispatchProduct_ACC.POSId = ?");
     	try{
			$values = array($posid);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_product_price($pcode){
			
		$query = $this->link->prepare("select SellingPrice FROM `pb_db`.`ProductInfo_PROD` WHERE ProductCode = ?");
     	try{
			$values = array($pcode);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){ 
				$price = $item['SellingPrice'];	
				return $price;
			}			
		}catch (PDOException $e){die($e->getMessage());}
		
		
	}	
	
	function fetch_customer_list(){
		$query = $this->link->prepare("select CustomerId, BusinessName from `pb_db`.`CustomerDetails_SAL`");
     	try{
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);	
		}catch (PDOException $e){die($e->getMessage());}
		return $result;
	}
	
	function fetch_customer_debt($srn){
			
		$query = $this->link->prepare("SELECT SaleProductReceived_SAL.SalesRef, (SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) AS TOTAL, COALESCE(SUM(CollectPayment_SAL.Amount),0) as PAID, ((SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) - COALESCE(SUM(CollectPayment_SAL.Amount),0)) AS DEBT, CustomerDetails_SAL.ContactName, SaleProductReceived_SAL.PaymentMethod, DispatchProduct_ACC.POSId FROM SaleProductReceived_SAL LEFT JOIN CollectPayment_SAL ON CollectPayment_SAL.SalesRef = SaleProductReceived_SAL.SalesRef JOIN CustomerDetails_SAL ON CustomerDetails_SAL.CustomerId = SaleProductReceived_SAL.CustomerId JOIN ProductReceived_SAL ON ProductReceived_SAL.ProductReceiptId = SaleProductReceived_SAL.ProductReceiptId JOIN DispatchProduct_ACC ON DispatchProduct_ACC.DispatchRefNum = ProductReceived_SAL.DispatchRefNum GROUP BY 1 HAVING SaleProductReceived_SAL.PaymentMethod = 'credit' AND DEBT > 0 AND SaleProductReceived_SAL.SalesRef = ?");
     	try{
			$values = array($srn);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){ 
				$tobepaid = $item['DEBT'];	
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $tobepaid;
		
	}

	function fetch_sales_ref_number($posid){
		$query = $this->link->prepare("SELECT SaleProductReceived_SAL.SalesRef, (SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) AS TOTAL, COALESCE(SUM(CollectPayment_SAL.Amount),0) as PAID, ((SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) - COALESCE(SUM(CollectPayment_SAL.Amount),0)) AS DEBT, CustomerDetails_SAL.ContactName, SaleProductReceived_SAL.PaymentMethod, DispatchProduct_ACC.POSId FROM SaleProductReceived_SAL LEFT JOIN CollectPayment_SAL ON CollectPayment_SAL.SalesRef = SaleProductReceived_SAL.SalesRef JOIN CustomerDetails_SAL ON CustomerDetails_SAL.CustomerId = SaleProductReceived_SAL.CustomerId JOIN ProductReceived_SAL ON ProductReceived_SAL.ProductReceiptId = SaleProductReceived_SAL.ProductReceiptId JOIN DispatchProduct_ACC ON DispatchProduct_ACC.DispatchRefNum = ProductReceived_SAL.DispatchRefNum GROUP BY 1 HAVING SaleProductReceived_SAL.PaymentMethod = 'credit' AND DEBT > 0 AND DispatchProduct_ACC.POSId = ?");
     	try{
			$values = array($posid);
			$query->execute($values);
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

//Create Object 
$selling_price = new queryREPORTS();
$fetch_debt = new queryREPORTS();


//if(!empty($_POST)){
if(isset($_POST['name'])){
    $pieces = explode(" ", $_POST['name']);
	$pcode = trim($pieces[1]);
	$price = $selling_price->fetch_product_price($pcode);
	echo $price;
}

if(isset($_POST['SRN'])){
	$srn = $_POST['SRN'];
	$debpt = $fetch_debt->fetch_customer_debt($srn);
	echo $debpt;
}

?>