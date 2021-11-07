<?php
$servername = "aac5e2cw83nfin.cxeottkamtxv.us-east-1.rds.amazonaws.com";
$username = "purpleteam";
$password = "purpleteam";
$db_name = "LYALPurple";

//Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

//Check connection
if ($conn->connect_error) {
	die("unsuccessful connection" . $conn->connect_error);
}

	//Initialize shopping Cart
	include("cart.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" media="only screen and (min-width: 768px) and (max-width: 1024px)">
	<link rel="stylesheet" href="style.css">

	<title>Manage Products</title>

	<style>
	*{
		box-sizing:border-box;
	}
	body{
		margin:0;
		background:skyblue;
		text-align:center;
	}

		.container{
		max-width:1680px;
		height:240px;
		margin:auto;
		background:#f2f2f2;
		overflow:auto;
	}

	.desc{
		padding: 15px;
		text-align:center;
		font-family: Arial;
		font-weight: bold;
	}

	</style>

</head>

<body>
	<!-- Add Header -->
  <?php include("header.html");?>

		<h1 class="center grey-text">Manage Products in Database</h1>
		<div>
			<h3>*** Add Product to Database ***</h3>
		  <form action="" method="POST">
		    <p>Item Name:</p>
		    <input type="text" name="product_name" size="36" autocomplete="off">
		    <p>Item Price Small (int or decimal):</p>
		    <input type="number" step=0.01 name="price_sm" size="36" autocomplete="off">
		    <p>Item Price Medium (int or decimal):</p>
		    <input type="number" step=0.01 name="price_med" size="36" autocomplete="off">
		    <p>Item Price Large (int or decimal):</p>
		    <input type="number" step=0.01 name="price_lg" size="36" autocomplete="off">
		    <p>Item Description:</p>
		    <input type="text" name="description" size="36" autocomplete="off"><br><br>
		    <input type="submit" value="Add Product"><br><br>
		  </form>
		</div>

		<?php
	    if($_SERVER['REQUEST_METHOD'] == "POST")
	    {
	      //Something was posted
	      $product_name = $_POST['product_name'];
	      $price_sm = $_POST['price_sm'];
	      $price_med = $_POST['price_med'];
	      $price_lg = $_POST['price_lg'];
	      $description = $_POST['description'];

	      if (!empty($product_name) && !is_numeric($product_name) && !empty($price_sm) && !empty($price_med) && !empty($price_lg))
	      {
	        //Add item to database
	        $add_query = $conn->prepare("INSERT INTO LYALPurple.Products (product_name, price_sm, price_med, price_lg, description) VALUES (?, ?, ?, ?, ?)");
	        $add_query->bind_param("sddds", $product_name, $price_sm, $price_med, $price_lg, $description);
	        $add_query->execute();
	        die;
	      }
	    }
	  ?>
</body>

</html>
