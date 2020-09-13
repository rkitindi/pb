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
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM emergencycontact_hr)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employee_list_dept(){
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM employeedeptinfo_hr)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_department_list(){
				$val = array();
				$query = $this->link->prepare("SELECT DepartmentId, DepartmentName FROM  department_hr");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employmenttype_list(){
				$val = array();
				$query = $this->link->prepare("SELECT  EmpTypeId, EmploymentType FROM  pb_db.employmenttype_hr");
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
				$query = $this->link->prepare("SELECT department_hr.DepartmentName AS D_NAME FROM pb_db.department_hr JOIN pb_db.personalinfo_hr ON pb_db.personalinfo_hr.DepartmentId = pb_db.department_hr.DepartmentId  WHERE pb_db.personalinfo_hr.EmployeeId = ?");
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

			function fetch_manager_list($DID,$EID){

				$ret = array();
				$query = $this->link->prepare("SELECT employeedeptinfo_hr.DepartmentId, employeedeptinfo_hr.PositionTitle, personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM employeedeptinfo_hr RIGHT JOIN personalinfo_hr ON personalinfo_hr.EmployeeId = employeedeptinfo_hr.EmployeeId HAVING employeedeptinfo_hr.DepartmentId = ? AND personalinfo_hr.EmployeeId <> ? ");
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
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM pb_db.personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM pb_db.EmploymentTypeInfo_HR);");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employee_list_sal(){
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM pb_db.personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM pb_db.salaryinfo_hr)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_payschedule_list(){
				$query = $this->link->prepare(" SELECT * FROM pb_db.paymentschedule_hr ");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employee_list_leave(){
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM pb_db.personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM pb_db.leaveinfo_hr)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_leavetypes_list(){
				$query = $this->link->prepare(" SELECT * FROM pb_db.leavetype_hr ");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function fetch_employee_list_binfo(){
				$query = $this->link->prepare("SELECT personalinfo_hr.EmployeeId, CONCAT(personalinfo_hr.FirstNames, ' ', personalinfo_hr.LastNames) AS NAME FROM pb_db.personalinfo_hr WHERE personalinfo_hr.EmployeeId NOT IN (SELECT EmployeeID FROM pb_db.bankinfo_hr)");
				try{
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){die($e->getMessage());}
				return $result;
			}

			function check_etype_exist($etype){
				$query = $this->link->prepare("SELECT * FROM  pb_db.employmenttype_hr WHERE EmploymentType = ?");
				$values = array($etype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;
			}

			function check_ptype_exist($ptype){
				$query = $this->link->prepare("SELECT * FROM paymenttype_hr` WHERE PaymentType = ?");
				$values = array($ptype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;
			}

			function check_payschedule_exist($payschedule){
				$query = $this->link->prepare("SELECT * FROM paymentschedule_hr WHERE PaymentSchedule = ?");
				$values = array($payschedule);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;
			}


			function check_leavetype_exist($lvtype){
				$query = $this->link->prepare("SELECT * FROM leavetype_hr WHERE LeaveType = ?");
				$values = array($lvtype);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;
			}

			function check_deptname_exist($deptname){
				$query = $this->link->prepare("SELECT * FROM department_hr WHERE DepartmentName = ?");
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
