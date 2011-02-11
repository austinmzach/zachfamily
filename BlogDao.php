<?php

class BlogDao {
	private $hostname = 'zachfamily.db.6874509.hostedresource.com';
	private $username = 'zachfamily';
	private $password = 'August7';
	private $dbname = 'zachfamily';
	private $db;
	
	public function BlogDao() {
		mysql_connect($this->hostname, $this->username, $this->password) or die("Error: " . mysql_error());
		$this->db = mysql_select_db($this->dbname);
	}
	
	function insert($post) {
		$tags = str_replace(" ", "", $post['tags']);
		$query = "INSERT INTO  blog_posts (date, title, body, tags) ";
	    $query .= "VALUES (now(), '" . $post['title'] . "', '" . $post['blogBody'] . "', '" . $tags . "')";
	    
	    mysql_query($query) or die("Error inserting blog post: " . mysql_error());
	    
	    $tags = explode(",", $tags);
	    foreach ($tags as $tag) {
	    	$result = mysql_query("select * from tag_cloud where tag = '$tag'");
	    	
	    	if (mysql_num_rows($result) == 0) {
	    		$query = "insert into tag_cloud(tag, count) values ('$tag', 0)";
	    	} else {
	    		$row = mysql_fetch_array($result);
	    		$query = "update tag_cloud set count = " . ($row['count'] + 1) . " where tag = '$tag'";
	    	}
	    	mysql_query($query) or die("Error inserting tags: " . mysql_error());
	    }
	}
	
	function getBlogPosts() {
		$query = "select title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	function getBlogPostsByTag($tag) {
		$query = "select title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts where tags like '%$tag%' order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	function getBlogPostsByMonth($month) {
		$query = "select title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts where date_format(date, '%Y-%m') = '$month' order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	private function printBlogPosts($result) {
		while ($row = mysql_fetch_array($result)) {
			echo "<div class='blogHeader'>";
			echo "<span class='blogTitle'>" . $row['title'] . "</span>";
			echo "<span class='blogDate'>" . $row['formatted_date'] . "</span></div>";
			echo "<span class='blogBody'>" . $row['body'];
			echo "<span class='tags'>Tags: ";
			$tags = explode(",", $row['tags']);
			foreach ($tags as $tag) {
				echo "<a href='blog.php?tag=$tag'>$tag</a>, ";
			}
			echo "</span><br />";
		}
	}
	
	public function printTagCloud($minFontSize = 12, $maxFontSize = 30) {
		$minimumCount = $this->getMinimumTagCount();
		$maximumCount = $this->getMaximumTagCount();
		$spread = $maximumCount - $minimumCount;
	 
		$spread == 0 && $spread = 1;
		
		$query = "select * from tag_cloud order by tag";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result)) {
			$size = $minFontSize + ($row['count'] - $minimumCount) * ($maxFontSize - $minFontSize) / $spread;
			echo "<a href='blog.php?tag=" . $row['tag'] . "' style='font-size:" . floor($size) . "px;'>"
					. $row['tag'] . "(" . $row['count'] . ")</a>\n";
		}
	}
	
	private function getMinimumTagCount() {
		$minRow = mysql_fetch_array(mysql_query("select min(count) as min from tag_cloud"));
		return $minRow['min'];
	}
	
	private function getMaximumTagCount() {
		$maxRow = mysql_fetch_array(mysql_query("select max(count) as max from tag_cloud"));
		return $maxRow['max'];
	}
	
	public function printArchive() {
		$query = "select distinct DATE_FORMAT(date, '%M, %Y') as pretty_date, DATE_FORMAT(date, '%Y-%m') as ugly_date from blog_posts order by date";
		$result = mysql_query($query);
		
		echo "<ul type='square'>";
		while($row = mysql_fetch_array($result)) {
			echo "<li><a href='blog.php?month=" . $row['ugly_date'] . "'>" . $row['pretty_date'] . "</a></li>";
		}
		echo "</ul>";
	}
} 

?>