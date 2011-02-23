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
	    
	    $query = "select blog_id from blog_posts where title = '" . $post['title'] . "'";
	    $row = mysql_fetch_array(mysql_query($query)) or die ("Error retrieving blog id: " . mysql_error());
	    $blogId = $row['blog_id'];
	    
	    $tags = explode(",", $tags);
	    foreach ($tags as $tag) {
	    	$result = mysql_query("select * from tags where tag_name = '$tag'");
	    	
	    	if (mysql_num_rows($result) == 0) {
	    		$query = "insert into tags(tag_name) values ('$tag')";
	    		mysql_query($query) or die("Error inserting new tag: " . mysql_error());
	    	}
	    	
	    	$query = "select tag_id from tags where tag_name = '$tag'";
	    	$row = mysql_fetch_array(mysql_query($query)) or die ("Error retrieving tag id: " . mysql_error());
	    	$tagId = $row['tag_id'];
	    	
	    	$query = "insert into blog_tag(blog_id, tag_id) values($blogId, $tagId)";
	    	echo $query;
	    	mysql_query($query) or die("Error inserting blog_id and tag_id: " . mysql_error());
	    }
	}
	
	function getBlogPosts() {
		$query = "select blog_id, title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	function getBlogPostsByTag($tag) {
		$query = "select blog_id, title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts where tags like '%$tag%' order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	function getBlogPostsByMonth($month) {
		$query = "select blog_id, title, body, date_format(date, '%m/%d/%Y, %r') as formatted_date, tags from blog_posts where date_format(date, '%Y-%m') = '$month' order by date desc";
		
		$this->printBlogPosts(mysql_query($query));
	}
	
	private function printBlogPosts($result) {
		while ($row = mysql_fetch_array($result)) {
			echo "<div class='blogHeader'>";
			echo "<span class='blogTitle'>" . $row['title'] . "</span>";
			echo "<span class='blogDate'>" . $row['formatted_date'] . "</span></div>";
			echo "<span class='blogBody'>" . $row['body'];
			
			$query = "select tag_name from tags t inner join (select * from blog_tag) bt on t.tag_id = bt.tag_id where bt.blog_id = " . $row['blog_id'];
			$tags = mysql_query($query);
			
			echo "<span class='tags'><b>Tags: </b>";
			while ($tag = mysql_fetch_array($tags)) {
				echo "<a href='blog.php?tag=" . $tag['tag_name'] . "'>" . $tag['tag_name'] . "</a>, ";
			}
			echo "</span><br />";
		}
	}
	
	public function printTagCloud($minFontSize = 12, $maxFontSize = 30) {
		$minimumCount = $this->getMinimumTagCount();
		$maximumCount = $this->getMaximumTagCount();
		$spread = $maximumCount - $minimumCount;
	 
		$spread == 0 && $spread = 1;
		
		$query = "select t.tag_name, s.count from tags t inner join (select tag_id, count(*) as count from blog_tag group by tag_id) s on t.tag_id = s.tag_id order by tag_name";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result)) {
			$size = $minFontSize + ($row['count'] - $minimumCount) * ($maxFontSize - $minFontSize) / $spread;
			echo "<a href='blog.php?tag=" . $row['tag_name'] . "' style='font-size:" . floor($size) . "px;'>"
					. $row['tag_name'] . "(" . $row['count'] . ")</a>\n";
		}
	}
	
	private function getMinimumTagCount() {
		$minRow = mysql_fetch_array(mysql_query("select count(*) as count from blog_tag group by tag_id order by count(*)"));
		return $minRow['count'];
	}
	
	private function getMaximumTagCount() {
		$maxRow = mysql_fetch_array(mysql_query("select count(*) as count from blog_tag group by tag_id order by count(*) desc"));
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