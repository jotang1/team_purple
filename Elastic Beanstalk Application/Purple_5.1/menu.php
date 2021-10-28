
<!DOCTYPE html>
<html>
<head>
	<title>Love You A Latte (Team Purple 01)</title>

	<link href="style.css" rel="stylesheet" media="only screen and (min-width: 768px) and (max-width: 1024px)">
	<link rel ="stylesheet" href ="style.css">
</head>

<body>
	<!-- Add Header -->
  <?php include("header.html");?>

	<style type="text/css">

	table {
		margin: auto;
		border: 5px solid #000066;
		width: 1480px;
	}

	caption {
		font-family: verdana, sans-serif;
		font-weight: bold;
		font-size: 1.2em;
		padding-bottom: 0.5em;
	}

	td, th {
		padding: 0.5em;
		border-style: none;
		font-family: Arial, sans-serif;
	}

	.altrow {background-color: yellow}

	</style>

	<table border = "2">
	<caption>Menu</caption>
						<tr>
							<th>Name</th>
							<th>Price (L)</th>
							<th>Price (M)</th>
							<th>Price (S)</th>
							<th>Choice</th>
						</tr>
						<tr class = "altrow">
							<td><b/>Coffee</b></td>
							<td>$3.75 (L)</td>
							<td>$2.75 (M)</td>
							<td>$1.75 (S)</td>
							<td>Regular, Decaf, Iced</td>
						</tr>
						<tr>
							<td><b>Cappuccino (hot/cold)</b></td>
							<td>$4.45 (L)</td>
							<td>$3.45 (M)</td>
							<td>$2.45 (S)</td>
							<td>Regular, Vanilla, Caramel, Pumpkin spice, Mocha, Caramel mocha, Coconut, Sugar free</td>
						</tr>
						<tr class = "altrow">
							<td><b>Latte (hot/cold)</b></td>
							<td>$4.95 (L)</td>
							<td>$3.95 (M)</td>
							<td>$2.95 (S)</td>
							<td>Description: A shot of expresso with steamed milk and different flavor(s). <br>
							Choice: Regular, Vanilla, Caramel, Pumpkin spice, Mocha, Caramel mocha, Coconut, Lite, MCP, Sugar free</td>
						</tr>
						<tr>
							<td><b>Expresso</b></td>
							<td>$4.45 (Trple shot)</td>
							<td>$3.45 (Double shot)</td>
							<td>$2.45 (Single shot)</td>
							<td>Regular, House, Special</td>
						</tr>
						<tr class = "altrow">
							<td><b>Scone</b></td>
							<td>$4.45 (3)</td>
							<td>$3.45 (2)</td>
							<td>$2.45 (1)</td>
							<td>Raisin, Chocolate, Cream, Lemon, Sour Creme</td>
						</tr>
						<tr>
							<td><b>Biscotti</b></td>
							<td>$4.95 (3)</td>
							<td>$3.55 (2)</td>
							<td>$1.85 (1)</td>
							<td>Almond, Gluten free, Nutella, Pumpkin banana, Pumpkin spice</td>
						</tr>
						<a class="brand-text" href="order.php">ORDER</a>
	</table>
</body>

</html>
