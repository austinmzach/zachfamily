<?php

	require_once("ChartingDao.php");
	require_once("model/Chart.php");
	require_once("model/Observation.php");
	require_once("model/Response.php");
	
	/*session_start();
	
	if (!$_SESSION['user']) {
		header("Location: login.php?page=$page");
	}*/
	
?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>Charting</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />
		<link type="text/css" href="jquery/css/custom-theme/jquery-ui-1.8.5.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery/jquery.scrollTo.js"></script>
		<script type="text/javascript" src="jquery/jquery.scrollTo-min.js"></script>
	</head>
	<body>
		<div id="titlebar">
			<div id="logo">
			</div>
			<div id="titlebar-right">
				<a href="logout.php" id="logout">Logout</a>
				
				<span id="btnObservation" onclick="openDialog()">Record New Observation</span>
			</div>
		</div>
		
		<div id="titlebarSpacer" style="position:relative;display:block;height:155px;"></div>
		
		<?php 
		
			$chartingDao = new ChartingDao();
			
			/*-------------------------------------------*/
			/* INSERT NEW OBSERVATIONS IF FORM SUBMITTED */
			/*-------------------------------------------*/
			if ($_POST) {
				$observation = new Observation();
				$date = substr($_POST['date'], 6, 4) . "-" . substr($_POST['date'], 0, 2) . "-" . substr($_POST['date'], 3, 2);
				$observation->setDate($date);
				$observation->setObservation($_POST['line1']);
				$observation->setObservation2($_POST['line2']);
				if ($_POST['intercourse'])
					$observation->setIntercourse(1);
				else
					$observation->setIntercourse(0);
				$observation->setBackground($_POST['background']);
				
				$response = $chartingDao->insertObservation($observation);
				
				?>
				
				<table style="margin:auto;"><tr><td>
					<div class="ui-widget">
						<div class="ui-state-<?php echo $response->getCssClass(); ?> ui-corner-all" style="padding: 10px;">
							<p>
								<span class="ui-icon ui-icon-<?php echo $response->getCssIcon(); ?>" style="float: left; margin-right: 5px;"></span>
								<strong><?php echo $response->getType(); ?></strong>
								<?php echo $response->getMessage(); ?>
							</p>
						</div>
					</div>
				</td></tr></table>
				
				<?php
			}
			
			
			/*----------------*/
			/* DRAW THE CHART */
			/*----------------*/
			$chart = $chartingDao->getChart();
			$chart->draw();
			
		?>
		
		<div id="footerSpacer" style="position:relative;display:block;height:65px;"></div>
		
		<div id="titlebar">
			<div id="logo">
			</div>
			<div id="titlebar-right">
				<a href="logout.php" id="logout">Logout</a>
				
				<span id="btnObservation" onclick="openDialog()">Record New Observation</span>
			</div>
		</div>
		
		<div id="footer">
			<?php $year = getDate();?>
			Copyright &copy; <?php echo $year['year']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;Pope Paul VI Institute&nbsp;&nbsp;|&nbsp;&nbsp;All rights reserved.
		</div>
			
		<div id="dialogWrapper" style="display:none;position:absolute;height:100%;width:100%;top:0px;left:0px;">
			<div class="ui-overlay">
				<div class="ui-widget-overlay" id="fadedBG"></div>
				<div class="ui-widget-shadow ui-corner-all" id="dialogShadow" style="width: 420px; height: 350px; position: absolute;"></div>
			</div>
			<div id="dialogContent" style="position: absolute; width: 398px; height: 328px; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">
			
					<form method="post" action="index.php" id="form">
						<table style="margin:auto">
							<tr>
								<td colspan="2" style="font-weight:bold;text-align:center;border-bottom:1px solid silver;height:30px;line-height:30px;">New Observation</td>
							</tr>
							<tr>
								<td>
									<table style="margin:auto;text-align:left;">
										<tr>
											<td style="width:75px;"><label>Date: </label></td>
											<td style="width:150px;text-align:left;"><input type="text" name="date" id="date" class="padded" /></td>
										</tr>
										<tr>
											<td><label>Line 1: </label></td>
											<td><input type="text" name="line1" id="line1" class="padded" /></td>
										</tr>
										<tr>
											<td><label>Line 2: </label></td>
											<td><input type="text" name="line2" id="line2" class="padded" /></td>
										</tr>
										<tr>
											<td></td>
											<td>
												<label><input type="checkbox" name="intercourse" id="intercourse" /> Intercourse</label>
											</td>
										</tr>
										<tr>
											<td>Stamp: </td>
											<td>
												<select name="background" id="background">
													<option value=""></option>
													<option value="red">Red</option>
													<option value="green">Green</option>
													<option value="url('images/white_baby.jpg')">White Baby</option>
													<option value="url('images/green_baby.jpg')">Green Baby</option>
													<option value="yellow">Yellow</option>
													<option value="url('images/yellow_baby.jpg')">Yellow Baby</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<fieldset style="text-align:center;border:1px solid silver;">
										<legend style="padding:0px 10px 0px 10px;">Preview</legend>
										<table class="chart" style="margin:15px;">
											<tr>
												<td>
													<span class="stamp" id="backgroundPreview" style="background:white;"></span>
												</td>
											</tr>
											<tr>
												<td style="vertical-align:top;overflow:hidden;line-height:22px;width:40px;text-align:center;">
													<span class="stamp">
														<span id="datePreview" style="display:block;height:22px;line-height:22px;"></span>
														<span id="line1Preview" style="display:block;height:22px;line-height:22px;"></span>
														<span id="line2Preview" style="display:block;height:22px;line-height:22px;"></span>
														<span id="intercoursePreview" class="i" style="display:none;">I</span>
													</span>
												</td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:center;">
									<br />
									<div style="display:block;margin:auto;border-top:1px solid silver;padding-top:10px;">
										<input type="submit" value="Save" class="button" id="save"/>
										<input type="reset" value="Cancel" class="button" id="cancel" />
									</div>
								</td>
							</tr>
						</table>
					</form>
				
				</div>
			</div>
		</div>
		
	</body>
</html>