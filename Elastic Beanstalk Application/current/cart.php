<?php
// Clear shoppingCart cookie
//setcookie("shoppingCart", "", time() - 3600);

//If shoppingCart cookie does not exist
if (!isset($_COOKIE['shoppingCart'])) {
  //Create it
  $cartItems = [];
  setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
  //Retrieve cookie for list of items in cart (Array)
  $cartItems = json_decode($_COOKIE[shoppingCart], true);
}

//Class for a new shoppingCart item
class cartItem {
  public $itemID;
  public $itemName;
  public $quantity;
  public $itemSize;
  public $itemOption;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //Gather item values from "Add to Cart" post
  $itemID = $_POST['itemId'];
  $itemName = $_POST['itemName'];
  $quantity = $_POST['qty'];
  $itemSize = $_POST['size'];
  $itemOption = $_POST['selection'];

  if (!empty ($itemID) && !empty($itemName) && !empty($quantity) && !empty($itemSize) && !empty($itemOption)) {
    //Add item shopping cart if all fields are filled
    $newItem = new cartItem();
    $newItem->itemId = $itemID;
    $newItem->itemName = $itemName;
    $newItem->quantity = $quantity;
    $newItem->itemSize = $itemSize;
    $newItem->itemOption = $itemOption;

    //Add new item to the shopping cart
    array_push($cartItems, $newItem);
    //Update shoppingCart cookie with new item added
    setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
    //Refresh the page
    header("Refresh:0");
  }
}

/* // SAMPLE ITEM FOR TESTING -- Creates a new shoppingCart item without user input
$testItem = new cartItem();
$testItem->itemId = 200;
$testItem->itemName = "TEST ITEM";
$testItem->quantity = 1;
$testItem->itemSize = "LARGE";
$testItem->itemOption = "NONE";
array_push($cartItems, $testItem);
setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
*/
?>
