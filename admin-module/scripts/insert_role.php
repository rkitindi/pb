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
			
			$this->insert_role($rname,$rdesc);
			
            if(!empty($default)){
				$this->insert_role_perm_1($rname,$default);
			}
			
			if(!empty($insert)){				
				$this->insert_role_perm_2($rname,$insert);				
			}
			
			if(!empty($update)){
				$this->insert_role_perm_3($rname,$update);				
			}
			
			if(!empty($delete)){
				$this->insert_role_perm_4($rname,$delete);
			}
			
			if(!empty($view)){
				$this->insert_role_perm_5($rname,$view);
			}
			
			echo "Role ".$rname." Inserted Successfully!";
			
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
	
	
   // Insert Role Function
    function insert_role($rname,$rdesc){
		$query = $this->link->prepare("INSERT INTO `UserRole_ADM` (RoleName, RoleDescription) VALUES (?,?)");
		$values = array($rname,$rdesc);
		$query->execute($values);		
    }	
	
	// Insert Role_Perm Function
    function insert_role_perm_1($rname,$default){
		$query = $this->link->prepare("INSERT INTO `Role_Perm_ADM` (RoleName, PermissionName) VALUES (?,?)");
		$values = array($rname,$default);
		$query->execute($values);		
    }
	
	// Insert Role_Perm Function
    function insert_role_perm_2($rname,$insert){
		$query = $this->link->prepare("INSERT INTO `Role_Perm_ADM` (RoleName, PermissionName) VALUES (?,?)");
		$values = array($rname,$insert);
		$query->execute($values);		
    }
	
	// Insert Role_Perm Function
    function insert_role_perm_3($rname,$update){
		$query = $this->link->prepare("INSERT INTO `Role_Perm_ADM` (RoleName, PermissionName) VALUES (?,?)");
		$values = array($rname,$update);
		$query->execute($values);	

		
    }	
	
	// Insert Role_Perm Function
    function insert_role_perm_4($rname,$delete){
		$query = $this->link->prepare("INSERT INTO `Role_Perm_ADM` (RoleName, PermissionName) VALUES (?,?)");
		$values = array($rname,$delete);
		$query->execute($values);		
    }
	
	// Insert Role_Perm Function
    function insert_role_perm_5($rname,$view){
		$query = $this->link->prepare("INSERT INTO `Role_Perm_ADM` (RoleName, PermissionName) VALUES (?,?)");
		$values = array($rname,$view);
		$query->execute($values);		
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