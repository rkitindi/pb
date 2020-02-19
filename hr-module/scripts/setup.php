<?php

		// Include config file
		require_once "class.config.php";

		class setupHR{

			public $link; 


			function __construct(){
				$db_connection = new dbConnection();
				$this->link = $db_connection->connect();   
				return $this->link;
			}
	
			function fetch_employee_list_emergency(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM EmergencyContact_HR)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
			
			function fetch_employee_list_dept(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM EmployeeDeptInfo_HR)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
	
			function fetch_department_list(){
				$val = array();
				$query = $this->link->prepare("SELECT DepartmentId, DepartmentName FROM  Department_HR");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}	

			function fetch_employmenttype_list(){
				$val = array();
				$query = $this->link->prepare("SELECT  EmpTypeId, EmploymentType FROM  `pb_db`.`EmploymentType_HR`");
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
			
			function fetch_manager_list($DID,$EID){

				$ret = array();
				$query = $this->link->prepare("SELECT EmployeeDeptInfo_HR.DepartmentId, EmployeeDeptInfo_HR.PositionTitle, PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM EmployeeDeptInfo_HR RIGHT JOIN PersonalInfo_HR ON PersonalInfo_HR.EmployeeId = EmployeeDeptInfo_HR.EmployeeId HAVING EmployeeDeptInfo_HR.DepartmentId = ? AND PersonalInfo_HR.EmployeeId <> ? ");
				try{
					$values = array($DID,$EID);
					$query->execute($values);
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
					foreach ($result as $key => $item){ 
						$list[] = $item;
						//$list = array($item['DepartmentId'],  $item['EmployeeId'],  $item['NAME']);
					}
				}catch (PDOException $e){die($e->getMessage());}
				return $list;
				
			}	
			
			function fetch_employee_list_etype(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM pb_db.PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM pb_db.EmploymentTypeInfo_HR);");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employee_list_sal(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM pb_db.PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM `pb_db`.`SalaryInfo_HR`)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
			
			function fetch_payschedule_list(){
				$query = $this->link->prepare(" SELECT * FROM `pb_db`.`PaymentSchedule_HR` ");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
			
			function fetch_employee_list_leave(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM pb_db.PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM `pb_db`.`LeaveInfo_HR`)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
			
			function fetch_leavetypes_list(){
				$query = $this->link->prepare(" SELECT * FROM `pb_db`.`LeaveType_HR` ");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
		
			function fetch_employee_list_binfo(){
				$query = $this->link->prepare("SELECT PersonalInfo_HR.EmployeeId, CONCAT(PersonalInfo_HR.FirstNames, ' ', PersonalInfo_HR.LastNames) AS NAME FROM pb_db.PersonalInfo_HR WHERE PersonalInfo_HR.EmployeeId NOT IN (SELECT EmployeeID FROM `pb_db`.`BankInfo_HR`)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);	
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}
			
			function check_etype_exist($etype){
				$query = $this->link->prepare("SELECT * FROM  `pb_db`.`EmploymentType_HR` WHERE EmploymentType = ?");
				$values = array($etype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts; 
			}
			
			function check_ptype_exist($ptype){
				$query = $this->link->prepare("SELECT * FROM `PaymentType_HR` WHERE PaymentType = ?");
				$values = array($ptype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts; 
			}	
			
			function check_payschedule_exist($payschedule){
				$query = $this->link->prepare("SELECT * FROM `PaymentSchedule_HR` WHERE PaymentSchedule = ?");
				$values = array($payschedule);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts; 
			}	
			

			function check_leavetype_exist($lvtype){
				$query = $this->link->prepare("SELECT * FROM `LeaveType_HR` WHERE LeaveType = ?");
				$values = array($lvtype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts; 
			}	
		
			function check_deptname_exist($deptname){
				$query = $this->link->prepare("SELECT * FROM `Department_HR` WHERE DepartmentName = ?");
				$values = array($deptname);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts; 
			}	
	
	
		}

		//Create Object 
		$fetch_info = new setupHR();

		// Receive variables from jquery and fetch data
		if(  isset($_POST['EID']) AND  isset($_POST['DID']) ){

			//$data = array();
			$EID = $_POST['EID'];
			$DID = $_POST['DID'];
			$depit = $fetch_info->fetch_manager_list($DID,$EID);
			$jqueryArray = json_encode($depit, JSON_PRETTY_PRINT);
			echo $jqueryArray;
			
		}
		
		// Check if Employment Type Exists
		if(  isset($_POST['ETYPE']) ){

			$etype = $_POST['ETYPE'];
			$check = $fetch_info->check_etype_exist($etype);
			echo $check;
			
		}
		
	    // Check if PTYPE exists
		if(  isset($_POST['ptype']) ){

			$ptype = $_POST['ptype'];
			$check = $fetch_info->check_ptype_exist($ptype);
			echo $check;
			
		}
		
	    // Check if PSCHEDULE exists
		if(  isset($_POST['payschedule']) ){

			$payschedule = $_POST['payschedule'];
			$check = $fetch_info->check_payschedule_exist($payschedule);
			echo $check;
			
		}

	    // Check if LEAVE TYPE exists
		if(  isset($_POST['lvtype']) ){

			$lvtype = $_POST['lvtype'];
			$check = $fetch_info->check_leavetype_exist($lvtype);
			echo $check;
			
		}
		
		// Check if deptname  exists
		if(  isset($_POST['deptname']) ){

			$deptname = $_POST['deptname'];
			$check = $fetch_info->check_deptname_exist($deptname);
			echo $check;
			
		}
		

?>