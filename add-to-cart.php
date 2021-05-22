<?php
session_start();

use Controllers\BackController;
use Controllers\CartController;

require './Database/Db.php';
require './Models/Item.php';
require './Models/Order.php';
require './Models/OrderItem.php';
require './Controllers/CartController.php';
require './Controllers/BackController.php';
require './Controllers/AuthController.php';
spl_autoload_register();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = test_input($_POST["item-id"]);
    CartController::addToCart($id);
    BackController::success('Item added to your cart');
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
