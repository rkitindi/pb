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
}


?>