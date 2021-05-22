<?php

namespace Controllers;

use Controllers\AuthController;
use Models\Order;

class RestaurantOrderController
{
    public function __construct()
    {
        spl_autoload_register();
    }

    public  static function index()
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $restaurant = unserialize($_SESSION['restaurant']);

        $orders = Order::getOrderByRestaurantId($restaurant->id);
        return $orders;
    }

    public static function orderDetail(int $id)
    {
        if (!AuthController::authCheck('restaurant')) {
            $_SESSION['error'] = ['Login First'];
            header("Location:./login.php");
            exit();
        }

        $order = Order::findById($id);

        if (!$order) {
            $_SESSION['error'] = ['Not Found'];
            header('Location:./restaurant.php');
            exit();
        }

        // print_r($order);
        // exit();

        $order_detail = $order->getOrderDetail();
        return ['order' => $order, 'order_detail' => $order_detail];
    }
}
