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
			<div id="form_section1">CONFIRM OR CHANGE EMPLYEE DETAILS THEN CLICK PAY BUTTON</div>
			<form action="insert.php" method="post">
				<div id="form_section2">				
					<label for="pdate">Pay Date:</label><br>
					<input type="date" id="pdate" name="pay_date" required placeholder="Select Date"><br>
					<label for="fname">First Names:</label><br>
					<input type="text" id="fname" name="First_names" required placeholder="example (Jose Luise)"><br>
					<label for="lname">Last names:</label><br>
					<input type="text" id="lname" name="Last_names" required placeholder="example (Lomeli Corona)"><br>
					<label for="amount">Amount</label><br>
					<input type="number" id="amount" name="pay_amount" required placeholder="MXN PESOS"><br>
					<label for="pos">Payment Method</label><br>
					<input type="text" id="pos" name="pos-id" required placeholder="Select Payment Method"><br>
					<label for="dispatch">STATUS</label><br>
            		<input type="radio" id="1" name="dispatch" value="1"><label for="1">Paid</label>
            		<input type="radio" id="0" name="dispatch" value="0"><label for="0">Not Paid</label><br><br>
					<label for="comments">Comments:</label><br>
					<input type="text" id="comments" name="comments" required placeholder="Any other comments"><br>
					<label for="attach">Upload Check Or Bank Transfer Receipt</label><br>
					<input type="file" id="attach" name="attach_doc" required placeholder="Attach Document"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input type="submit" name="insert" value="PAY"></div>
					<div id="reset"><input type="reset" value="RESET" /> </form></div>
				</div>
			</form>
	</div>
</body>
</html>