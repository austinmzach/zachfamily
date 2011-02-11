<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>The Zach Family Gift Exchange</title>
		<style type="text/css">
			body	{
				text-align:center;
				background:#44DD44;
				font-family:Georgia, verdana, geneva, helvetica, trebuchet, sans serif;
				font-size:15px;
			}
			
			#title	{
				position:relative;
				display:block;
				width:100%;
				height:125px;
				line-height:100px;
				color:#e00;
				text-align:center;
				font-family: 'Tangerine', serif;
				font-size: 75px;
				font-style: normal;
				font-weight: 700;
				text-shadow: 6px 6px 6px #ccc;
			}
		
			.textbox {
				display:block;
				padding:5px;
				width:250px;
				margin:auto;
				color:#e00;
				border:1px solid #e00;
			}
			
			.button	{
				position:relative;
				display:block;
				height:55px;
				width:220px;
				border:0px;
				margin:auto;
				color:#e00;
				background:url("images/christmas_button.png") no-repeat;
			}
			
			.button:hover	{
				cursor:pointer;
				color:white;
				background:url("images/christmas_button_hover.png") no-repeat;
			}
			
			#theTable	{
				border-collapse:collapse;
			}
			
			#theTable td	{
				padding:5px;
				border:1px solid gray;
			}
			
			.head td	{
				background:#55EE55;
				color:#e00;
			}
		</style>
		<link  href="//fonts.googleapis.com/css?family=Tangerine:regular,bold&subset=latin" rel="stylesheet" type="text/css" >
		<script type="text/javascript" src="../charting/jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="../charting/jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
		<script type="text/javascript">
			function addPerson() {
				var html = '<tr name="person"><td><input type="text" name="name" class="textbox" /></td><td><input type="text" name="email" class="textbox" /></td></tr>'
				$("#buttonRow").before(html);
			}

			function submitForm() {
				aggregateInputs();
				document.getElementById("form").submit();
			}

			function aggregateInputs() {
				var names = "";
				$("input[name='name']").each(function(index) {
					if (index != 0) {
						names += ",";
					}
					names += $(this).val();
				});

				var emails = "";
				$("input[name='email']").each(function(index) {
					if (index != 0) {
						emails += ",";
					}
					emails += $(this).val();
				});

				$("#names").val(names);
				$("#emails").val(emails);
			}
		</script>
	</head>
	<body>
		<div id="title">
			The Zach Family Christmas Gift Exchange
		</div>
		<table style="margin:auto;"><tr><td>
			<?php 
				if ($_POST) {
					
					/*--------------*/
					/* LITTLE SETUP */
					/*--------------*/
					$names = split(",", $_POST['names']);
					$emails = split(",", $_POST['emails']);
					$numberOfPeeps = count($names);
					
					$random = $names;
					
					$goodToGo = false;
					
					/*----------------------------------------------------------------------*/
					/* RESHUFFLE THE NAMES UNTIL EVERYONE GETS A NAME THAT IS NOT THEIR OWN */
					/*----------------------------------------------------------------------*/
					while(!$goodToGo) {
						$goodToGo = true;
						shuffle($random);
						
						for ($i = 0; $i < $numberOfPeeps; $i++)
							if ($names[$i] == $random[$i])
								$goodToGo = false;
					}
					
					for ($i = 0; $i < $numberOfPeeps; $i++) {
						/*-----------------*/
						/* SEND OUT EMAILS */
						/*-----------------*/
						$to = $emails[$i];
						$subject = "Zach family gift exchange - TOP SECRET!!";
						$message = "Hello " . $names[$i] . ",\n\nYou must buy a gift for " . $random[$i] . " for the Zach family gift exchange.  The gift should be in the $20-$25 price range.\n\nThanks,\nManagement";
						$from = "no-reply@gmail.com";
						$headers = "From: $from";
						mail($to,$subject,$message,$headers) or die("something went haywire!");
					}
					
					echo "<p style='color:#e00;text-align:center;'>SUCCESS!<br />";
					echo "Emails sent!</p>";
					
				} else {
			?>
			
			<form action="index.php" method="post" id="form">
				<table id="theTable">
					<tr class="head">
						<td>Name</td>
						<td>E-mail Address</td>
					</tr>
					<tr>
						<td><input type="text" name="name" class="textbox" /></td>
						<td><input type="text" name="email" class="textbox" /></td>
					</tr>
					<tr id="buttonRow">
						<td colspan="2" style="text-align:center;border:0px;">
							<br />
							<input type="hidden" name="names" id="names" />
							<input type="hidden" name="emails" id="emails" />
							<input type="button" class="button" value="Add Person" id="add" onclick="addPerson()" />
							<br />
							<input type="button" class="button" value="Submit" onclick="submitForm()" />
						</td>
					</tr>
				</table>
			</form>
			
			<?php 
				}
			?>
			
		</td></tr></table>
		
		<div style="position:absolute;display:block;height:600px;width:400px;right:0px;bottom:0px;background:url('images/tree.png');"></div>
	</body>
</html>