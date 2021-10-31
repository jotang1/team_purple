<?php
session_start();

	include("connection.php");
	include("functions.php");

  // Pull data from "menu" Table in database
	$sql = 'SELECT * FROM LYALPurple.Products';

	$result = mysqli_query($con, $sql);

	$menu= mysqli_fetch_all($result, MYSQLI_ASSOC);

	//mysqli_free_result($result);

	mysqli_close($con);
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
		border:1ps solid #ccc;
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
		text-aligh:center;
		font-family: Arial;
		font-weight: bold;
	}

	</style>

</head>

<body>
	<!-- Add Header -->
  <?php include("header.html");?>

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
			<?php foreach($menu as $menu1){ ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h2 style="color:#cc0000"> <?php echo htmlspecialchars($menu1['product_name']); ?></h2>
							<h4>Price ($): <?php echo htmlspecialchars($menu1['price_sm']); ?> (S), <?php echo htmlspecialchars($menu1['price_med']); ?> (M), <?php echo htmlspecialchars($menu1['price_lg']); ?> (L)</h4>
							<h4><mark><i><?php echo htmlspecialchars($menu1['selections']); ?></mark></i></h4>
							<form action="" method="POST">
						    <h4>
									Quantity: <input type="number" name="qty" min="0" step="1" max="10" autocomplete="off">
									Size: <input type="select" name="size" list="<?php echo $menu1['product_id']; ?>_sizes" size="8" autocomplete="off">
							      <datalist id="<?php echo $menu1['product_id']; ?>_sizes">
							      	<option value="<?php echo "Small"; ?>"><?php echo $menu1['price_sm']; ?></option>
											<option value="<?php echo "Medium"; ?>"><?php echo $menu1['price_med']; ?></option>
											<option value="<?php echo "Large"; ?>"><?php echo $menu1['price_lg']; ?></option>
							      </datalist>
									Selection: <input type="select" name="selection" list="<?php echo $menu1['product_id']; ?>_selections" size="16" autocomplete="off">
										<datalist id="<?php echo $menu1['product_id']; ?>_selections">
											<?php
											$selectionArray = [];
											$selectionArray = explode(", ", $menu1['selections']);
											foreach (($selectionArray) as $selection) { ?>
													<option value="<?php echo $selection; ?>"></option>
											<?php } ?>
										</datalist>
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
