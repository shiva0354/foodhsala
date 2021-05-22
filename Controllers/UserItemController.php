<?php

namespace Controllers;

use Controllers\BackController;
use Models\Item;
use Models\Restaurant;

class UserItemController
{
    public function __construct()
    {
        spl_autoload_register();
    }

    public static function restaurantMenu($id)
    {
        $restaurant = Restaurant::findById($id);

        if (!$restaurant) {
            BackController::goBack(['Restaurant Not Found.']);
        }

        $items = Item::getByRestaurantId($id);
        return $items;
    }

    public function dishesByName($query)
    {
        $items = Item::getByName($query);
        return $items;
    }
}
