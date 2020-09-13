<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Add MOTD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet"  type="text/css" href="../../../../frontend/style.css">
</head>

<body>

	<div id="form_wrapper">
			<div id="form_section1"> FILL THIS FORM BELOW TO ADD NEW MOTD</div>
			<form id="motd-form">
				<div id="form_section2">				
					<label for="message">Message:</label><br>
					<input type="text" id="message" name="message" required placeholder="Type any message of the day"><br>
				</div>
				<div id="form_bottons">
					<div id="submit"><input id="send-btn" type="submit" name="insert" value="SUBMIT"></div>
					<div id="reset"><input type="reset" value="RESET" /></div>
				</div>
			</form>
	</div>
	
	<script> 	
	       			
				$("#send-btn").click(function(){        
					$.post("insert_motd.php", $("#motd-form").serialize(), function(data) {
						alert(data);
					});
				});						
			
	</script>
	
</body>

</html>