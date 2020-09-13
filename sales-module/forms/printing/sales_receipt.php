<?php


	//Start Session
	session_start();
	
	
	if(!isset($_SESSION)){
		
		// Redirect user to index page	
		echo "<script> location.href='../../../frontend/index.html'; </script>";
		exit;
		
	}else{
		
		// Get Session Details
		$e_id = $_SESSION['EmployeeID'];
/*
		// Include setup.php file
		include "../../scripts/sales_queries.php";
		
		// Create Objects 
		$user_pos = new querySALES();
		$customer_debt_list = new querySALES();
		
		// Query Data from Database
		$posid = $user_pos->fetch_pos_id($e_id);
		$debtlist = $customer_debt_list->fetch_sales_ref_number($posid);
*/
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PREVIEW RECEIPT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet"  type="text/css" href="../../../frontend/style.css">
</head>
<body>
	<div id="form_wrapper">
		<div id="form_section1" class="summary_eventType"></div>
			<table border="1" style="width:100%">
				<thead>
					<tr>
						<th colspan="1">LOGO</th>
						<th colspan="5" align="right">SALES RECEIPT</th>
					</tr>
					<tr>
						<td colspan="4">Princess Banana</th>
						<td  colspan="1"  align="right">Sales Date: </td>
						<td  colspan="1"  align="right">06/01/2020</td>
					</tr>
					<tr>
						<td colspan="4">Sales Person: Rajabu Kitindi</th>
						<td  colspan="1"  align="right">Receipt#: </td>
						<td  colspan="1"  align="right">0001</td>
					</tr>
					<tr>
						<td colspan="6">
							<strong>Sold to:</strong><br>
							Contact Name.<br>
							Acme Billing Co.<br>
							123 Main St, Cityville, NA 12345
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<strong>Payment method: </strong> Display payment method here
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Qty</th>
						<th>Item#</th>
						<th colspan="2">Description</th>
						<th>Unit Price</th>
						<th>Cost</th>
					</tr>
					<tr>
						<td>Paperclips</td>
						<td >1000</td>
						<td colspan="2">0.01</td>
						<td align="center">10.00</td>
						<td align="center">10.00</td>
					</tr>
					<tr>
						<td>Staples (box)</td>
						<td >100</td>
						<td colspan="2">1.00</td>
						<td align="center">100.00</td>
						<td align="center">100.00</td>
					</tr>
					<tr>
						<td>Paperclips</td>
						<td >1000</td>
						<td colspan="2">0.01</td>
						<td align="center">10.00</td>
						<td align="center">10.00</td>
					</tr>
					<tr>
						<td>Staples (box)</td>
						<td >100</td>
						<td colspan="2">1.00</td>
						<td align="center">100.00</td>
						<td align="center">100.00</td>
					</tr>
					<tr>
						<td>Paperclips</td>
						<td >1000</td>
						<td colspan="2">0.01</td>
						<td align="center">10.00</td>
						<td align="center">10.00</td>
					</tr>
					<tr>
						<td>Staples (box)</td>
						<td >100</td>
						<td colspan="2">1.00</td>
						<td align="center">100.00</td>
						<td align="center">100.00</td>
					</tr>
					<tr>
						<td>Paperclips</td>
						<td >1000</td>
						<td colspan="2">0.01</td>
						<td align="center">10.00</td>
						<td align="center">10.00</td>
					</tr>
					<tr>
						<td>Staples (box)</td>
						<td >100</td>
						<td colspan="2">1.00</td>
						<td align="center">100.00</td>
						<td align="center">100.00</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5" align="left">Subtotal</th>
						<td align="center"> 110.00</td>
					</tr>
					<tr>
						<th colspan="5" align="left">Tax(8%)</th>
						<td align="center">8.80</td>
					</tr>
					<tr>
						<th colspan="5" align="left">Grand Total</th>
						<td align="center">$ 118.80</td>
					</tr>
					<tr>
						<td colspan="6" align="center"><br>
							<strong>Thank you for your Business:</strong><br>
							Acme Billing Co, 123 Main St, Cityville, NA 12345
						</td>
					</tr>
				</tfoot>
			</table>
			<form>
				<div id="form_section2">	
					<input type="button" value="PRINT RECEIPT" id="print">	
				</div>
				<div id="form_bottons"></div>
			</form>
	</div>
</body>
</html>