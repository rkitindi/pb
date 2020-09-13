<?php
// Include config file
require "../scripts/config.php";
 
// Define variables and initialize with empty values
$role_name = $role_desc  = "";
$role_name_err = $role_desc_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate Role Name
    if(empty(trim($_POST["role_name"]))){
        $role_name_err = "Please enter Role Name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT role_name FROM user_roles WHERE role_name = ?";
        
		$select = mysqli_query($link, "SELECT `role_name` FROM `user_roles` WHERE `role_name` = '".$_POST['role_name']."'") or exit(mysqli_error($link));
		if(mysqli_num_rows($select)) {
			exit('This email is already being used');
		}
    }
    
    // Validate Role Description
    if(empty(trim($_POST["role_desc"]))){
        $role_desc_err = "Please enter a role_desc.";     
    } elseif(strlen(trim($_POST["role_desc"])) < 4){
        $role_desc_err = "Role Description must have atleast 4 characters.";
    } else{
        $role_desc = trim($_POST["role_desc"]);
		$role_name = trim($_POST["role_name"]);
    }
    
   
    // Check input errors before inserting in database
    if(empty($role_name_err) && empty($role_desc_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user_roles (role_name, role_desc) VALUES ($role_desc, $role_name)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_role_name, $param_role_desc);
            
            // Set parameters
            $param_role_name = $role_name;
            $param_role_desc = $role_desc; 
            
        }
         	 
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>