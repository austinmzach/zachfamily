<?php
	$usingDatabase = true;
	
	if ($usingDatabase) {
		require_once("BlogDao.php");
		$dao = new BlogDao();
		
		if ($_POST) {
			$dao->insert($_POST);
		}
	}
	
	require_once("header.php");
?>

<div id="right-side">
	<div id="archive">
		<span class="header">Archive</span>
		<?php $dao->printArchive(); ?>
		<br />
	</div>
	
	<div id="tag-cloud">
		<span class="header">Tags</span>
		<?php $dao->printTagCloud(); ?>
		<br /><br />
	</div>
</div>

<?php 
	if ($usingDatabase) {
		if ($_GET['tag']) {
			$dao->getBlogPostsByTag($_GET['tag']);
		} elseif ($_GET['month']) {
			$dao->getBlogPostsByMonth($_GET['month']);
		} else {
			$dao->getBlogPosts();
		}
	} else {
		echo "<span class='alert'>Database is not config'ed!</span>";
	}
?>
					
<?php require_once("footer.php"); ?>