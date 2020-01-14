<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$cnum = "";
	$supid = "";
	$truckid = "";
	$ddisp = "";
	$darr = "";
	$pcount = "";
	$imagepath = "";
	$target_dir = "../batchdocuments/";
	$uploadOk = 1;
	
    
	
class batchdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates batch with Photo DETAILS before Insert
	function validate_batch_details_with_photo($cnum,$supid,$truckid,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$ddisp,$darr,$pcount){
		
		$cnum1 = $cnum;
		$RID = $this->get_batchrange_id($cnum,$cnum1);
		$brnid_exist = $this->check_batchrangeID_exist($RID);		
		$vrange = $this->validate_range($cnum,$cnum1);
		$today = date("Y-m-d");
		
		if(empty($cnum)){
			echo "CONTROL NUMBER cannot be empty";  
            exit;			
	    }elseif(!is_integer($cnum) && $cnum <= 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif( $vrange == 0){
			echo "CONTROL NUMBER  ".$cnum."  is out of DEFINED RANGE, PLEASE VALIDATE";
			exit;
		}elseif($supid == "Please Select from List"){
			echo "BATCH SUPPLIER cannot be empty";  
            exit;			
	    }elseif($truckid == "Please Select from List"){
			echo "PLEASE SELECT TRUCK ID from list";  
            exit;			
	    }elseif(empty($ddisp)){
			echo "DISPATCH DATE cannot be empty";  
            exit;			
	    }elseif(empty($darr)){			
			echo "ARRIVAL DATE cannot be empty";
			exit;			
		}elseif( $ddisp > $darr ){			
			echo "DATE DISPATCH cannot be latest than ARRIVAL DATE";
			exit;			
		}elseif( $darr > $today ){			
			echo "ARRIVAL DATE cannot be later than TODAY";
			exit;			
		}elseif( $ddisp > $today ){			
			echo "DISPATCH DATE cannot be later than TODAY";
			exit;			
		}elseif($check == false){						
			echo "Please UPLOAD PROPER IMAGE FILE";	
			exit;
		}elseif($filesize > 10000000){			
			echo "Sorry, your file is too large. MAXIMUM FILE SIZE IS 10MB";
			exit;
		}elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf"){
			echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
			exit;
		}elseif(file_exists($target_file)){			
			echo "Sorry, file already exists. Please select another file";
			exit;
		}elseif(empty($pcount)){			
			echo "PRODUCT COUNT cannot be empty";
			exit;			
		}elseif(!is_integer($pcount) && $pcount <= 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif( $brnid_exist == 0){		
			$rangeID = $this->get_batchrange_id($cnum,$cnum1);
			$cycle = 1;
			$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
			$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);	
			echo "BATCH CONTROL NUMBER:  ".$cnum."  DETAILS added successfully, Cycle is:  ".$cycle;
			exit;				
		}else{
			
			$R_ID = $this->get_batchrange_id($cnum,$cnum1);	
			$rangeID = $this->get_latest_batchrange_id($R_ID);	
			$cycle = $this->get_latest_cycle($rangeID);	
			$range = $this->get_range($rangeID);	
			//$range = 2;
			$dor = DateTime::createFromFormat('Y-m-d', $darr);
			$ArriveYear = $dor->format('Y');
			$CNUM_exists = $this->check_CNUM_exist($cnum,$rangeID,$cycle);
			$bridcount = $this->get_Batch_RangeID_count($rangeID,$cycle);
			$latestAY = $this->get_latest_arrive_year($rangeID,$cycle);
			
			if($CNUM_exists >= 1){
				
				echo "Control Number:  ".$cnum."  has been used in this cycle:  ".$cycle."  Please select another Control Number in RANGE:  ".$rangeID;	
				exit;
				
			}elseif( ($bridcount > $range) and ($ArriveYear ==  $latestAY) ){
				
				$cycle = $cycle + 1; //Increment Cycle
				$cnum = $this->get_first_cnum_in_range($rangeID); //reset Control Number
				$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);
				echo "End of Range, NEW Cycle:  ".$cycle."  started, First Control Number:  ".$cnum.",  in a RANGE has been USED instead,  ";
				echo "BATCH DETAILS added successfully";
				exit;
				
			}elseif( $ArriveYear > $latestAY ){	
			
				$cycle = $cycle + 1; //Increment Cycle
				$cnum = $this->get_first_cnum_in_range($rangeID); //reset Control Number
				$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);
				echo "It´s NEW YEAR, NEW Cycle:  ".$cycle."  Started, First Control Number:  ".$cnum.", in a RANGE has been USED instead.  ";
				echo "BATCH DETAILS added successfully";
				exit;	
				
			}else{
				
				$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);	
				echo "BATCH CONTROL NUMBER  ".$cnum."  DETAILS added successfully, Cycle is: ".$cycle;
				
			}
			
		}
	}
	
