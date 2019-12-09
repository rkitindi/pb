<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$brid = "";
	$stnum = "";
	$ennum = "";
	$sfflag = "";
	$description = "";

 

class bnrActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates PERMISSION before Insert
	function validate_bnr_details($brid,$stnum,$ennum,$sfflag,$description){
				
		if(empty($brid)){
			echo "BATCH RANGE ID cannot be empty";  
            exit;
		}elseif($this->check_brid_exist($brid) >= 1){
			echo "BATCH RANGE ID RECORD exists in database";
			exit;
		}elseif(empty($stnum)){
			echo "STARTING NUMBER cannot be empty";  
            exit;			
	    }elseif(!is_integer($stnum) && $stnum < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif(empty($ennum)){
			echo "ENDING NUMBER cannot be empty";  
            exit;			
	    }elseif(!is_integer($ennum) && $ennum < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif(empty($sfflag)){
			echo "S/F INDICATION cannot be empty";
			exit;
		}else{
			
			$this->insert_bnr($brid,$stnum,$ennum,$sfflag,$description);				

				echo "<table id='display_records' style='width:70%'  border='1px' align='center'>";
				echo"<caption>THE FOLLOWING RANGE DETAILS HAVE BEEN INSERTED SUCCESSFULLY!!</caption>";
				echo"<tr>";
					echo"<td>BatchRangeId</td>";
					echo"<td>StartingNumber</td>";
					echo"<td>EndingNumber</td>";
					echo"<td>SFIndication</td>";  
					echo"<td>Description</td>"; 					
				echo"</tr>";
				echo"<tr>";
					echo"<td>$brid</td>";
					echo"<td>$stnum</td>";
					echo"<td>$ennum</td>";
					echo"<td>$sfflag</td>";  
					echo"<td>$description</td>";   				
				echo"</tr>";
			echo "</table>";	
		
		}	
	}
	
	
// This function checks if batch number range exist in database
	function check_brid_exist($brid){
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`BatchRange_ACC` WHERE BatchRangeId = ?");
     	$values = array($brid);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
	
// Insert Function
    function insert_bnr($brid,$stnum,$ennum,$sfflag,$description){
		
		$query = $this->link->prepare("INSERT INTO `pb_db`.`BatchRange_ACC` (BatchRangeId, StartingNumber, EndingNumber, SFIndication, Description) VALUES (?,?,?,?,?)");
		$values = array($brid,$stnum,$ennum,$sfflag,$description);
		$query->execute($values);
			
    }	
}

$action = new bnrActions();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$brid = trim($_POST['brid'] ?? '');
	$stnum = trim($_POST['stnum'] ?? '');
	$ennum = trim($_POST['ennum'] ?? '');
	$sfflag = trim($_POST['sfflag'] ?? '');
	$description = trim($_POST['description'] ?? '');

	echo $action->validate_bnr_details($brid,$stnum,$ennum,$sfflag,$description);
}	


?>