<?php

	if(!empty($_POST)){
    $myPhpVar = $_POST['name'];
    $pieces = explode(" ", $myPhpVar);
	
	echo trim($pieces[1]);
	}
?>

