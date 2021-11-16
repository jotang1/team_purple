<?php
	session_start();

	include("connection.php");

	if ($_SESSION["locked"] !== null) {
		$difference = time() - $_SESSION["locked"];

		if ($difference > 0) {
			unset($_SESSION["locked"]);
			unset($_SESSION["login_attempts"]);
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!is_numeric($user_name) && !isset($_POST['Logout']))
		{
			$query = $con->prepare("SELECT * FROM LYALPurple.Employees where username=? limit 1");
			$query->bind_param("s", $user_name);
			$query->execute();
			$result = $query->get_result();

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] == $password)
					{
						$_SESSION['user_id'] = $user_data['id'];
						setcookie('username', $user_data['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
						header("Location: index.php");
						die;
					}
					else
					{
						$_SESSION["login_attempts"]+=1;
						echo '<p style="color: red;">Incorrect Password</p>';
						print_r("Login_attempts:");
						print_r($_SESSION["login_attempts"]);
					}
				}
				else
				{
					$_SESSION["login_attempts"]+=1;
					echo '<p style="color: red;">Incorrect Username</p>';
					print_r("Login_attempts:");
					print_r($_SESSION["login_attempts"]);
				}
			}
		}
		else
		{
			$_SESSION["login_attempts"]+=1;
			echo '<p style="color: red;">Incorrect Username or Password</p>';
			print_r("Login_attempts:");
			print_r($_SESSION["login_attempts"]);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
	*{
		box-sizng:border-box;
	}

	body{
		margin: 0;
		background:skyblue;
		text-align: center;
	}
	</style>
</head>

<body>

	<style type="text/css">
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #ass;
		width: 100%;
	}

	#button{
		padding: 10px;
		width: 100px;
		color: white;
		background-color: blue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<h1>Welcome to Love You A Latte! </h1><br>

	<div id="box">
		<form method="post">
			<div style="font-size: 30px; margin: 10 px; color: white">Login</div>

			<div style = "font-size: 20px; margin: 10 px; color: white">Username</div>
			<input id="text" type="text" name="user_name"><br><br>

			<div style = "font-size: 20px; margin: 10 px; color: white">Password</div>
			<input id="text" type="password" name="password"><br><br>

			<?php
				if ($_SESSION["login_attempts"] > 2)
				{
					$_SESSION["locked"] = time();
					echo '<p style="color: red;">Please wait for 15 minutes</p>';
					unset($_SESSION);
				}
				else
				{
			?>
				<input id ="button" type="submit" value ="Login"><br><br>
				<?php } ?>
		</form>
	</div>
</body>
</html>
