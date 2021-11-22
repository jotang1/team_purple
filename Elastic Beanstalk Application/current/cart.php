<?php
// Clear shoppingCart cookie
//setcookie("shoppingCart", "", time() - 3600);

//If shoppingCart cookie does not exist
if (!isset($_COOKIE['shoppingCart'])) {
  if (isset($cartItems)){
    setcookie("shoppingCart", "", time() - 3600);
  }
  //Create it
  $cartItems = [];
  setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
  //header("Refresh:0");
} else {
  //Retrieve cookie for list of items in cart (Array)
  $cartItems = json_decode($_COOKIE['shoppingCart'], true);
}

//Class for a new shoppingCart item
class cartItem {
  public $itemID;
  public $itemName;
  public $quantity;
  public $itemSize;
  public $price_sm;
  public $price_med;
  public $price_lg;
  public $creamer_option;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //Gather item values from "Add to Cart" post
  $itemID = $_POST['itemId'];
  $itemName = $_POST['itemName'];
  $quantity = $_POST['qty'];
  $itemSize = $_POST['size'];
  $price_sm = $_POST['price_sm'];
  $price_med = $_POST['price_med'];
  $price_lg = $_POST['price_lg'];
  $creamer_option = $_POST['creamer_option'];
  $removeItem = $_POST['removeItem'];
  $orderTotal = $_POST['orderTotal'];

  if(!empty ($removeItem) || ($removeItem == 0)){
    unset($cartItems[$removeItem]);
    setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Refresh:0");
  }

  if(isset($_POST['submitOrder']))
  {
    setcookie("orderTotal", $orderTotal, time() + (86400 * 30), "/");
  }

  if(isset($_POST['clearCart']) || isset($_POST['submitOrder']))
  {
    $cartItems = [];
    setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Refresh:0");
  }

  if (!empty ($itemID) && !empty($itemName) && !empty($quantity) && !empty($itemSize)) {
    //Add item shopping cart if all fields are filled
    $newItem = new cartItem();
    $newItem->itemId = $itemID;
    $newItem->itemName = $itemName;
    $newItem->quantity = $quantity;
    $newItem->itemSize = $itemSize;
    $newItem->price_sm = $price_sm;
    $newItem->price_med = $price_med;
    $newItem->price_lg = $price_lg;

    if(!empty($creamer_option)){
      $newItem->creamer_option = $creamer_option;
    } else {
      $newItem->creamer_option = "n/a";
    }

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
$testItem->price_sm = 1;
$testItem->price_med = 2;
$testItem->price_lg = 3;
array_push($cartItems, $testItem);
setcookie("shoppingCart", json_encode($cartItems), time() + (86400 * 30), "/"); // 86400 = 1 day
*/
?>
