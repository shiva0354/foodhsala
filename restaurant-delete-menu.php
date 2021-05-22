<?php

require './restaurant-session.php';

use Controllers\ItemController;

require './Database/Db.php';
require './Models/Item.php';
require './Models/Restaurant.php';
require './Controllers/ItemController.php';
require './Controllers/AuthController.php';
require './Controllers/BackController.php';
spl_autoload_register();
$id = $_POST['item-id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ItemController::destroy($id);
}
