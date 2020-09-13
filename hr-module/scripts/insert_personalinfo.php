<?php

	//Start Session
	session_start();

	if(!isset($_SESSION)){

		// Redirect user to index page
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;

	}else{

		// Include config file
		require_once "class.config.php";

		// Define variables and initialize with empty values
		//$motd_date = date("Y-m-d h:i:s A");
		$eid = "";
		$fname = "";
		$lname = "";
		$sdate = "";
		$address = "";
		$gender = "";
		$dob = "";
		$imagepath = "";
		$target_dir = "../employee_ids/";
		$uploadOk = 1;


	    // Define a Class
		class employeedetailActions{

			public $link;


			function __construct(){
				$db_connection = new dbConnection();
				$this->link = $db_connection->connect();
				return $this->link;
			}

			// This function uploads image
			function upload_image_($check,$target_file,$filesize,$file_temp,$filename,$imageFileType){

				if($check == false){
					echo "Please UPLOAD PROPER IMAGE FILE";
					exit;
				}
				if($filesize > 10000000){
					echo "Sorry, your file is too large. MAXIMUM FILE SIZE IS 10MB";
					exit;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf"){
					echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
					exit;
				}
				if(file_exists($target_file)){
					echo "Sorry, file already exists. Please select another file";
					exit;
				}
				if (move_uploaded_file($file_temp, $target_file)) {
					return $target_file;
				}else{
					echo "Sorry, there was an error uploading your file.";
				}

			}

			// This function checks if TODAY's MOTD exist in database
			function check_employee_exist($eid){
				$query = $this->link->prepare("SELECT * FROM personalinfo_hr WHERE EmployeeId = ?");
				$values = array($eid);
				$query->execute($values);
				$counts = $query->rowCount();
				return $counts;
			}

			// Insert Function
			function insert_employee_details($eid,$fname,$lname,$sdate,$gender,$dob,$address,$imagepath){
				$query = $this->link->prepare("INSERT INTO personalinfo_hr (EmployeeId, FirstNames, LastNames, JoiningDate, Gender, DateofBirth, HomeAddress, EmpIdPhoto) VALUES (?,?,?,?,?,?,?,?)");
				$values = array($eid,$fname,$lname,$sdate,$gender,$dob,$address,$imagepath);
				$query->execute($values);
			}

		}

		//Create NEW Object
		$action_insert_details = new employeedetailActions();
		$path = new employeedetailActions();
		$check_record = new employeedetailActions();

		if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_FILES['fileToUpload'])){

			if($_FILES['fileToUpload']['error'] == 4) {

				$eid = trim($_POST['eid'] ?? '');
				$fname = trim($_POST['fname'] ?? '');
				$lname = trim($_POST['lname'] ?? '');
				$sdate = trim($_POST['sdate'] ?? '');
				$address = trim($_POST['address'] ?? '');
				$gender = trim($_POST['gender'] ?? '');
				$dob = trim($_POST['dob'] ?? '');
				$employee_exist = $check_record->check_employee_exist($eid);
				if($employee_exist !== 0){

					echo "Employee Record already exists, please use another ID!";

				}else{

					echo $action_insert_details->insert_employee_details($eid,$fname,$lname,$sdate,$gender,$dob,$address,$imagepath);
					echo "Employee: ".$fname." ".$lname." "."was added successfully "."  Employee ID is: ".$eid;

				}


			}else{

				$eid = trim($_POST['eid'] ?? '');
				$fname = trim($_POST['fname'] ?? '');
				$lname = trim($_POST['lname'] ?? '');
				$sdate = trim($_POST['sdate'] ?? '');
				$address = trim($_POST['address'] ?? '');
				$gender = trim($_POST['gender'] ?? '');
				$dob = trim($_POST['dob'] ?? '');

				$file_temp = $_FILES['fileToUpload']['tmp_name'];
				$filename = $_FILES['fileToUpload']['name'];
				$filesize = $_FILES['fileToUpload']['size'];
				$target_file = $target_dir . basename($filename);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$check = getimagesize($file_temp);

				$employee_exist = $check_record->check_employee_exist($eid);
				if($employee_exist !== 0){

					echo "Employee Record already exists, please try another ID!";

				}else{

					$imagepath = $path->upload_image_($check,$target_file,$filesize,$file_temp,$filename,$imageFileType);
					echo $action_insert_details->insert_employee_details($eid,$fname,$lname,$sdate,$gender,$dob,$address,$imagepath);
					echo "Employee: ".$fname." ".$lname." "."was added successfully "."  Employee ID is: ".$eid;

				}

			}

		}

	}

?>