// This function validates batch without photo details before insert
	function validate_batch_details_without_photo($cnum,$supid,$truckid,$imagepath,$ddisp,$darr,$pcount){
		
		$cnum1 = $cnum;
		$RID = $this->get_batchrange_id($cnum,$cnum1);
		$brnid_exist = $this->check_batchrangeID_exist($RID);
		$vrange = $this->validate_range($cnum,$cnum1);	
		$today = date("Y-m-d");
	
		if(empty($cnum)){
			
			echo "CONTROL NUMBER cannot be empty";  
            exit;	
			
	    }elseif(!is_integer($cnum) && $cnum <= 0){
			
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;	
			
	    }elseif($vrange == 0){
			
			echo "CONTROL NUMBER  ".$cnum." is out of DEFINED NUMBER RANGES, PLEASE VALIDATE your CONTROL NUMBER";
			exit;
			
		}elseif($supid == "Please Select from List"){
			
			echo "BATCH SUPPLIER cannot be empty";  
            exit;	
			
	    }elseif($truckid == "Please Select from List"){
			
			echo "PLEASE SELECT TRUCK ID from list";  
            exit;		
			
	    }elseif(empty($ddisp)){
			
			echo "DISPATCH DATE cannot be empty";  
            exit;	
			
	    }elseif(empty($darr)){
			
			echo "ARRIVAL DATE cannot be empty";
			exit;
			
		}elseif( $ddisp > $darr ){
			
			echo "DISPATCH DATE cannot be latest than ARRIVAL DISPATCH";
			exit;
			
		}elseif( $darr > $today ){	
		
			echo "ARRIVAL DATE cannot be later than TODAY";
			exit;	
			
		}elseif( $ddisp > $today ){	
		
			echo "DISPATCH DATE cannot be later than TODAY";
			exit;
			
		}elseif(empty($pcount)){	
		
			echo "PRODUCT COUNT cannot be empty";
			exit;		
			
		}elseif(!is_integer($pcount) && $pcount <= 0){
			
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;	
			
	    }elseif($brnid_exist == 0){
			
			$rangeID = $this->get_batchrange_id($cnum,$cnum1);
			$cycle = 1;		
			$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);	
			echo "BATCH CONTROL NUMBER:  ".$cnum."  DETAILS added successfully, Cycle is:  ".$cycle;
			exit;	
			
		}else{	
		    
			$R_ID = $this->get_batchrange_id($cnum,$cnum1);	
			$rangeID = $this->get_latest_batchrange_id($R_ID);	
			$cycle = $this->get_latest_cycle($rangeID);	
			$range = $this->get_range($rangeID);	
			//$range = 2;
			$dor = DateTime::createFromFormat('Y-m-d', $darr);
			$ArriveYear = $dor->format('Y');
			$CNUM_exists = $this->check_CNUM_exist($cnum,$rangeID,$cycle);
			$bridcount = $this->get_Batch_RangeID_count($rangeID,$cycle);
			$latestAY = $this->get_latest_arrive_year($rangeID,$cycle);

				
			if($CNUM_exists >= 1){
				
				echo "Control Number:  ".$cnum."  has been used in this cycle:  ".$cycle."  Please select another Control Number in RANGE:  " ." ".$rangeID;	
				exit;	
				
			}elseif( ($bridcount > $range) and ($ArriveYear ==  $latestAY) ){
				
				$cycle = $cycle + 1; //Increment Cycle
				$cnum = $this->get_first_cnum_in_range($rangeID); //reset Control Number
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);
				echo "We started NEW Cycle:  ".$cycle." First Control Number"." ".$cnum." "."In a RANGE has been USED instead ";
				echo "BATCH CONTROL NUMBER  ".$cnum."  DETAILS added successfully";
				exit;	
				
			}elseif( $ArriveYear > $latestAY ){	
			
				$cycle = $cycle + 1; //Increment Cycle
				$cnum = $this->get_first_cnum_in_range($rangeID); //reset Control Number
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);
				echo "It´s NEW YEAR, NEW Cycle:  ".$cycle."  Started, First Control Number:  ".$cnum."  in a RANGE has been USED instead.  ";
				echo "BATCH DETAILS added successfully";
				exit;	
				
			}else{
				
				$this->insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount);					
				echo "BATCH CONTROL NUMBER:  ".$cnum."  DETAILS added successfully, Cycle is:  ".$cycle;	
				
			}
		
		}			

	}
	

