<?php

	//Start Session
	session_start();

	// Include setup.php file
	include "scripts/fe_queries.php";

	// read the product categories from the database
	$motd_list = new queryFRONTEND();
	$motd = $motd_list->fetch_MOTD();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PRINCESS BANANA ERP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet"  type="text/css" href="style.css">
    </head>
    <body>
      <!-- CONTAINER -->
      <div class="container" id="container">
        <!-- HEADER -->
        <div id="header">
           <div id="logo">PRINCESS BANANA</div>
           <div id="top_info">ENTERPRISE RESOURCE PLANNING SYSTEM</div>
           <div id="navbar">
             <ul>
                 <li><a href="#">HOME</a></li>
                  <li><a href="../hr-module/hr-mod.html">HR</a></li>
				 <li><a href="../prod-module/prod-mod.html">PRODUCTION</a></li>
                 <li><a href="../ops-module/operations-mod.html">ACCOUNTING</a></li>
                 <li><a href="../sales-module/sales-mod.php">SALES</a></li>
				 <li><a href="../finance-module/finance-mod.php">FINANCE</a></li>
				 <li><a href="../mgmnt-module/mgmnt-mod.php">MANAGEMENT</a></li>
                 <li><a href="../reports-module/reports-mod.php">REPORTS</a></li>
                 <li><a href="../analytics-module/analytics-mod.php">TRENDS</a></li>
				 <li><a href="../admin-module/admin-mod.php">ADMIN</a></li>
             </ul>
           </div>
        </div>
        <!-- CONTENT AREA  -->
        <div id="content_area">
            <div id="login_0">Login Success!</div>
			<div id="login_1">
				<div id="form_wrapper">
					<div id="form_section1">
						<img src="images/logo.jpeg" alt="Smiley face" width="70" height="65">
					</div>
				</div>
			</div>
			<div id="sitemessages"><marquee behavior="scroll" direction="left"><?php echo $motd; ?></marquee></div>
		</div>
		        <!-- FOOTER -->
        <div id="footer">
           <div id="section_1">Developed by: Enafritech <br> www.enafritech.com</div>
           <div id="section_2">Report Problem</div>
           <div id="section_3">
		   		<form id="logout_form">
					<input type="submit" id="logout_btn" name="logout" value="LOGOUT">
				</form>
		   </div>
        </div>
	</div>

	<script>

		$("#logout_btn").click(function(){
            $.get("scripts/login.php", $("#logout_form").serialize(), function(response) {
				$("#form_wrapper").html(response);
			});
			return false;
        });

	</script>
	
   </body>
</html>
