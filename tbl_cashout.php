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
			<input class="button"  type="submit" value="tbl_merchant" name="tbl_merchant">
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

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 			
	$sql = "select * from cashout";
	$result = $conn->query($sql);
	if (!$result) 
	{
		trigger_error('Invalid query: ' . $conn->error);
	}	
	
	//credential_id
	if ($result->num_rows > 0) 
	{
		echo "<table align='center'><tr><th>merchant_id</th><th>tanggal_jam</th><th>jml_cashout</th><th>agen</th></tr>";
		while($row = $result->fetch_assoc()) 
		{	
			echo "
				<tr>	
					<td>".$row["merchant_id"]."</td>
					<td>".$row["tanggal_jam"]."</td>
					<td>".$row["jml_cashout"]."</td>	
					<td>".$row["agen"]."</td>
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