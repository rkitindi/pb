<?php
// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
   	$stid = "";
	$amount = "";
	$paymet = "";
	$paydate = "";
	$confirmed = "";
	$comment = "";
	$imagepath = "";
	$target_dir = "../attachments/";
	$uploadOk = 1;
	
    
	
class DebtCollectionActions{

    public $link; 


    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();   
        return $this->link;
    }
	
	
// This function validates batch with Photo DETAILS before Insert
	function validate_DebtCollection_with_photo($stid,$amount,$paymet,$paydate,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$confirmed,$comment){
		
		$today = date("Y-m-d");
		
		if($stid == "Please Select from List" ){
			
			echo "SELECT SALES RECEIPT NUMBER from a list ";  
            exit;	
			
	    }elseif(empty($amount)){
			
			echo "AMOUNT PAID cannot be empty";  
            exit;	
			
	    }elseif(!is_integer($amount) && $amount <= 0){
			
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;	
			
	    }elseif(empty($paymet)){
			
			echo "PLease select PAYMENT METHOD";  
            exit;	
			
	    }elseif(empty($paydate)){
			
			echo "PAY DATE cannot be empty";  
            exit;	
			
	    }elseif( $paydate > $today ){	
		
			echo "PAY DATE cannot be later than TODAY";
			exit;	
			
		}elseif(empty($confirmed)){
			
			echo "CONFIRMATION cannot be empty!";  
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
		}else{
			
			$tobepaid = $this->fetch_customer_debt($stid);
			
			if($amount > $tobepaid){
				
				echo "You cannot pay:  ".$amount."MXN more than:  ".$tobepaid."MXN  amount to be paid";	
				exit;	
				
			}elseif( $paymet == "cash" ){
				
				echo "There is NOTHING to UPLOAD with CASH Payment, Remove attachment!";
				exit;	
				
			}elseif( $confirmed == "N" AND empty($comment)){	

				echo "EXPLAIN in COMMENTS why Customer did not finish PAYMENTS";
				exit;	
				
			}elseif( ($amount < $tobepaid) AND $confirmed == "Y" ){	

				echo "Customer did not finish payment, please validate!";
				exit;	
				
			}else{
				
				$imagepath = $this->upload_image_($target_file,$file_temp,$filename);
				$this->insert_DebtCollection($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment);					
				echo "PAYMENT TRANSACTION COMPLETED SUCCESSFULLY!!";	
				
			}
		
		}			

	}
	
	// This function validates batch without photo details before insert
	function validate_DebtCollection_without_photo($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment){
		
		$today = date("Y-m-d");
	
		if($stid == "Please Select from List" ){
			
			echo "SELECT SALES RECEIPT NUMBER from a list ";  
            exit;	
			
	    }elseif(empty($amount)){
			
			echo "AMOUNT PAID cannot be empty";  
            exit;	
			
	    }elseif(!is_integer($amount) && $amount <= 0){
			
			echo "ONLY POSITIVE INTERGERS ARE ALLOWED";  
            exit;	
			
	    }elseif(empty($paymet)){
			
			echo "PLease select PAYMENT METHOD";  
            exit;	
			
	    }elseif(empty($paydate)){
			
			echo "PAY DATE cannot be empty";  
            exit;	
			
	    }elseif( $paydate > $today ){	
		
			echo "PAY DATE cannot be later than TODAY";
			exit;	
			
		}elseif(empty($confirmed)){
			
			echo "CONFIRMATION cannot be empty!";  
            exit;	
			
	    }else{	
		    
			$tobepaid = $this->fetch_customer_debt($stid);	
	
			if($amount > $tobepaid){
				
				echo "You cannot pay:  ".$amount."MXN more than:  ".$tobepaid."MXN  amount to be paid";	
				exit;	
				
			}elseif( $paymet == "check" OR $paymet == "transfer" ){
				
				echo "Please upload CHECK or BANK TRANSFER Document to continue";
				exit;	
				
			}elseif( $confirmed == "N" AND empty($comment)){	

				echo "EXPLAIN in COMMENTS why Customer did not finish PAYMENTS";
				exit;	
				
			}elseif( ($amount < $tobepaid) AND $confirmed == "Y" ){	

				echo "Customer did not finish payment, please validate!";
				exit;	
				
			}else{
				
				$this->insert_DebtCollection($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment);					
				echo "PAYMENT TRANSACTION COMPLETED SUCCESSFULLY!!"	;
				
			}
		
		}			

	}
	
	// This function returns CUSTOMER DEBT
	function fetch_customer_debt($stid){

		$query = $this->link->prepare("SELECT SaleProductReceived_SAL.SalesRef, (SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) AS TOTAL, COALESCE(SUM(CollectPayment_SAL.Amount),0) as PAID, ((SaleProductReceived_SAL.Quantity*SaleProductReceived_SAL.UnitPrice) - COALESCE(SUM(CollectPayment_SAL.Amount),0)) AS DEBT, CustomerDetails_SAL.ContactName, SaleProductReceived_SAL.PaymentMethod, DispatchProduct_ACC.POSId FROM SaleProductReceived_SAL LEFT JOIN CollectPayment_SAL ON CollectPayment_SAL.SalesRef = SaleProductReceived_SAL.SalesRef JOIN CustomerDetails_SAL ON CustomerDetails_SAL.CustomerId = SaleProductReceived_SAL.CustomerId JOIN ProductReceived_SAL ON ProductReceived_SAL.ProductReceiptId = SaleProductReceived_SAL.ProductReceiptId JOIN DispatchProduct_ACC ON DispatchProduct_ACC.DispatchRefNum = ProductReceived_SAL.DispatchRefNum GROUP BY 1 HAVING SaleProductReceived_SAL.PaymentMethod = 'credit' AND DEBT > 0 AND SaleProductReceived_SAL.SalesRef = ?");		
		$values = array($stid);
		$query->execute($values);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $item){
			$debt = $item['DEBT'];
			return $debt;
		}		
		
	}

	// This function Upload images defined path
	function upload_image_($target_file,$file_temp,$filename){
		
		if (move_uploaded_file($file_temp, $target_file)) {
				return $target_file;
			}else{
				echo "Sorry, there was an error uploading your file."; 
			}
	}	


	// Insert Function
    function insert_DebtCollection($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment){
		
		$query = $this->link->prepare("INSERT INTO `pb_db`.`CollectPayment_SAL` (SalesRef, Amount, PaymentMethod, PaymentDate, Attachment, Confirmation, Comments) VALUES (?,?,?,?,?,?,?)");
		$values = array($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment);
		$query->execute($values);	

    }	
}

