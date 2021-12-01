<?php
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if (!ctype_lower($user_name))
		{
			echo '<p style="color: red; background-color: white; font-size: 1.5em;">
			Username: lowercase letter only and no space </p>';
		}

		if (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z\d])[0-9A-Za-z!@#$%^&*_~]{1,}$/", $password))
		{
			echo '<p style="color: red; background-color: white; font-size: 1.5em;">
			Password: At least one lowercase, one uppercase, one number, and one special character </p>';
		}

		if (ctype_lower($user_name) && preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z\d])[0-9A-Za-z!@#$%^&*_~]{1,}$/", $password)==1)
		{
				$register_query = $con->prepare("INSERT INTO LYALPurple.Users (username, password) VALUES (?, ?)");
		    $register_query->bind_param("ss", $user_name, $password);
		    $register_query->execute();

				header("Location: user_login.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>

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

	<h1> Welcome to Love You A Latte! </h1><br>
	<div id="box">
		<form method="post">
			<div style="font-size: 30px; margin: 10 px; color: white">Register User</div><br>

			<div style = "font-size: 20px; margin: 10 px; color: white">Username</div>
			<input id="text" type="text" name="user_name"><br><br>

			<div style = "font-size: 20px; margin: 10 px; color: white">Password</div>
			<input id="text" type="password" name="password"><br><br>

			<input id ="button" type="submit" value="Register"><br><br>
		</form>
		<a href="index.php" id="button" name="home" style="text-decoration: none;">Home</a>
	</div>

</body>
</html>
