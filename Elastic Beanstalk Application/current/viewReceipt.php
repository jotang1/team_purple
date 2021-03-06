<?php
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
	th, td {
	  padding: 32px;
	}
	</style>

</head>

<body>
	<!-- Add Header -->
  <?php include("header.php");
  //Get shopping cart array
  $shoppingCart = json_decode($_COOKIE['lastCart'], true);

	//Get item price from size
	function getItemPrice(array $item, String $size){
		$price = 0;
		switch ($size){
			case "Small":
				$price=$item['price_sm'];
				break;
			case "Medium":
				$price=$item['price_med'];
				break;
			case "Large":
				$price=$item['price_lg'];
				break;
		}
		return $price;
	}

	$runningTotal = 0;
	//Populate menu items from shopping cart ?>
	<h2>Receipt</h2>
	<p>
		<?php
		if (isset($_COOKIE['orderTotal']) && ($_COOKIE['orderTotal'] != 0)){
			echo "Order placed. Total is: $" . number_format($_COOKIE['orderTotal'],2) . "<br>";
			//If user cookie exists (user is logged in)
			if (isset($_COOKIE['username'])) {
				echo "User: " . $_COOKIE['username'];
			} else {
				echo "User: " . "Guest";
			}
		}
		?>
		<table style="margin-left: auto; margin-right: auto;">
			<tr>
				<th>Product Name</th>
				<th>Size</th>
				<th>Price</th>
				<th>Creamer</th>
				<th>Quantity</th>
				<th>Subtotal</th>
				<th>GRAND TOTAL</th>
			</tr>
	<?php if ($shoppingCart) { foreach($shoppingCart as $item){
		$itemPrice = getItemPrice($item, $item['itemSize']);
		$subtotal = $item['quantity'] * $itemPrice;
	?>
			<tr>
				<td><?php echo $item['itemName']; ?></td>
				<td><?php echo $item['itemSize']; ?></td>
				<td><?php echo "$" . number_format($itemPrice, 2); ?></td>
				<td><?php echo $item['creamer_option']; ?></td>
				<td><?php echo $item['quantity']; ?></td>
				<td><?php echo "$" . number_format($subtotal, 2); ?></td>
				<td><?php
					//Display item reference in shopping cart array
					//echo array_search($item, $cartItems);
				?></td>
				<?php $runningTotal += $subtotal ?>
			</tr>
		<?php } }?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo "$" . number_format($runningTotal, 2); ?></td>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>
				</td>
			</table>
		</p>
</body>

</html>
