<?php
	/*session_start();
	
	if (!$_SESSION['user']) {
		header("Location: login.php?page=$page");
	}*/
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	/*----------------------------*/
	/* SET UP DATABASE CONNECTION */
	/*----------------------------*/
	/*mysql_connect("72.167.233.67", "austinmichaelzac@72.167.233.37", "mavCath0lic")
		or die("Could not connect: " . mysql_error());
    mysql_select_db("austinmichaelzac");*/
?>
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>Charting</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />
		<link type="text/css" href="jquery/css/custom-theme/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
		<?php echo $head; ?>	
		<script type="text/javascript" src="jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="jquery/js/jquery-ui-1.8.2.custom.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<div id="titlebar">
			<div id="logo">
			</div>
			<div id="titlebar-right">
				<a href="logout.php" id="logout">Logout</a>
				<span id="observation">Record New Observation</span>
			</div>
		
		
			<!--<div id="logo">
				<span id="cm">CREIGHTON MODEL</span>
				<span id="fcs">Fertility<i>Care</i>&trade; System</span>
			</div>-->
			
			<!-- <form action="index.php" method="post" style="position:absolute;right:50px;">
				<table style="margin:auto;text-align:left;">
					<tr>
						<td style="font-weight:bold;">Date: </td>
						<td style="color:seagreen;font-weight:bold;">
							<input type="text" name="date" id="datepicker" />
						</td>
					</tr>
					<tr>
						<td style="font-weight:bold;">Observation Line 1: </td>
						<td>
							<input type="text" name="observation1" />
						</td>
					</tr>
					<tr>
						<td style="font-weight:bold;">Observation Line 2: </td>
						<td>
							<input type="text" name="observation2" />
						</td>
					</tr>
					<tr>
						<td>
							<label id="intercourselabel"><input type="checkbox" name="intercourse" onclick="toggle('intercourse')" id="intercourse" /> Intercourse</label>
						</td>
						<td style="text-align:center;">
							<input type="submit" value="Submit" class="button" />
						</td>
					</tr>
				</table>
			</form>-->
		</div>