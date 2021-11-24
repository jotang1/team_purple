<?php
$servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
$username = "purpleteam";
$password = "purpleteam";
$db_name = "LYALPurple";

//Create connection
$conn = new mysqli($servername, $username, $password, $db_name);
?>

<header id="header">
 <div class="imgHeader">
  <img src="img/Capture.PNG" alt ="logo image">
  <h1>Love You A Latte</h1>
  <?php
    //If user cookie exists (user is logged in)
    if (isset($_COOKIE['username'])) {
      echo "<p>Welcome, " . $_COOKIE['username'];
    }
  ?>
  </div>

  <div class="navHome">
    <nav>
      <ul>
        <li><a href="index.php">Home</a> </li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="faq.php">Frequently Asked Questions</a></li>
        <li><a href="menu_page.php">Menu</a></li>
        <li><a href="viewCart.php">View Cart</a></li>
        <?php
        //If user cookie exists (user is logged in)
        if (isset($_COOKIE['userId'])) {
          //If user is found in employee database (employee is logged in)
          $id = $_COOKIE['userId'];

          $checkEmployee = $conn->prepare("SELECT * FROM LYALPurple.Employees where id=?");
          $checkEmployee->bind_param("d", $id);
          $checkEmployee->execute();
          $result = $checkEmployee->get_result();

          if ($result->num_rows != 0){
            //Display Manage Products link
            echo "<li><a href='addProducts.php'>Add Products</a></li>";
            echo "<li><a href='updateProducts.php'>Update Products</a></li>";
            echo "<li><a href='register_employee.php'>Register Employee</a></li>";
          }
        }
        ?>
        <li><a href="employee_login.php">Employee Login</a></li>
        <li><a href="dbTest.php">Database Test</a></li>

      </ul>
    </nav>
  </div>


</header>
