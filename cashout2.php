<?php
	session_start();
	$agen=$_SESSION['favcolor'];
	echo "welcome ".$agen;
?>
<html>
<head>
		<style>
			table, th, td 
			{
				border: 1px solid black;
			}
			body
			{
				font-family: 'Calibri';
				color: rgb(255,255,255);
				background-color: rgb(32,64,86);
			}
			.button
			{
				background-color: #4CAF50;
				border: none;
				color: white;
				padding: 7px 25px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				position:relative;
				top:20px;
				border-radius: 12px;
			}
			.center 
			{
				position: absolute;
				left: 0;
				top: 30%;
				width: 100%;
				text-align: center;
				font-size: 18px;
			}			
			.bottomcenter
			{
				position: absolute;
				left: 0;
				top: 50%;
				width: 100%;
				text-align: center;
				font-size: 18px;
			}			
			input[type="text"],input[type="password"]
			{
				background: rgba(255, 255, 255, 0.9);
				border: none;
				font-size: 16px;
				height: auto;
				margin: 0;
				outline: 0;
				padding: 15px;
				
				background-color: #e8eeef;
				color: #8a97a0;
				box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
				margin-bottom: 30px;
			}			
			input[type="text"]
			{
				top:10px;
			}
			.bottom 
			{
				position: absolute;
				left: 0;
				top: 63%;
				width: 100%;
				text-align: center;
				font-size: 18px;
			}
			a:link 
			{
				text-decoration: none;
				color:white;
				width:100%;
			}
		</style>
	</head>
	<body>
		<script>
			function ask() 
			{
			  return confirm('confirm');
			}
		</script>
		<form class="center" action='' method=post>
			Jumlah Cashout<br>
			<input name='subtract' type='number'><br>
			<input class="button" onclick="return ask()" type="submit" value="OK" name="SubmitButton">
			<input class="button" type="submit" value="Cancel" name="CancelButton">
		</form>
	</body>
</html>
<?php
	if(isset($_POST['CancelButton']))
	{
		echo "<meta http-equiv='refresh' content='0; url=crud2.php'>";
	}
	if(isset($_POST['SubmitButton']))
	{
		$servername = "172.30.59.35:3306";
		$username = "root";
		$password = "PRpEcJBlcDwt6Amy";
		$dbname = "paybyqr";
		
		$subtract=$_POST['subtract'];
		echo $subtract;
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		} 			
		
		$id=$_GET["cashout"];
			
		$sql=mysqli_query($conn,"select net_balance,gross_balance from merchant where merchant_id='$id'");
		$result=mysqli_fetch_array($sql);
		
		$net_balance=$result['net_balance'];
		$gross_balance=$result['gross_balance'];
		$subtracted=$net_balance-$subtract;
		$subtracted2=$gross_balance-$subtract;
			
		$sql2 = "update merchant set net_balance='$subtracted' where merchant_id='$id'";
		$result2 = $conn->query($sql2);
			
		$sql4 = "update merchant set gross_balance='$subtracted2' where merchant_id='$id'";
		$result4 = $conn->query($sql4);
			
		$sql3 = "insert into cashout (merchant_id,jml_cashout,agen) values('$id','$subtract','$agen')";
		$result3 = $conn->query($sql3);
		echo "<meta http-equiv='refresh' content='0; url=crud2.php'>";
	}
?>
