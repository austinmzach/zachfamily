<?php
	if ($_POST) {
		
		$to = "austinmzach@gmail.com";
		$subject = "Deployer kicked off";
		$message = "Deploying the following commit: " . prin_r($_POST);
		$from = "austinmzach@gmail.com";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		
		$hostname = 'zachfamily.db.6874509.hostedresource.com';
		$username = 'zachfamily';
		$password = 'August7';
		$dbname = 'zachfamily';
		
		mysql_connect($hostname, $username, $password) or die("Error: " . mysql_error());
		mysql_select_db($dbname);
		
		$query = "insert into json_test(json_data) values('" . print_r($_POST) . "')";
	} else { ?>
		<html>
			<head>
				<title>testing deploy</title>
			</head>
			<body>
				<form action="deployer.php" method="post">
					<input type="hidden" name="deploying" value="yes" />
					<input type="hidden" name="choking" value="no" />
					<input type="submit" value="deploy" />
				</form>
			</body>
		</html>
	<?php }
?>