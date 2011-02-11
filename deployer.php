<?php
	if ($_POST) {
		$hostname = 'zachfamily.db.6874509.hostedresource.com';
		$username = 'zachfamily';
		$password = 'August7';
		$dbname = 'zachfamily';
		
		mysql_connect($hostname, $username, $password) or die("Error: " . mysql_error());
		mysql_select_db($dbname);
		
		$query = "insert into json_test(json_data) values('" . print_r($_POST) . "')";
	}
?>