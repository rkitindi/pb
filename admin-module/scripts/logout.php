<?php

//Start Session
session_start();

if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../frontend/index.html'; </script>";
		exit;
		
}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
	
	//Destroy Session
	session_destroy();
		
	// Redirect user to index page	
	echo "<script> location.href='../../frontend/index.html'; </script>";
	exit;
	
}
	

	
	


