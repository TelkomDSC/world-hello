<?php
	session_start();
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
				padding: 15px 32px;
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
		<form  class="center" action="" method=post>
			<b>USERNAME:</b> <input  name="username" type="text"><br>
			<b>PASSWORD:</b> <input  name="password" type="password"><br>
			<a href="register2.php">register</a><br>
			<b><input class="button"  type="submit" value="SUBMIT" name="SubmitButton"></b><br>
		</form>
	</body>
</html>

<?php
	if(isset($_POST['SubmitButton']))
	{ 
		$servername = "172.30.59.35:3306";
		$username = "root";
		$password = "PRpEcJBlcDwt6Amy";
		$dbname = "paybyqr";
			
		/*<form class="center" action='' method=post>
		Jumlah Cashout<br>
		<input name='subtract' type='number'><br>
		<input class="button" type="submit" value="Cancel" name="CancelButton">
		<input class="button" type="submit" value="Submit" name="SubmitButton">
		</form>*/
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		} 			
		$result = $conn->query("select * from user");	
		$isPassSalah=true;
		$pword = $_POST["password"];
		$uname = $_POST["username"];
		
		$isPassBenar=false;
		
	while($row = $result->fetch_assoc()) 
		{
			if($uname==$row["username"])
			{	
				if(md5($pword)==$row["password"])
				{
					$isPassSalah=false;
					$isPassBenar=true;
					echo "<meta http-equiv='refresh' content='0; url=crud2.php'>";
					$_SESSION['favcolor'] = $uname;
				}
				else
				{
					$isPassSalah=true;
				}
			}	
			else
			{
				$isPassSalah=true;
			}
				
		}
		
		if($isPassSalah==true && $isPassBenar==false)
		{
			echo "<script>alert('username atau password salah')</script>";
		}
		
	}
?>
