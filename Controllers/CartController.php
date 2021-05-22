<?php

namespace Controllers;

use Models\Item;
use Models\Order;
use Models\OrderItem;
use Controllers\BackController;

class CartController
{
    public static function addToCart(int $id)
    {
        if (!AuthController::authCheck('user')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $data = Item::findByIdWithRestaurant($id);

        if ($data->num_rows == 0) {
            BackController::goBack(['Item not found']);
        }

        $item = $data->fetch_array();

        if (isset($_SESSION['restaurant_id'])) {

            if ($_SESSION['restaurant_id'] != $item['restaurant_id']) {
                unset($_SESSION['cart']);
                $_SESSION['cart'] = [$item];
                unset($_SESSION['restaurant_id']);
                $_SESSION['restaurant_id'] = $item['restaurant_id'];
            }

            array_push($_SESSION['cart'], $item);
        } else {
            $_SESSION['cart'] = [$item];
            $_SESSION['restaurant_id'] = $item['restaurant_id'];
        }
    }

    public static function placeOrder(string $name, string $mobile, string $email, string $address, string $city, string $pin)
    {
        if (!AuthController::authCheck('user')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        if (!isset($_SESSION['cart'])) {
            BackController::goBack(['Cart is empty']);
        }

        $user = unserialize($_SESSION['user']);

        $items  = $_SESSION['cart'];
        $restaurant_id = $_SESSION['restaurant_id'];
        $status = 'PENDING';
        $total_amount = 0;
        foreach ($items as $item) {
            $total_amount += $item['price'];
        }

        $order_id = Order::store($user->id, $restaurant_id, $status, $total_amount, $name, $email, $mobile, $address, $city, $pin);

        foreach ($items  as $item) {
            $item_id = $item['id'];
            $item_price = $item['price'];
            $quantity = 1;

            OrderItem::store($order_id, $item_id, $quantity, $item_price);
        }
        $_SESSION['success'] = 'Your Order Placed Successfully';
        unset($_SESSION['cart']);
        unset($_SESSION['restaurant_id']);
        header("Location:./");
        exit();
    }
}
