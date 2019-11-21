<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
	//$motd_date = date("Y-m-d h:i:s A");
   	$rname = "";
	$rdesc = "";
	$default = "";
	$insert = "";
	$update = "";
	$delete = "";
	$view = "";
	
class roleActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates ROLES before Insert
	function validate_role($rname,$rdesc,$default,$insert,$update,$delete,$view) {
		
		if($rname == "Please Select Role from List"){
			echo "Please select ROLE NAME from list.";  
            exit;			
	    }elseif($this->check_role_exist($rname) >= 1){
			echo "ROLE exists in database";
			exit;
		}else{
			$totalPerm = $this->calculate_perms($default,$insert,$update,$delete,$view); 
			$this->insert_role($rname,$rdesc,$totalPerm);	
		}	
	}
	
	
// This function checks if ROLE exist in database
	function check_role_exist($rname){
		$query = $this->link->prepare("SELECT * FROM `userrole_adm` WHERE RoleName = ?");
     	$values = array($rname);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function calculates sum of permissions
	function calculate_perms($default,$insert,$update,$delete,$view){
		$query = $this->link->prepare("SELECT SUM(PermissionID) FROM `UserPermission_ADM` WHERE PermissionName = ? OR PermissionName = ? OR PermissionName = ? OR PermissionName = ? OR PermissionName = ?");
     	$values = array($default,$insert,$update,$delete,$view);
		try{
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_NUM);
			foreach($result as $val){
				foreach($val as $value){
					$totalPerm = $value[0];
				}					
			}						
		}catch (PDOException $e){die($e->getMessage());}
		return $totalPerm;
	}
	
// Insert Function
    function insert_role($rname,$rdesc,$totalPerm){
		$query = $this->link->prepare("INSERT INTO `UserRole_ADM` (RoleName, RoleDescription, PermissionID) VALUES (?,?,?)");
		$values = array($rname,$rdesc,$totalPerm);
		$query->execute($values);
		echo "MOTD added successfully";		
    }	
	
}

$data = new roleActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$rname = trim($_POST['rname'] ?? '');
	$rdesc = trim($_POST['rdesc'] ?? '');
	$default = trim($_POST['default'] ?? '');
	$insert = trim($_POST['insert'] ?? '');
	$update = trim($_POST['update'] ?? '');
	$delete = trim($_POST['delete'] ?? '');
	$view = trim($_POST['view'] ?? '');
	echo $data->validate_role($rname,$rdesc,$default,$insert,$update,$delete,$view);	
}	


?>