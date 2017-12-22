<?php
	session_start();
	$uname=$_SESSION['favcolor'];
?>
<html>
	<head>
		<style>
			table 
			{
				border-collapse: collapse;
				font-family: Calibri;
			}
			body
			{
				color: rgb(80,80,80);
				background-color: rgb(16,32,43);
			}
			th, td 
			{
				text-align: left;
				padding: 8px;
			}
			
			tr:nth-child(even)
			{
				background-color: rgb(255,255,255);
			}
			tr
			{
				background-color: rgb(220,220,220);
			}				
			th 
			{
				background-color: rgb(32,64,86);
				color: white;
				font-family: Arial;
				position: relative;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<form action="" method=post>
			<input class="button"  type="submit" value="log out" name="logout">
			<input class="button"  type="submit" value="Daftar Merchant" name="tbl_merchant">
		</form>	
	</body>
</html>

<?php		
	if(isset($_POST['logout']))
	{	
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=pw2.php'>";		
	}
	
	if(isset($_POST['tbl_merchant']))
	{	
		
		echo "<meta http-equiv='refresh' content='0; url=crud2.php'>";		
	}
	
	$servername = "172.30.59.35:3306";
	$username = "root";
	$password = "PRpEcJBlcDwt6Amy";
	$dbname = "paybyqr";
		
	$id=$_GET["histori"];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 			
	$sql = "select * from transaction,merchant where merchant.merchant_id='$id' and transaction.transaction_status='PAYMENT_SUCCEED'";
	$result = $conn->query($sql);
	if (!$result) 
	{
		trigger_error('Invalid query: ' . $conn->error);
	}	
	
	//credential_id
	if ($result->num_rows > 0) 
	{
		echo "<table align='center'><tr>
		<th>merchant_name</th>
		<th>net_balance</th>
		<th>solved_date</th>
		<th>amount</th>
		<th>merchant_tip</th>
		<th>total_amount</th>
		<th>discount_amount</th>
		<th>surcharge_fee</th>
		<th>amount_payed</th>
		<th>cashout</th>
		</tr>";
		while($row = $result->fetch_assoc()) 
		{	
			echo "
				<tr>	
					<td>".$row["merchant_name"]."</td>
				
					<td>".$row["net_balance"]."</td>
					<td>".$row["solved_date"]."</td>	
					<td>".$row["amount"]."</td>	
					<td>".$row["merchant_tip"]."</td>	
					<td>".$row["total_amount"]."</td>	
					<td>".$row["discount_amount"]."</td>	
					<td>".$row["surcharge_fee"]."</td>	
					<td>".$row["amount_payed"]."</td>						
					<td>
						<form action=cashout2.php?data=".$row['merchant_id'].">
							<input type='submit' name='cashout' value=".$row['merchant_id'].">
						</form>
					</td>
				</tr>
			";	
		}
		echo "</table>";
	} 
	else 
	{
		echo "0 results";
	}
	$conn->close();			    	
?> 