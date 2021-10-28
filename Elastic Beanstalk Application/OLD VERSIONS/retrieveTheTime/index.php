<!DOCTYPE html>
<html>
<head>
  <title>Log/Retrieve The Time (Purple 01)</title>
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
    <button name="logTime" class="logTime">Store Date/Time</button>
  </form>

  <?php
  if(isset($_POST['logTime']))
  {
    $date = date('Y-m-d H:i:s');
    echo "Time the button was clicked: " . $date . "<br>";

    $log = $conn->prepare("INSERT INTO LYALPurple.TimeStamps (timeAccessed) VALUES (?)");
    $log->bind_param("s", $date);
    $log->execute();
  }
  ?>

  <form action="" method="POST">
    <button name="retrieveTime" class="retrieveTime">Retrieve Date/Time</button>
  </form>

  <?php
  if(isset($_POST['retrieveTime']))
  {
    $retrieve = "SELECT max(timeAccessed) FROM LYALPurple.TimeStamps";
    $result = $conn->query($retrieve);
    $row = mysqli_fetch_array($result);

    echo "Last time stored in database: " . $row[0] . "<br>";
  }
  ?>



</body>
</html>
