<?php
  $servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
  $username = "purpleteam";
  $password = "purpleteam";
  $db_name = "LYALPurple";

  //Create connection
  $conn = new mysqli($servername, $username, $password, $db_name);


  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $inUser = $_POST['username'];
    $inPass = $_POST['password'];

    $login = $conn->prepare("SELECT username FROM LYALPurple.Employees where username=? and password=?");
    $login->bind_param("ss", $inUser, $inPass);
    $login->execute();
    $result = $login->get_result();

    if ($result->num_rows != 0){
      // Login successful
      //echo "SUCCESS";
      setcookie('username', $inUser, time() + (86400 * 30), "/"); // 86400 = 1 day
      //Redirect to home page
      //echo '<script>window.location.href = "index.php";</script>';
      header("Location: /index.php");
    } else{
      // Login failed
      //echo "FAIL";
    }
  }

  if(isset($_POST['logout']))
  {
    setcookie("username", "", time() - 3600);
    header("Location: /index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Employee Login Form</title>
  <link rel="stylesheet" href="style2.css">
</head>

<body>
  <img src="logo.jpg" alt="">
  <form class="box" method="POST">
    <h1>Love You A Latte Employee Login</h1>

    <input type="text" name="username" placeholder="Employee Username" id="username">
    <input type="password" name="password" placeholder="Employee Password" id="password">
    <input type="submit" value="Login">
  </form>

  <form action="" method="POST">
    <br><button name="logout">Log Out</button>
  </form>
</body>
</html>
