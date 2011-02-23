<?php
	require_once("header.php");

	if (isset($_SESSION['IsAuthorized']) && $_SESSION['IsAuthorized']) {
?>
<h2>New Blog</h2>
<form action="blog.php" method="post">
	<table style="width:850px;">
		<tr>
			<td>Title: </td>
			<td><input type="text" name="title" id="title" class="input" /></td>
		</tr>
		<tr>
			<td style="vertical-align:top;width:60px;">Text: </td>
			<td>
				<textarea name="blogBody" id="blogBody" class="input" rows="15">
				</textarea>
			</td>
		</tr>
		<tr>
			<td>Tags: </td>
			<td><input type="text" name="tags" id="tags" class="input" /></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:center;">
				<input type="submit" value="Create Blog" class="button" />
			</td>
		</tr>
	</table>
</form>
<?php } else {
	echo "<span class='alert'>You must be authorized to access this page!</span>";
} ?>
					
<?php require_once("footer.php"); ?>