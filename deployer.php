<?php
	if ($_POST) {
		
		$to = "austinmzach@gmail.com";
		$subject = "Deployer kicked off";
		$message = "Deploying the following commit: " . implode(",", $_POST);
		$from = "austinmzach@gmail.com";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers) or die("error!");
		
		$hostname = 'zachfamily.db.6874509.hostedresource.com';
		$username = 'zachfamily';
		$password = 'August7';
		$dbname = 'zachfamily';
		
		mysql_connect($hostname, $username, $password) or die("Error: " . mysql_error());
		mysql_select_db($dbname);
		
		$json = json_decode($_POST);
		foreach ($json->{'commits'} as $commit) {
			$query = "insert into json_test(json_data) values('" . implode(",", $commit) . "')";
			mysql_query($query) or die("what and ID10T");
		}
	} else { ?>
		<html>
			<head>
				<title>testing deploy</title>
			</head>
			<body>
				<form action="deployer.php" method="post">
					<input type="hidden" name="deploying" value="yes" />
					<input type="hidden" name="choking" value="no" />
					<input type="submit" value="deploy" />
				</form>
				<?php
				 
					$jsonJunk = '{
					  "before": "5aef35982fb2d34e9d9d4502f6ede1072793222d",
					  "repository": {
					    "url": "http://github.com/defunkt/github",
					    "name": "github",
					    "description": "Youre lookin at it.",
					    "watchers": 5,
					    "forks": 2,
					    "private": 1,
					    "owner": {
					      "email": "chris@ozmm.org",
					      "name": "defunkt"
					    }
					  },
					  "commits": [
					    {
					      "id": "41a212ee83ca127e3c8cf465891ab7216a705f59",
					      "url": "http://github.com/defunkt/github/commit/41a212ee83ca127e3c8cf465891ab7216a705f59",
					      "author": {
					        "email": "chris@ozmm.org",
					        "name": "Chris Wanstrath"
					      },
					      "message": "okay i give in",
					      "timestamp": "2008-02-15T14:57:17-08:00",
					      "added": ["filepath.rb"],"modified":["deployer.php"]
					    },
					    {
					      "id": "de8251ff97ee194a289832576287d6f8ad74e3d0",
					      "url": "http://github.com/defunkt/github/commit/de8251ff97ee194a289832576287d6f8ad74e3d0",
					      "author": {
					        "email": "chris@ozmm.org",
					        "name": "Chris Wanstrath"
					      },
					      "message": "update pricing a tad",
					      "timestamp": "2008-02-15T14:36:34-08:00"
					    }
					  ],
					  "after": "de8251ff97ee194a289832576287d6f8ad74e3d0",
					  "ref": "refs/heads/master"
					}';
				
					$json = json_decode($jsonJunk, true);
					foreach ($json['commits'] as $commit) {
						echo $commit['id'] . "<br />";
						print_r($commit['modified']);
						echo "<br />";
						echo "<br />";
						print_r($commit['added']); 
					}
				?>
			</body>
		</html>
	<?php }
?>