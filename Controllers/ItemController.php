<?php

namespace Controllers;

use Controllers\BackController;
use Controllers\AuthController;
use Models\Item;

class ItemController
{

    public static function index()
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $restaurant = unserialize($_SESSION['restaurant']);
        $items = Item::getByRestaurantId($restaurant->id);
        return $items;
    }


    public static function store($name, $price, $image, $description, $type)
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $restaurant = unserialize($_SESSION['restaurant']);
        Item::create($name, $price, $image, $description, $type, $restaurant->id);
        BackController::success('Item Added successfully');
    }

    public function update(int $id, string $name, int $price, string $description, string $type, string $image)
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $restaurant = unserialize($_SESSION['restaurant']);
        $item = Item::findById($id);

        if (!$item || $item->restaurant_id != $restaurant->id) {
            BackController::goBack(['Item does not belong to this Restaurant']);
        }

        $item->update($name, $price, $image, $description, $type, $restaurant->id);
    }

    public static function destroy($id)
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $restaurant = unserialize($_SESSION['restaurant']);
        $item = Item::findById($id);

        if (!$item || $item->restaurant_id != $restaurant->id) {
            BackController::goBack(['Item does not belong to this Restaurant']);
        }

        $item->delete($id);
        BackController::success('Item menu deleted.');
    }
}
