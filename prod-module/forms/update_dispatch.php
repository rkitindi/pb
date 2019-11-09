<?php
// Include config file
require_once "../scripts/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Role</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CONFIRM OR CHANGE DISPATCH DETAILS BELOW THEN CLICK UPDATE BUTTON</div>
			<form action="insert.php" method="post">
				<div id="form_section2">				
					<label for="pname">Batch Name:</label><br>
					<input type="text" id="pname" name="prod_name" required placeholder="Confirm or change batch name"><br>
					<label for="pcode">Product Code:</label><br>
					<input type="text" id="pcode" name="prod_code" required placeholder="Confirm or change Product code"><br>
					<label for="t-id">Track ID:</label><br>
					<input type="text" id="t-id" name="track_id" required placeholder="Confirm or change Track ID from the list"><br>
					<label for="dname">Driver Name</label><br>
					<input type="text" id="dname" name="driver_name" required placeholder="Confirm or change Driver name from list"><br>
					<label for="quantity">Quantity</label><br>
					<input type="number" id="quantity" name="quantity" required placeholder="Confirm or change Quantity  in Boxes"><br>
					<label for="pos">Point of Sale</label><br>
					<input type="number" id="pos" name="pos-id" required placeholder="Confirm or change Point of Sale Receiving"><br>
					<label for="dispatch">SELECT</label><br>
            		<input type="radio" id="1" name="dispatch" value="1"><label for="1">Dispatched</label>
            		<input type="radio" id="0" name="dispatch" value="0"><label for="0">Not Dispatched</label><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input type="submit" name="insert" value="UPDATE"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
</body>
</html>