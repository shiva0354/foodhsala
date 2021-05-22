<?php

use Controllers\AuthController;

require './Controllers/AuthController.php';
spl_autoload_register();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    AuthController::logout();
    header('Location:./');
}
