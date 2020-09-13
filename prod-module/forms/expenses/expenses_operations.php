<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Role</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
			<div id="form_section1">CLICK APPROPIATE BUTTON TO PROCEED</div>
			<form action="update_role.php" method="post">
				<div id="form_section2">	
					<input type="button" value="REGISTER EXPENSE TYPE" id="rexptype"><br>
					<input type="button" value="UPDATE EXPENSE TYPE" id="uexptype"><br>				
					<input type="button" value="DELETE EXPENSE TYPE" id="dexptype"><br>									
					<input type="button" value="REGISTER EXPENSE" id="rexp"><br>
					<input type="button" value="UPDATE EXPENSE" id="uexp"><br>
					<input type="button" value="DELETE EXPENSE" id="dexp"><br>
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
		<script type="text/javascript"> 
            $("#rexptype").click(function(){
                $("#mod_display").load("forms/expenses/register_expense_type.php"); 
            });
			$("#uexptype").click(function(){
                $("#mod_display").load("forms/expenses/search_expense_type.php"); 
            });
			$("#dexptype").click(function(){
                $("#mod_display").load("forms/expenses/del_search_expense_type.php"); 
            });
			$("#rexp").click(function(){
                $("#mod_display").load("forms/expenses/register_expense.php"); 
            });
			$("#uexp").click(function(){
                $("#mod_display").load("forms/expenses/search_expense.php"); 
            });
			$("#dexp").click(function(){
                $("#mod_display").load("forms/expenses/del_search_expense.php"); 
            });
		</script>
</body>
</html>