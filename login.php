<?php
	session_start();

	$message = "";
	$_SESSION['IsAuthorized'] = false;
	$usernames = array("something@nothing.com","somethingelse@nothingelse.com");
	
	if ($_POST) {
		if (($_POST['username'] == "austin" || $_POST['username'] == "melissa") && $_POST['password'] == "August7") {
			$_SESSION['IsAuthorized'] = true;
			$_SESSION['user'] = $_POST['username'];
			header("Location: index.php");
		} else if (in_array(strtolower($_POST['username']), $usernames)) {
			$_SESSION['user'] = $_POST['username'];
			header("Location: index.php");
		} else {
			$message = "Login attempt failed.  Please try again.";
		}
	}
	
	require_once("header.php");
?>

<?php if ($message != "") { echo "<span class='alert'>$message</span><br />"; } ?>

<form style="position:relative;display:block;height:333px;width:100%;text-align:center;background:url('images/lock.png') no-repeat;background-position:center;" action="login.php" method="post">
	<br />
	<br />
	<br />
	
	<span style="position:relative;display:block;width:400px;margin:auto;">
		<span style="font-weight:bold;">Please enter your email address</span><br />
		(Don't worry, you're not gonna get spammed)
	</span>
	
	<br />
	<?php echo "some stuff here woohoolll"; ?>
	<br />
	<br />

	<div style="position:relative;display:block;width:300px;margin:auto;">
		Email: <input type="text" id="username" name="username" onkeyup="showPassword()" />
		
		<div style="position:absolute;display:block;left:250px;width:300px;top:0px;" id="password">
			Password: <input type="password" name="password" />
		</div>
		
		<br />
		<br />
		
		<input type="submit" value="Sign in" class="button" />
	</div>
</form>
					
<?php require_once("footer.php"); ?>