// This function checks if batch exist in database
	function validate_range($cnum,$cnum1){
		
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`BatchRange_ACC` WHERE StartingNumber <= ? AND EndingNumber >= ?");
     	$values = array($cnum,$cnum1);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	
// This function checks if BatchRange Exists in Batch Details
	function check_batchrangeID_exist($RID){		
	
		//CHECK Range ID EXISTS IN BatchDetailsTable
		$query = $this->link->prepare("SELECT BatchRangeId FROM `pb_db`.`BatchDetails_ACC` WHERE BatchRangeId = ?");
     	$values = array($RID);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;			
	}
	
// This function returns RANGEID for each given CONTROL Number
	function get_batchrange_id($cnum,$cnum1){

		//GET range ID from BatchRangeTable
		$query = $this->link->prepare("SELECT BatchRangeId FROM `pb_db`.`BatchRange_ACC` WHERE StartingNumber <= ? AND EndingNumber >= ?");		
		$values = array($cnum,$cnum1);
		$query->execute($values);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $item){
			$rangeid = $item['BatchRangeId'];
			return $rangeid;
		}		
		//return $rangeid;	
	}

	
// This function returns RANGEID for each given CONTROL Number
	function get_latest_batchrange_id($R_ID){
		
	    //GET Latest BatchRangeID from BatchDetailsTable
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`BatchDetails_ACC` WHERE BatchRangeId = ? ORDER BY BatchId DESC LIMIT 1");
		$values = array($R_ID);
		$query->execute($values);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $item){
			$rangeid = $item['BatchRangeId'];
			return $rangeid;
		}
		//return $rangeid;					
	}
	
// This function Returns Latest Cycle for a Given BatchRangeID
	function get_latest_cycle($rangeID){
		
		//GET range ID from BatchRangeTable		
		$query = $this->link->prepare("SELECT RangeCycle FROM `pb_db`.`BatchDetails_ACC` WHERE BatchRangeId = ? ORDER BY BatchId DESC LIMIT 1");
     	try{
			$values = array($rangeID);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_NUM);
			foreach ($result as $key => $item){
			   $rangecycle = $item[0];	
			}
		}catch (PDOException $e){die($e->getMessage());}
		return $rangecycle;
		
	}
	
// This function checks if Control Number Exists in Batch Details within a given RANGE and Cycle
	function check_CNUM_exist($cnum,$rangeID,$cycle){
		
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`BatchDetails_ACC` WHERE ControlNumber=? and BatchRangeId=? and RangeCycle=?");
		try{
			$values = array($cnum,$rangeID,$cycle);
			$query->execute($values);
			$counts = $query->rowCount();
		}catch (PDOException $e){die($e->getMessage());}
		return $counts;		
		
	}
	
// This Function Returns Batch Range ID count from BatchDetails Table for a specified Frequency
	function get_Batch_RangeID_count($rangeID,$cycle){
		
		$query = $this->link->prepare("SELECT count(BatchRangeId) AS BRIDCOUNT FROM `pb_db`.`BatchDetails_ACC` WHERE BatchRangeId=? and RangeCycle=?");
		try{
			$values = array($rangeID,$cycle);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_NUM);
			foreach ($result as $key => $item){
				$bridcount = $item[0];
			}			
		}catch (PDOException $e){die($e->getMessage());}
		return $bridcount;		
		
	}
	
