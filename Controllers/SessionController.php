<?php

namespace Controllers;

class SessionController
{
    public static function isUserLoggedIn()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location:login.php");
            exit();
        }
    }

    public static function isRestaurantLoggedIn()
    {
        session_start();

        if (!isset($_SESSION['restaurant'])) {
            header("Location:restaurant/login.php");
            exit();
        }
    }
}
