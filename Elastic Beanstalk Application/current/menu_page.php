<?php
	//Connection file
	include("connection.php");

  // Pull data from "menu" Table in database
	$sql = 'SELECT * FROM LYALPurple.Products';

	$result = mysqli_query($con, $sql);

	$productList = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$creamer_options = ["Skim", "2%", "Whole", "Soy", "Almond"];

	mysqli_free_result($result);

	mysqli_close($con);

	//Initialize shopping Cart
	include("cart.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" media="only screen and (min-width: 768px) and (max-width: 1024px)">
	<link rel="stylesheet" href="style.css">

	<title>Menu</title>

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

	.gallery{
		margin:5px;
		border:1px solid #ccc;
		float:left;
		width:170px;
		height:170px;
	}

	.gallery img{
		width:168px;
		height:168px;
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



		<div class="container">
			<div class="gallery">
				<img src ="http://3.82.206.3/coffee-H.jpeg" >
					<div class = "desc">Coffee(Hot)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/coffee-C.jpg" >
					<div class = "desc"> Coffee(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/cappuccino.jpeg" >
					<div class = "desc">Cappuccino(Hot)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/cappuccino-C.jpg" >
					<div class = "desc">Cappuccino(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/latte.jpeg" >
					<div class = "desc">Latte(Hot)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/latte-C.jpg" >
					<div class = "desc">Latte(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/espresso.jpeg">
					<div class = "desc">Espresso</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/scone.jpeg" >
					<div class = "desc">Scone</div>
			</div>

			<div class="gallery">
				<img src ="http://3.82.206.3/biscotti.jpeg" >
					<div class = "desc">Biscotti</div>
			</div>
		</div>

		<h1 class="center grey-text">Menu</h1>
			<div class="row">
			<?php
			//Populate menu items from database
			foreach($productList as $product){ ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h2 style="color:#cc0000"> <?php echo htmlspecialchars($product['product_name']); ?></h2>
							<h4>Price ($): <?php echo htmlspecialchars($product['price_sm']); ?> (S), <?php echo htmlspecialchars($product['price_med']); ?> (M), <?php echo htmlspecialchars($product['price_lg']); ?> (L)</h4>
							<h4><mark><i><?php echo htmlspecialchars($product['description']); ?></mark></i></h4>
							<form action="" method="POST">
						    <h4>
									<!-- Form for "Add to Cart" button - Retrieves item properties from database for input options -->
									<input type="hidden" name="itemId" value="<?php echo $product['product_id']; ?>">
									<input type="hidden" name="itemName" value="<?php echo $product['product_name']; ?>">
									<input type="hidden" name="price_sm" value="<?php echo $product['price_sm']; ?>">
									<input type="hidden" name="price_med" value="<?php echo $product['price_med']; ?>">
									<input type="hidden" name="price_lg" value="<?php echo $product['price_lg']; ?>">
									Quantity: <input type="number" name="qty" min="0" step="1" max="10" autocomplete="off">
									<!-- Populate size option list, display related price from database value -->
									Size: <input type="select" name="size" list="<?php echo $product['product_id']; ?>_sizes" size="8" autocomplete="off">
							      <datalist id="<?php echo $product['product_id']; ?>_sizes">
							      	<option value="<?php echo "Small"; ?>"><?php echo $product['price_sm']; ?></option>
											<option value="<?php echo "Medium"; ?>"><?php echo $product['price_med']; ?></option>
											<option value="<?php echo "Large"; ?>"><?php echo $product['price_lg']; ?></option>
							      </datalist>

									<?php
										if($product['product_type'] == 'Drink'){ ?>
											<!-- Populate creamer options list from database
													 Splits the string of selections using ", " delimiter, adds each selection to an array, then creates options for each array value -->
											Creamer Option: <input type="select" name="creamer_option" list="<?php echo $product['product_id']; ?>_creamers" size="16" autocomplete="off">
												<datalist id="<?php echo $product['product_id']; ?>_creamers">
													<?php
													foreach (($creamer_options) as $creamer) { ?>
															<option value="<?php echo $creamer; ?>"></option>
													<?php } }?>
												</datalist>
									<!-- Submit button -->
									<input type="submit" value="Add to Cart"><br><br>
								</h4>
						  </form>
							<h4>----------------------------------------------</h4>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
</body>

</html>