// This function returns RANGE for each given CONTROL Number
	function get_latest_arrive_year($rangeID,$cycle){
		
		//Calculate Range
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`BatchDetails_ACC` WHERE BatchRangeId=? and RangeCycle=? ORDER BY BatchId DESC LIMIT 1");
		try{
			$values = array($rangeID,$cycle);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$darr = $item['DateArrived'];
			}	
		}catch (PDOException $e){die($e->getMessage());}
		$darr = DateTime::createFromFormat('Y-m-d', $darr);
		$ArriveYear = $darr->format('Y');
		return $ArriveYear;				
	}
		
	
// This function returns RANGE for each given CONTROL Number
	function get_range($rangeID){
		
		//Calculate Range
		$query = $this->link->prepare("SELECT StartingNumber, EndingNumber FROM `pb_db`.`BatchRange_ACC` WHERE BatchRangeId=?");
		try{
			$values = array($rangeID);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$startnum = $item['StartingNumber'];
				$endnum = $item['EndingNumber'];
				$range = $endnum - $startnum;
				return $range;
			}			
		}catch (PDOException $e){die($e->getMessage());}				
		
	}
		
// This function returns RANGE for each given CONTROL Number
	function get_first_cnum_in_range($rangeID){
		
		//Calculate Range
		$query = $this->link->prepare("SELECT StartingNumber FROM `pb_db`.`BatchRange_ACC` WHERE BatchRangeId= ?");
		try{
			$values = array($rangeID);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$startnum = $item['StartingNumber'];
			}
		}catch (PDOException $e){die($e->getMessage());}
		return $startnum;	
		
	}
	
// This function checks return image size in bits
	function upload_image_($target_file,$file_temp,$filename){
		
		if (move_uploaded_file($file_temp, $target_file)) {
				return $target_file;
			}else{
				echo "Sorry, there was an error uploading your file."; 
			}
	}	
	
// Insert Function
    function insert_batch_details($cnum,$rangeID,$supid,$truckid,$imagepath,$ddisp,$darr,$cycle,$pcount){
		
		$query = $this->link->prepare("INSERT INTO `pb_db`.`BatchDetails_ACC` (ControlNumber, BatchRangeId, SupplierId, RegNumber, DateDispatched, DateArrived, BatchDocument,RangeCycle,ProductCount) VALUES (?,?,?,?,?,?,?,?,?)");
		$values = array($cnum,$rangeID,$supid,$truckid,$ddisp,$darr,$imagepath,$cycle,$pcount);
		$query->execute($values);			
    }	
}

//Create NEW Object
$actionwithfileupload = new batchdetailActions();
$actionwithoutfileupload = new batchdetailActions();

if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_FILES['fileToUpload'])){
	
	if($_FILES['fileToUpload']['error'] == 4) {
		
		$cnum = trim($_POST['cnum'] ?? '');
		$supid = trim($_POST['supid'] ?? '');
		$truckid = trim($_POST['truckid'] ?? '');
		$ddisp = trim($_POST['ddisp'] ?? '');
		$darr = trim($_POST['darr'] ?? '');	
		$pcount = trim($_POST['pcount'] ?? '');	
		
		echo $actionwithoutfileupload ->validate_batch_details_without_photo($cnum,$supid,$truckid,$imagepath,$ddisp,$darr,$pcount);
		
	}else{	
	
		$cnum = trim($_POST['cnum'] ?? '');
		$supid = trim($_POST['supid'] ?? '');
		$truckid = trim($_POST['truckid'] ?? '');
		$ddisp = trim($_POST['ddisp'] ?? '');
		$darr = trim($_POST['darr'] ?? '');	
		$pcount = trim($_POST['pcount'] ?? '');	
	
		$file_temp = $_FILES['fileToUpload']['tmp_name'];  
		$filename = $_FILES['fileToUpload']['name'];
		$filesize = $_FILES['fileToUpload']['size'];
		$target_file = $target_dir . basename($filename);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
		$check = getimagesize($file_temp);	
		
		echo $actionwithfileupload->validate_batch_details_with_photo($cnum,$supid,$truckid,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$ddisp,$darr,$pcount);
	
	}

}

?>