
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
			
			<input id ="button" type="submit" value ="Login"><br><br>
			
			<a href="signup.php">Click to Signup</a><br><br>
		</form>	
	</div>
</body>
</html>