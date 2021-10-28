<!DOCTYPE html>
<html>
<head>
	<title>Team Purple 01</title>
</head>

<body>
	<h1> *** Database Connection Test *** </h1>

	<p>
		Database Connection was...
		<?php
		$servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
		$username = "purpleteam";
		$password = "purpleteam";

		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
  		die("unsuccessful." . $conn->connect_error);
		}
		echo "successful!";
		?>
	</p>
</body>
</html>
