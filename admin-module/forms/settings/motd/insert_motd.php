<?php
// Include config file
//require_once "class.config.php";
 
// Define variables and initialize with empty values
//$theusername = "";


//class messageActions{

//    public $link;      

//    function __construct(){
//        $db_connection = new dbConnection();
//        $this->link = $db_connection->connect();   
//        return $this->link;
//    }

//    function motd($message){
//        $query = $this->link->prepare("INSERT INTO MOTD_ADM (Message) VALUES (?)");
//        $values = array($message);
//        $query->execute($values);
//        $counts = $query->rowCount();
//        return $counts;
//    }
//}

//$messages = new messageActions();
//if($_SERVER["REQUEST_METHOD"] == "POST"){
     $theusername = $_POST['message'];
	 echo "Message of the Day: "$theusername;
//	echo $messages->motd($theusername);
//}


?>


	