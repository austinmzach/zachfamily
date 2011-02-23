<?php session_start();

	if ($_POST) {
		/*----------------------------*/
		/* SET UP DATABASE CONNECTION */
		/*----------------------------*/
		mysql_connect("72.167.233.67", "austinmichaelzac@72.167.233.37", "mavCath0lic") or
	        die("Could not connect: " . mysql_error());
	    mysql_select_db("austinmichaelzac");
	    
		// get user from db
		$query = "select * from user where username = '" . $_POST['username'] . "' and pass = '" . $_POST['pw'] . "'";
	    $user = mysql_query($query);
		
	    if (mysql_num_rows($user) != 1) {
	    	echo "something went haywire!";
	    } else {
			// set user session variable
			$user = mysql_fetch_array($user);
			$_SESSION['user'] = $user['username'];
	    	
	    	// redirect to home page
	    	$page = $_POST['page'];
			header("Location: $page.php");
	    }
		
	}
	
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />
		<link type="text/css" href="jquery/css/custom-theme/jquery-ui-1.8.5.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
		<script type="text/javascript" src="login.js"></script>
	</head>
	<body style="text-align:center;">
		<table style="margin:auto;"><tr><td>
			<form action="login.php" method="post" style="position:relative;display:block;top:100px;">
				<table style="text-align:left;">
					<tr id="firstname">
						<td><label>First Name: </label></td>
						<td><input type="text" class="padded" name="firstname" id="firstnameinput" /></td>
					</tr>
					<tr id="lastname">
						<td><label>Last Name: </label></td>
						<td><input type="text" class="padded" name="lastname" /></td>
					</tr>
					<tr>
						<td><label>Username: </label></td>
						<td>
							<input type="text" class="padded" name="username" id="username" />
						</td>
					</tr>
					<tr>
						<td><label>Password: </label></td>
						<td><input type="password" class="padded" name="pw" /></td>
					</tr>
					<tr id="confirmpw">
						<td><label>Confirm Password: </label></td>
						<td><input type="password" class="padded" name="confirmpw" /></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;">
							<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
							<input type="submit" class="button" value="Login" />
						</td>
					</tr>
					<tr id="register">
						<td colspan="2" style="text-align:center;">
							Not registered yet? <a href="#" onclick="register()">Do it now!</a>
						</td>
					</tr>
				</table>
			</form>
		</td></tr></table>
	</body>
</html>