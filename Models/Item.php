<?php

namespace Models;

use Database\Db;

class Item
{
    public $id, $name, $price, $image, $description, $type, $restaurant_id, $created_at, $updated_at;

    public function __construct($id, $name, $price, $image, $description, $type, $restaurant_id, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->type = $type;
        $this->restaurant_id = $restaurant_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function create(string $name, int $price, string $image, string $description, string $type, int $restaurant_id)
    {
        // echo $restaurant_id;
        // exit();
        $conn = Db::getConnection();

        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stmt       = $conn->prepare("INSERT INTO `items`(`name`, `price`,`image`,`description`,`type`,`restaurant_id`,`created_at`,`updated_at`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssiss", $name, $price, $image, $description, $type, $restaurant_id, $created_at, $updated_at);
        $stmt->execute();
    }

    public function update(string $name, string $price, string $image, string $description, string $type, int $restaurant_id)
    {
        $updated_at = date('Y-m-d H:i:s');
        $conn = Db::getConnection();
        $stmt = $conn->prepare("UPDATE `items` SET `name`=?,`price`=?, `image`=?,`description`=?, `type`=?, `restaurant_id`=?,`updated_at`=? WHERE id=?");
        $stmt->bind_param("sisssisi", $name, $price, $image, $description, $type, $restaurant_id, $updated_at, $this->id);
        $stmt->execute();
    }

    public static function findById(int $id)
    {
        $item = null;
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT `id`,`name`, `price`,`image`,`description`,`type`,`restaurant_id`,`created_at`,`updated_at` FROM `items` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = mysqli_fetch_assoc($result)) {
            $item = new Item($row['id'], $row['name'], $row['price'], $row['image'], $row['description'], $row['type'], $row['restaurant_id'], $row['created_at'], $row['updated_at']);
        }
        return $item;
    }

    public function delete($id)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("DELETE FROM `items` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public static function all()
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT items.id, items.name, items.price, items.image, items.description, items.type, items.restaurant_id, restaurants.name as restaurant_name, items.created_at, items.updated_at FROM `items` JOIN `restaurants` ON items.restaurant_id = restaurants.id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function getByName(string $name)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT items.id, items.name, items.price, items.image, items.description, items.type, items.restaurant_id, restaurants.name as restaurant_name, items.created_at, items.updated_at FROM `items` JOIN `restaurants` ON items.restaurant_id = restaurants.id WHERE items.name LIKE CONCAT( '%',?,'%')");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function getByRestaurantId(int $id)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT `id`,`name`, `price`,`image`,`description`,`type`,`restaurant_id`,`created_at`,`updated_at` FROM `items` WHERE `restaurant_id`=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = mysqli_fetch_assoc($result)) {
            $item = new Item($row['id'], $row['name'], $row['price'], $row['image'], $row['description'], $row['type'], $row['restaurant_id'], $row['created_at'], $row['updated_at']);
            $list[] = $item;
        }
        return $list;
    }

    public static function findByIdWithRestaurant(int $id)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT items.id, items.name, items.price, items.image, items.description, items.type, items.restaurant_id, restaurants.name as restaurant_name, items.created_at, items.updated_at FROM `items` JOIN `restaurants` ON items.restaurant_id = restaurants.id WHERE items.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
