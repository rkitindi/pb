<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$pcode = "";
	$bname = "";
	$quality = "";
	$sprice = "";
	$psup = "";
	$imagepath = "";
	$target_dir = "../product_photos/";
	$uploadOk = 1;
	
    
	
class productdetailActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates product with Photo DETAILS before Insert
	function validate_product_details_with_photo($pcode,$bname,$quality,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$sprice,$psup){
		
		if(empty($pcode)){
			echo "PRODUCT CODE cannot be empty";  
            exit;			
	    }elseif($this->check_product_exist($pcode) >= 1){
			echo "PRODUCT RECORD exists in database";
			exit;
		}elseif($bname == "Please Select from List"){
			echo "PRODUCT BRAND cannot be empty";  
            exit;			
	    }elseif($quality == "Please Select from List"){
			echo "PRODUCT QUALITY cannot be empty";  
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
		}elseif(empty($sprice)){
			echo "SELLING PRICE cannot be empty";  
            exit;			
	    }elseif(!is_integer($sprice) && $sprice < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($psup =="Please Select from List"){
			echo "PLEASE SELECT supplier NAME FROM LIST";
			exit;
		}else{
			$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
			$this->insert_product_details($pcode,$bname,$quality,$imagepath,$sprice,$psup);	
			echo "product  ".$pcode."  DETAILS added successfully";	
		}

	}
	
	
// This function validates product without photo details before insert
	function validate_product_details_without_photo($pcode,$bname,$quality,$imagepath,$sprice,$psup){
		
		if(empty($pcode)){
			echo "PRODUCT CODE cannot be empty";  
            exit;			
	    }elseif($this->check_product_exist($pcode) >= 1){
			echo "PRODUCT RECORD exists in database";
			exit;
		}elseif($bname == "Please Select from List"){
			echo "PRODUCT BRAND cannot be empty";  
            exit;			
	    }elseif($quality == "Please Select from List"){
			echo "PRODUCT QUALITY cannot be empty";  
            exit;			
	    }elseif(empty($sprice)){
			echo "SELLING PRICE cannot be empty";  
            exit;			
	    }elseif(!is_integer($sprice) && $sprice < 0){
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;			
	    }elseif($psup =="Please Select from List"){
			echo "PLEASE SELECT supplier NAME FROM LIST";
			exit;
		}else{			
			$this->insert_product_details($pcode,$bname,$quality,$imagepath,$sprice,$psup);		
			echo "product  ".$pcode."  DETAILS added successfully";			
		}
		
	}	
	

// This function checks if product exist in database
	function check_product_exist($pcode){
		$query = $this->link->prepare("SELECT * FROM productinfo_prod WHERE ProductCode = ?");
     	$values = array($pcode);
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
    function insert_product_details($pcode,$bname,$quality,$imagepath,$sprice,$psup){
		$query = $this->link->prepare("INSERT INTO productinfo_prod (ProductCode, BrandId, QualityId, ProductPhoto, SellingPrice, SupplierId) VALUES (?,?,?,?,?,?)");
		$values = array($pcode,$bname,$quality,$imagepath,$sprice,$psup);
		$query->execute($values);		
    }	
}

//Define NEW Object
$actionwithphoto = new productdetailActions();
$actionwithoutphoto = new productdetailActions();

if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_FILES['fileToUpload'])){
	
	if($_FILES['fileToUpload']['error'] == 4) {
		
		$pcode = trim($_POST['pcode'] ?? '');
		$bname = trim($_POST['bname'] ?? '');
		$quality = trim($_POST['quality'] ?? '');
		$sprice = trim($_POST['sprice'] ?? '');
		$psup = trim($_POST['psup'] ?? '');	
		
		echo $actionwithoutphoto->validate_product_details_without_photo($pcode,$bname,$quality,$imagepath,$sprice,$psup);
		
	}else{	
	
		$pcode = trim($_POST['pcode'] ?? '');
		$bname = trim($_POST['bname'] ?? '');
		$quality = trim($_POST['quality'] ?? '');
		$sprice = trim($_POST['sprice'] ?? '');
		$psup = trim($_POST['psup'] ?? '');	
	
		$file_temp = $_FILES['fileToUpload']['tmp_name'];  
		$filename = $_FILES['fileToUpload']['name'];
		$filesize = $_FILES['fileToUpload']['size'];
		$target_file = $target_dir . basename($filename);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
		$check = getimagesize($file_temp);	
		
		echo $actionwithphoto->validate_product_details_with_photo($pcode,$bname,$quality,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$sprice,$psup);
	
	}
}

?>