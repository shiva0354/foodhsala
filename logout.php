<?php

use Controllers\AuthController;

spl_autoload_register();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    AuthController::logout();
    header('Location:./');
}
