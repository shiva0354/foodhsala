<?php

namespace Models;

use Database\Db;

class Order
{
    public $id, $user_id, $restaurant_id, $status, $total_amount, $name, $email, $mobile, $address, $city, $pin, $created_at, $updated_at;

    public function __construct(int $id, int $user_id, int $restaurant_id, string $status, int $total_amount, string $name, string $email, string $mobile, string $address, string $city, string $pin, string $created_at, string $updated_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->restaurant_id = $restaurant_id;
        $this->status =  $status;
        $this->total_amount = $total_amount;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->address = $address;
        $this->city =  $city;
        $this->pin =  $pin;
        $this->created_at =  $created_at;
        $this->updated_at = $updated_at;
    }

    public static function getOrderByRestaurantId(int $id)
    {
        $list = null;
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT `id`, `user_id`,`restaurant_id`,`status`,`total_amount`,`name`, `email`,`mobile`,`address`,`city`,`pin`,`created_at`,`updated_at` FROM `orders` WHERE restaurant_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = mysqli_fetch_assoc($result)) {
            $order = new Order($row['id'], $row['user_id'], $row['restaurant_id'], $row['status'], $row['total_amount'], $row['name'], $row['email'], $row['mobile'], $row['address'], $row['city'], $row['pin'], $row['created_at'], $row['updated_at']);
            $list[] = $order;
        }
        return $list;
    }

    public static function findById(int $id)
    {
        $order = null;
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT `id`, `user_id`,`restaurant_id`,`status`,`total_amount`,`name`, `email`,`mobile`,`address`,`city`,`pin`,`created_at`,`updated_at` FROM `orders` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = mysqli_fetch_assoc($result)) {
            $order = new Order($row['id'], $row['user_id'], $row['restaurant_id'], $row['status'], $row['total_amount'], $row['name'], $row['email'], $row['mobile'], $row['address'], $row['city'], $row['pin'], $row['created_at'], $row['updated_at']);
        }
        return $order;
    }

    public function getOrderDetail()
    {
        $id = $this->id;
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT items.id, items.name,items.restaurant_id,items.price,items.type,items.image,items.description FROM items JOIN order_items ON order_items.item_id = items.id WHERE order_items.order_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function store(int $user_id, int $restaurant_id, string $status, int $total_amount, string $name, string $email, string $mobile, string $address, string $city, string $pin)
    {
        $conn = Db::getConnection();
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO `orders`(`user_id`,`restaurant_id`,`status`,`total_amount`,`name`, `email`,`mobile`,`address`,`city`,`pin`,`created_at`,`updated_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iisissssssss", $user_id, $restaurant_id, $status, $total_amount, $name, $email, $mobile, $address, $city, $pin, $created_at, $updated_at);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        return $order_id;
    }
}
