<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$casecode = "";
	$cname = "";
	$bname = "";
	$pprice = "";
	$csup = "";
	$imagepath = "";
	$target_dir = "../case_photos/";
	$uploadOk = 1;
	
    
	
class casedetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates case with Photo DETAILS before Insert
	function validate_case_details_with_photo($casecode,$cname,$bname,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$pprice,$csup){
		
		if(empty($casecode)){
			echo "case CODE cannot be empty";  
            exit;			
	    }elseif($this->check_case_exist($casecode) >= 1){
			echo "case RECORD exists in database";
			exit;
		}elseif(empty($cname)){
			echo "case name cannot be empty";  
            exit;			
	    }elseif($bname == "Please Select from List"){
			echo "case brand cannot be empty";  
            exit;			
	    }elseif($check == false){						
			echo "Please UPLOAD PROPER IMAGE FILE";	
			exit;
		}elseif($filesize > 10000000){			
			echo "Sorry, your file is too large. MAXIMUM FILE SIZE IS 10MB";
			exit;
		}elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			exit;
		}elseif(file_exists($target_file)){			
			echo "Sorry, file already exists.";
			exit;
		}elseif(empty($pprice)){
			echo "PURCHASE PRICE cannot be empty";  
            exit;			
	    }elseif(!is_integer($pprice) && $pprice < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($csup =="Please Select from List"){
			echo "PLEASE SELECT supplier NAME FROM LIST";
			exit;
		}else{
			$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
			$this->insert_case_details($casecode,$cname,$bname,$imagepath,$pprice,$csup);	
			echo "case  ".$cname."  DETAILS added successfully";	
		}

	}
	
	
// This function validates case without photo details before insert
	function validate_case_details_without_photo($casecode,$cname,$bname,$imagepath,$pprice,$csup){
		
		if(empty($casecode)){
			echo "case CODE cannot be empty";  
            exit;			
	    }elseif($this->check_case_exist($casecode) >= 1){
			echo "case RECORD exists in database";
			exit;
		}elseif(empty($cname)){
			echo "case name cannot be empty";  
            exit;			
	    }elseif($bname == "Please Select from List"){
			echo "case brand cannot be empty";  
            exit;			
	    }elseif(empty($pprice)){
			echo "PURCHASE PRICE cannot be empty";  
            exit;			
	    }elseif(!is_integer($pprice) && $pprice < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($csup =="Please Select from List"){
			echo "PLEASE SELECT supplier NAME FROM LIST";
			exit;
		}else{			
			$this->insert_case_details($casecode,$cname,$bname,$imagepath,$pprice,$csup);	
			echo "case  ".$cname."  DETAILS added successfully \n\n";		
		}
		
	}	
	

// This function checks if case exist in database
	function check_case_exist($casecode){
		$query = $this->link->prepare("SELECT * FROM `pb_db`.`CaseDetails_PROD` WHERE caseCode = ?");
     	$values = array($casecode);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts; 
	}	
	

// This function checks return image size in bits
	function upload_image_($target_file,$file_temp,$filename){
		
		if (move_uploaded_file($file_temp, $target_file)) {
				echo "The file ". basename($filename). " has been uploaded. \n\n"; 
				return $target_file;
			}else{
				echo "Sorry, there was an error uploading your file. \n\n"; 
			}
			
	}	
	
	
// Insert Function
    function insert_case_details($casecode,$cname,$bname,$imagepath,$pprice,$csup){
		$query = $this->link->prepare("INSERT INTO `pb_db`.`CaseDetails_PROD` (caseCode, CaseName, BrandId, casePhoto, PurchasePrice, SupplierId) VALUES (?,?,?,?,?,?)");
		$values = array($casecode,$cname,$bname,$imagepath,$pprice,$csup);
		$query->execute($values);			
    }	
}

//Define NEW Object
$actionwithphoto = new casedetailActions();
$actionwithoutphoto = new casedetailActions();

if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_FILES['fileToUpload'])){
	
	if($_FILES['fileToUpload']['error'] == 4) {
		
		$casecode = trim($_POST['casecode'] ?? '');
		$cname = trim($_POST['cname'] ?? '');
		$bname = trim($_POST['bname'] ?? '');
		$pprice = trim($_POST['pprice'] ?? '');
		$csup = trim($_POST['csup'] ?? '');	
		
		echo $actionwithoutphoto->validate_case_details_without_photo($casecode,$cname,$bname,$imagepath,$pprice,$csup);
		
	}else{	
	
		$casecode = trim($_POST['casecode'] ?? '');
		$cname = trim($_POST['cname'] ?? '');
		$bname = trim($_POST['bname'] ?? '');
		$pprice = trim($_POST['pprice'] ?? '');
		$csup = trim($_POST['csup'] ?? '');	
	
		$file_temp = $_FILES['fileToUpload']['tmp_name'];  
		$filename = $_FILES['fileToUpload']['name'];
		$filesize = $_FILES['fileToUpload']['size'];
		$target_file = $target_dir . basename($filename);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
		$check = getimagesize($file_temp);	
		
		echo $actionwithphoto->validate_case_details_with_photo($casecode,$cname,$bname,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$pprice,$csup);
	
	}
}

?>