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
  <?php include("header.php");?>

	<!-- ADD PRODUCTS -->
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
		// ADD PRODUCTS METHOD
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
	   }
	  }
	?>

	<!-- ADD PRODUCTS -->
	<div>
		<h3>*** Update Product in Database ***</h3>
		<!-- SEARCH PRODUCTS -->
		<?php
		$prod_query = "SELECT * FROM LYALPurple.Products";
		$prod_result = mysqli_query($conn, $prod_query);
		?>

		<form action="" method="POST">
	    <input type="text" name="item_search" list="items" size="36" autocomplete="off">
	      <datalist id="items">
	        <?php while($row = mysqli_fetch_array($prod_result)) { ?>
	            <option><?php echo $row['product_name']; ?></option>
	        <?php } ?>
	      </datalist>
	    <input type="submit" value="Search Product"><br><br>
	  </form>

		<?php
		$selected['product_name'] = "";
		$selected['product_id'] = "";
		$selected['price_sm'] = "";
		$selected['price_med'] = "";
		$selected['price_lg'] = "";
		$selected['description'] = "";
	  if(isset($_POST['item_search']))
	  {
	    $searched = $_POST['item_search'];
			$select_query = "SELECT * FROM LYALPurple.Products where product_name='$searched'";
			$result = mysqli_query($conn, $select_query);
			$selected = mysqli_fetch_array($result);
	  }
	  ?>

		<!-- UPDATE PRODUCT -->
		<form action="" method="POST">
			<p>Item Name:</p>
			<input type="text" name="update_name" size="36" autocomplete="off" value="<?php echo $selected['product_name']; ?>">
			<p>Product ID:</p>
			<input type="number" name="update_id" size="36" autocomplete="off" readonly value="<?php echo $selected['product_id']; ?>">
			<p>Item Price Small (int or decimal):</p>
			<input type="number" step=0.01 name="update_price_sm" size="36" autocomplete="off" value="<?php echo $selected['price_sm']; ?>">
			<p>Item Price Medium (int or decimal):</p>
			<input type="number" step=0.01 name="update_price_med" size="36" autocomplete="off" value="<?php echo $selected['price_med']; ?>">
			<p>Item Price Large (int or decimal):</p>
			<input type="number" step=0.01 name="update_price_lg" size="36" autocomplete="off" value="<?php echo $selected['price_lg']; ?>">
			<p>Item Description:</p>
			<input type="text" name="update_description" size="36" autocomplete="off" value="<?php echo $selected['description']; ?>"><br><br>
			<input type="submit" value="Update Product"><br><br>
		</form>

		<?php
		$update_id = "";
		$update_name = "";
		$update_price_sm = "";
		$update_price_med = "";
		$update_price_lg = "";
		$update_description = "";

			// UPDATE PRODUCT METHOD
		  if($_SERVER['REQUEST_METHOD'] == "POST")
		  {
			 $update_id = $_POST['update_id'];
		   $update_name = $_POST['update_name'];
		   $update_price_sm = $_POST['update_price_sm'];
		   $update_price_med = $_POST['update_price_med'];
		   $update_price_lg = $_POST['update_price_lg'];
		   $update_description = $_POST['update_description'];

	    if (!empty($update_name) && !is_numeric($update_name) && !empty($update_price_sm) && !empty($update_price_med) && !empty($update_price_lg))
		   {
		    //Update item in database by id
				$update_sql = "UPDATE LYALPurple.Products SET product_name = ?, price_sm = ?, price_med = ?, price_lg = ?, description = ? WHERE product_id = ?";
		    $update_query = $conn->prepare($update_sql);
		    $update_query->bind_param("sdddsd", $update_name, $update_price_sm, $update_price_med, $update_price_lg, $update_description, $update_id);
		    $update_query->execute();
		   }
		  }
		?>
	</div>
</body>

</html>
