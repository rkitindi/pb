<?php

//Start Session
session_start();

// Include config file
require_once "class.config.php";

// Define variables and initialize with empty values
$uname = "";
$password = "";


class userActions{

    public $link;

    function __construct(){

        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;

    }


    // This function validates LOGIN DETAILS before Insert
	function validate_login_details($uname,$password){

		$check = $this->check_loginname_exist($uname);


		//$user_exist = $this->check_loginname_exist($uname);
		if(empty($uname)){

			// Redirect user to index page
			echo "<script> setTimeout(function(){ window.location.href= 'index.html';}, 1500); </script>";
			echo "USERNAME IS REQUIRED! PLEASE SUPPLY USERNAME";
			exit;

		}elseif(empty($password)){

			// Redirect user to index page
			echo "<script> setTimeout(function(){ window.location.href= 'index.html';}, 1500); </script>";
			echo "PASSWORD IS REQUIRED! PLEASE SUPPLY PASSWORD";
			exit;

		}elseif($check >= 1){

			$password_encrypted = $this->fetch_password($uname);
			if(password_verify($password, $password_encrypted)){

				$_SESSION = $this->fetch_User_Data($uname);
				echo "<script> setTimeout(function(){ window.location.href= 'dashboard.php';}, 2000); </script>";
				echo "LOGIN SUCCESS! PLEASE CONTINUE!";
				exit;

			}else{

				// Redirect user to index page
				echo "<script> setTimeout(function(){ window.location.href= 'index.html';}, 2000); </script>";
				echo "Password did not patch, please verify and try again!.";
				exit;
			}
			exit;

		}else{

			// Redirect user to index page
			echo "<script> setTimeout(function(){ window.location.href= 'index.html';}, 2000); </script>";
			echo "Username:  ".$uname."  doesn't exists, please verify and try again!  ";
			exit;

		}

		//return $_SESSION;
	}

	// This function fetch stored hashed password
	function check_loginname_exist($uname){

		$query = $this->link->prepare("SELECT * FROM pb_db.userdetails_adm WHERE LoginName = ?");
		try{
			$values = array($uname);
			$query->execute($values);
			$counts = $query->rowCount();
		}catch (PDOException $e){die($e->getMessage());}
		return $counts;

	}

   // This function fetches stored hashed password
	function fetch_password($uname){

		$query = $this->link->prepare("SELECT Password FROM pb_db.userdetails_adm WHERE LoginName = ?");
     	try{
			$values = array($uname);
			$query->execute($values);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $item){
				$pwd = $item['Password'];
				return $pwd;
			}
		}catch (PDOException $e){die($e->getMessage());}

	}

	// This function fetches user department
	function fetch_User_Data($uname){

		$query = $this->link->prepare("SELECT EmployeeID, RoleID FROM pb_db.userdetails_adm WHERE LoginName = ?");
     	try{
			$values = array($uname);
			$query->execute($values);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $key => $item){
				$eid = $item['EmployeeID'];
				$rid = $item['RoleID'];
			}
		}catch (PDOException $e){die($e->getMessage());}
		$user_data = array("EmployeeID"=>$eid, "RoleID"=>$rid);
		return $user_data;

	}

}


$data = new userActions();

if($_SERVER["REQUEST_METHOD"] == "POST"){

	$uname = trim($_POST['uname'] ?? '');
	$password = trim($_POST['password'] ?? '');
	echo $data->validate_login_details($uname,$password);

}


if($_SERVER["REQUEST_METHOD"] == "GET"){

	//Destroy Session
	session_destroy();

	// Redirect user to index page
	echo "<script> location.href='index.html'; </script>";
	exit;

}
