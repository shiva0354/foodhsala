<?php

namespace Controllers;

use Models\User;
use Models\Restaurant;

class RegisterController
{
    public static function userRegister(string $name, string $mobile, string $email, string $password, string $preferance)
    {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        session_start();

        $user = User::findByMobile($mobile);
        if ($user) {
            $error = ['Mobile: This mobile is already registered with us'];
            BackController::goBack($error);
            // echo '<script>alert("This mobile is already registered with us");</script>';
            // header("Location:register.php");
            // exit();
        }
        User::create($name, $mobile, $email, $hash_password, $preferance);
        echo '<script>alert("Register Success !");</script>';
        header("Location:login.php");
        exit();
    }

    public static function restaurantRegister(string $name, string $mobile, string $email, string $password)
    {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        session_start();
        $restaurant = Restaurant::findByMobile($mobile);
        if ($restaurant) {
            $error = ['Mobile: This mobile is already registered with us'];
            BackController::goBack($error);
        }
        Restaurant::create($name, $mobile, $email, $hash_password);
        echo '<script>alert("Register Success !");</script>';
        header("Location:login.php");
        exit();
    }
}
