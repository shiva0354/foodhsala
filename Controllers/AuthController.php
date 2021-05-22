<?php

namespace Controllers;

use Models\User;
use Models\Restaurant;
use Controllers\BackController;

class AuthController
{
    public static function userLogin($mobile, $password)
    {
        if (AuthController::authCheck('user')) {
            header("Location:./");
            exit();
        }

        $user = User::findByMobile($mobile);
        if (!$user) {
            BackController::goBack(["No account associated with this mobile"]);
        }

        if (!password_verify($password, $user->password)) {
            BackController::goBack(["Invalid Mobile or Password"]);
        }
        session_start();
        $_SESSION['user'] = serialize($user);
        header("Location:./");
        exit();
    }

    public static function restaurantLogin($mobile, $password)
    {
        if (AuthController::authCheck('restaurant')) {
            header("Location:./");
            exit();
        }

        $restaurant = Restaurant::findByMobile($mobile);
        if (!$restaurant) {
            BackController::goBack(["No account associated with this mobile"]);
        }

        if (!password_verify($password, $restaurant->password)) {
            BackController::goBack(["Invalid Mobile or Password"]);
        }
        session_start();
        $_SESSION['restaurant'] = serialize($restaurant);
        header("Location:./restaurant.php");
        exit();
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ./');
    }

    public static function authCheck(string $type)
    {
        if (isset($_SESSION[$type])) {
            return true;
        }

        return false;
    }
}
