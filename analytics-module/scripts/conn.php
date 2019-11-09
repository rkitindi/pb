<?php
$servername = "localhost";
$username = "demouser";
$password = "demopassword";

//Creating connection for mysql
$pdoConnect = new PDO("mysql:host=$servername;dbname=ps_database", $username, $password);

?>
