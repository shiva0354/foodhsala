<?php

use Controllers\ItemController;

require './restaurant-session.php';
require './Controllers/ItemController.php';
spl_autoload_register();
$id = $_POST['item-id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ItemController::destroy($id);
}
