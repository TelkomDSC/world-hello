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
	
	
</html>

<?php	
	
	if($uname==NULL)
	{
		echo "silahkan login";
		echo "
			<body>
				<form action='' method=post>
					<input class='button'  type='submit' value='back' name='back'>
				</form>	
			</body>
		";
		if(isset($_POST['back']))
		{	
			session_destroy();
			echo "<meta http-equiv='refresh' content='0; url=pw2.php'>";		
		}
			
	}
	else
	{
		echo"
			<body>
				<form action='' method=post>
					<input class='button'  type='submit' value='log out' name='logout'>
					<input class='button'  type='submit' value='History Cashout' name='tbl_cashout'>
				</form>	
			</body>
		";
		
		if(isset($_POST['logout']))
		{	
			session_destroy();
			echo "<meta http-equiv='refresh' content='0; url=pw2.php'>";		
		}
		
		if(isset($_POST['tbl_cashout']))
		{	
			
			echo "<meta http-equiv='refresh' content='0; url=tbl_cashout.php'>";		
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
		$sql = "select credential.*,merchant.* from credential,merchant where credential.credential_id=merchant.merchant_id";
		$result = $conn->query($sql);
		if (!$result) 
		{
			trigger_error('Invalid query: ' . $conn->error);
		}	
		
		//credential_id
		if ($result->num_rows > 0) 
		{
			echo "<table align='center'><tr><th>merchant_id</th><th>username</th><th>merchant_api_key</th><th>merchant_name</th><th>merchant_outlet_name</th><th>director_name</th><th>username</th><th>net_balance</th><th>gross_balance</th><th>cashout</th></tr>";
			while($row = $result->fetch_assoc()) 
			{
				$lol= 
				"gross_balance:		".$row["gross_balance"].
				"&#013;net_balance:		".$row["net_balance"].
				"&#013;credential_id:		".$row["credential_id"].
				"&#013;director_name:		".$row["director_name"].
				"&#013;merchant_name:		".$row["merchant_name"].
				"&#013;merchant_outlet_name:	".$row["merchant_outlet_name"].
				"&#013;merchant_outlet_address:	".$row["merchant_outlet_address"].
				"&#013;company_name:		".$row["company_name"].
				"&#013;director_identity_type_id:	".$row["director_identity_type_id"].
				"&#013;director_identity_id:	".$row["director_identity_id"].
				"&#013;merchant_pic_name:	".$row["merchant_pic_name"].
				"&#013;merchant_pic_email:	".$row["merchant_pic_email"].
				"&#013;merchant_pic_phone:	".$row["merchant_pic_phone"].
				"&#013;merchant_contact_name:	".$row["merchant_contact_name"].
				"&#013;merchant_contact_email:	".$row["merchant_contact_email"].
				"&#013;merchant_contact_phone:	".$row["merchant_contact_phone"].
				"&#013;merchant_email:		".$row["merchant_email"].
				"&#013;referral_code:		".$row["referral_code"].
				"&#013;merchant_address:	".$row["merchant_address"].
				"&#013;province_id:		".$row["province_id"].
				"&#013;city_id:			".$row["city_id"].
				"&#013;zip_code:		".$row["zip_code"].
				"&#013;phone:			".$row["phone"].
				"&#013;bussiness_type:		".$row["bussiness_type"].
				"&#013;bussiness_age:		".$row["bussiness_age"].
				"&#013;sales_estimation:		".$row["sales_estimation"].
				"&#013;ave_transaction_per_month:".$row["ave_transaction_per_month"].
				"&#013;identity_id:		".$row["identity_id"].
				"&#013;identity_img:		".$row["identity_img"].
				"&#013;bank_id:			".$row["bank_id"].
				"&#013;bank_account_name:	".$row["bank_account_name"].
				"&#013;bank_account_number:	".$row["bank_account_number"].
				"&#013;bank_img:		".$row["bank_img"].
				"&#013;opening_time:		".$row["opening_time"].
				"&#013;closing_time:		".$row["closing_time"].
				"&#013;registered_date:		".$row["registered_date"];
				
				echo "
					<tr>	
						<td>
							<a href=# title='$lol'>
								".$row["merchant_id"]."
							</a>
						</td>
						<td>".$row["username"]."</td>
						<td>".$row["merchant_api_key"]."</td>
						<td>".$row["merchant_name"]."</td>
						<td>".$row["merchant_outlet_name"]."</td>
						<td>".$row["director_name"]."</td>	
						<td>".$row["username"]."</td>	
						<td>".$row["net_balance"]."</td>	
						<td>".$row["gross_balance"]."</td>
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
	}
			    	
?> 
