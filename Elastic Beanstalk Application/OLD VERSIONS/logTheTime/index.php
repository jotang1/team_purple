<!DOCTYPE html>
<html>
<head>
  <title>Hello World</title>
</head>

<body>

  <h3>Hello World!</h3>

  <h3>*** Database Connection Test ***</h3>

  <p>
    Database Connection was...
		<?php
		$servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
		$username = "purpleteam";
		$password = "purpleteam";
		$db_name = "LYALPurple";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db_name);

		// Check connection
		if ($conn->connect_error) {
  		die("unsuccessful." . $conn->connect_error);
		}
		echo "successful!";
		?>
	</p>

  <form action="" method="POST">
    <button name="click" class="click">Store Date/Time</button>
  </form>

  <?php
  if(isset($_POST['click']))
  {
    $date = date('Y-m-d H:i:s');
    echo "Time the button was clicked: " . $date . "<br>";

    $stmt = $conn->prepare("INSERT INTO LYALPurple.TimeStamps (timeAccessed) VALUES (?)");
    $stmt->bind_param("s", $date);
    $stmt->execute();
  }

  ?>



</body>
</html>
