<!DOCTYPE html>
<html>
<head>
  <title>Database Test</title>
</head>

<body>

  <h3>*** Database Connection Test ***</h3>

  <p>
    Database Connection was...
		<?php
		$servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
		$username = "purpleteam";
		$password = "purpleteam";
		$db_name = "LYALPurple";

		//Create connection
		$conn = new mysqli($servername, $username, $password, $db_name);

		//Check connection
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
    <br><button name="retrieveTime" class="retrieveTime">Retrieve Date/Time</button>
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

  <h3>*** Add Product to Database ***</h3>
  <form action="" method="POST">
    <p>Item Name:</p>
    <input type="text" name="product_name" size="36" autocomplete="off">
    <p>Item Price Small (int or decimal):</p>
    <input type="number" step=0.01 name="price_sm" size="36" autocomplete="off">
    <p>Item Price Medium (int or decimal):</p>
    <input type="number" step=0.01 name="price_med" size="36" autocomplete="off">
    <p>Item Price Large (int or decimal):</p>
    <input type="number" step=0.01 name="price_lg" size="36" autocomplete="off"><br><br>
    <input type="submit" value="Add Product"><br><br>
  </form>


  <?php
  $prod_query = "SELECT product_id, product_name FROM LYALPurple.Products";
  $prod_result = mysqli_query($conn, $prod_query) or die("Error " . mysqli_error($conn));
  ?>

  <h3>*** Remove Product from Database ***</h3>
  <p>Select from product_name/product_id:</p>
  <form action="" method="POST">
    <input type="text" name="item_rem" list="items" size="36" autocomplete="off">
      <datalist id="items">
        <?php while($row = mysqli_fetch_array($prod_result)) { ?>
            <option value="<?php echo $row['product_name']; ?>"><?php echo $row['product_id']; ?></option>
        <?php } ?>
      </datalist><br><br>
    <input type="submit" value="Remove Product"><br><br>
  </form>

  <form action="index.php" style="margin-top: 50px;">
    <input type="submit" value="Home" />
  </form>

  <?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      //Something was posted
      $product_name = $_POST['product_name'];
      $price_sm = $_POST['price_sm'];
      $price_med = $_POST['price_med'];
      $price_lg = $_POST['price_lg'];
      $item_rem = $_POST['item_rem'];

      if (!empty($product_name) && !is_numeric($product_name) && !empty($price_sm) && !empty($price_med) && !empty($price_lg))
      {
        //Add item to database
        $add_query = $conn->prepare("INSERT INTO LYALPurple.Products (product_name, price_sm, price_med, price_lg) VALUES (?, ?, ?, ?)");
        $add_query->bind_param("sddd", $product_name, $price_sm, $price_med, $price_lg);
        $add_query->execute();
        die;
      }

      if (!empty($item_rem)){
        //Remove item from database
        $rem_query = $conn->prepare("DELETE FROM LYALPurple.Products WHERE product_name = ?");
        $rem_query->bind_param("s", $item_rem);
        $rem_query->execute();
        die;
      }
    }
  ?>

</body>
</html>
