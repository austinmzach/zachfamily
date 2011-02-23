<?php
	session_start();
	
	if (!isset($_SESSION['user']) && strpos($_SERVER['PHP_SELF'], "login.php") === false) {
		header("Location: login.php");
	}
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>The Zach Family | Blog</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />
		<link type="text/css" href="charting/jquery/css/custom-theme/jquery-ui-1.8.5.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="charting/jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="charting/jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<div id="top-gradient"></div>
		<div id="content" style="min-height:500px;">
			<div id="titlebar">
				<a href="index.php" id="logo"></a>
			
				<?php if (isset($_SESSION['user'])) { ?>
					<span id="welcome">Welcome, <?php echo $_SESSION['user']; ?></span>
					<?php if ($_SESSION['IsAuthorized']) { ?><a href="newblog.php" id="newblog">New Blog</a><?php } ?>
					<a href="logout.php?redirect=<?php echo $_SERVER['PHP_SELF']; ?>" id="log">Logout</a>
				<?php } else { ?>
					<a href="login.php?redirect=<?php echo $_SERVER['PHP_SELF']; ?>" id="log">Login</a>
				<?php } ?>
				
				<div id="toolbar">
					<a href="index.php" class="left">Home</a>
					<a href="#">About Us</a>
					<a href="#">Photos</a>
					<a href="#">Careers</a>
					<a href="blog.php" class="right">Blog</a>
				</div>
			</div>
			<div id="pageHeader"></div>
			<div id="pageBody">
				<div id="page_content">