//Create NEW Object
$actionwithfileupload = new DebtCollectionActions();
$actionwithoutfileupload = new DebtCollectionActions();

if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_FILES['fileToUpload'])){
	
	if($_FILES['fileToUpload']['error'] == 4) {
		
		$stid = trim($_POST['stid'] ?? '');
		$amount = trim($_POST['amount'] ?? '');
		$paymet = trim($_POST['paymet'] ?? '');
		$paydate = trim($_POST['paydate'] ?? '');
		$confirmed = trim($_POST['confirmed'] ?? '');
		$comment = trim($_POST['comment'] ?? '');	
		
		echo $actionwithoutfileupload ->validate_DebtCollection_without_photo($stid,$amount,$paymet,$paydate,$imagepath,$confirmed,$comment);
		
	}else{	
	
		$stid = trim($_POST['stid'] ?? '');
		$amount = trim($_POST['amount'] ?? '');
		$paymet = trim($_POST['paymet'] ?? '');
		$paydate = trim($_POST['paydate'] ?? '');
		$confirmed = trim($_POST['confirmed'] ?? '');
		$comment = trim($_POST['comment'] ?? '');	
	
		$file_temp = $_FILES['fileToUpload']['tmp_name'];  
		$filename = $_FILES['fileToUpload']['name'];
		$filesize = $_FILES['fileToUpload']['size'];
		$target_file = $target_dir . basename($filename);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
		$check = getimagesize($file_temp);	
		
		echo $actionwithfileupload->validate_DebtCollection_with_photo($stid,$amount,$paymet,$paydate,$check,$target_file,$filesize,$file_temp,$filename,$imageFileType,$confirmed,$comment);
	
	}

}

?>