<?php

session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Something was posted:
		$user_name = $_POST['user_name'];
		$item = $_POST['item'];
		$price = $_POST['price'];

		if (!empty($item) && !empty($price) && !is_numeric($item))
		{
			// Save to database;
			$order_id = random_num(20);
			$query = "insert into purchase (order_id, user_name, item, price) values ('$order_id', '$user_name', '$item', '$price')";

			mysqli_query($con, $query);

			// After accoount order, redirect the user to View Cart page:
			header("Location: output.php");
			die;
		}

		else
		{
			echo "Please enter valid information.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order</title>
	<style>
	*{
		box-sizng:border-box;
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

	<style type="text/css">
	#text{
		height:25px;
		border-radius:2px;
		padding:4px;
		border:solid thin #ass;
		width:100%;
	}

	#button{
		padding:10px;
		width:200px;
		color:white;
		background-color:blue;
		border:none;
	}

	#box{
		background-color:grey;
		margin:auto;
		width:300px;
		padding:20px;
	}

	table {
		text-align: left;
		margin: auto;
		border: 5px solid #000066;
		width: 1600px;
	}

	caption {
		font-family: verdana, sans-serif;
		font-weight: bold;
		font-size: 1.2em;
		padding-bottom: 0.5em;
	}

	td, th {
		align: left;
		padding: 0.5em;
		border-style: none;
		font-family: Arial, sans-serif;
	}

	.altrow {background-color: yellow}

	</style>
	<h1>Welcome to Love You A Latte!</h1>

		<div class="container">
			<div class="gallery">
				<img src ="coffee-H.jpeg" >
					<div class = "desc">Coffee(Hot)</div>
			</div>

			<<div class="gallery">
				<img src ="coffee-C.jpg" >
					<div class = "desc"> Coffee(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="cappuccino.jpeg" >
					<div class = "desc">Cappuccino(Hot)</div>
			</div>

			<div class="gallery">
				<img src ="cappuccino-C.jpg" >
					<div class = "desc">Cappuccino(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="latte.jpeg" >
					<div class = "desc">Latte(Hot)</div>
			</div>

			<div class="gallery">
				<img src ="latte-C.jpg" >
					<div class = "desc">Latte(Cold)</div>
			</div>

			<div class="gallery">
				<img src ="espresso.jpeg">
					<div class = "desc">Espresso</div>
			</div>

			<div class="gallery">
				<img src ="scone.jpeg" >
					<div class = "desc">Scone</div>
			</div>

			<div class="gallery">
				<img src ="biscotti.jpeg" >
					<div class = "desc">Biscotti</div>
			</div>
		</div>

		<br>

	<table border = "1">
	<caption>Menu</caption>
						<tr>
							<th>Name</th>
							<th>Price (L)</th>
							<th>Price (M)</th>
							<th>Price (S)</th>
							<th>Choice</th>
						</tr>
						<tr class = "altrow">
							<td><b/>Coffee (hot/cold)</b></td>
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
							<td><b>Espresso</b></td>
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
	</table>
	<br><br>

	<div id="box">
		<form method="post">
			<div style="font-size: 30px; margin: 10 px; color: white">Order</div><br>

			<div style = "font-size: 20px; margin: 10 px; color: white">User</div>
			<input id="user" type="text" name="user_name" size="36"><br><br>

			<div style = "font-size: 20px; margin: 10 px; color: white">Item</div>
			<input id="item" type="text" name="item" list="items" size ="36" autocomplete="off" oninput="itemSelected()"><br><br>
				<datalist id="items">
				</datalist>

				<script>
					var str=''; // variable to store the options
					var items = new Array(
						{name:"Coffee(L/Hot)", price:"3.75"},
						{name:"Latte(L/Hot)", price:"4.95"},
						{name:"Espresso M", price:"2.75"}
					);

					for (var i=0; i < items.length;++i){
						str += '<option value="'+items[i].name+'" label="'+items[i].price+'"/></option>'; // Storing options in variable
					}
					var itemsList=document.getElementById("items");
					itemsList.innerHTML = str;

				</script>

			<div style = "font-size: 20px; margin: 10 px; color: white">Price</div>
			<input id="price" type="number_format" name="price" list="prices" size ="36" autocomplete="off"><br><br>
				<script>
					function itemSelected(){
						var price = document.getElementById("price");
						var selection = document.getElementById("item").value;

						alert((selection));
						price.value = (parseFloat(selection));
					}
				</script>
			<input id ="button" type="submit" value="Add to Cart"><br><br>

			<a href="output.php"><input id ="button" type="submit" value="Click to Continously Order"></a><br><br>
		</form>

	</div>
</body>
</html>
