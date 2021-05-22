<?php

namespace Models;

use Database\Db;

class OrderItem
{

    public static function store(int $order_id, int $item_id, int $quantity, int $amount)
    {
        $conn = Db::getConnection();
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO `order_items`(`order_id`,`item_id`,`quantity`,`amount`,`created_at`,`updated_at`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("iiiiss", $order_id, $item_id, $quantity, $amount, $created_at, $updated_at);
        $stmt->execute();
        return true;
    }
}
