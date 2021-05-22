<?php

namespace Models;

use Database\Db;

class Restaurant
{

    public $id, $name, $mobile, $email, $password, $created_at, $updated_at;
    public function __construct($id, $name, $mobile, $email, $password, $created_at, $updated_at)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->mobile     = $mobile;
        $this->email      = $email;
        $this->password      = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function create(string $name, string $mobile, string $email, string $password)
    {
        $conn = Db::getConnection();

        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO `restaurants`(`name`, `mobile`,`email`,`password`,`created_at`,`updated_at`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $name, $mobile, $email, $password, $created_at, $updated_at);
        $stmt->execute();
    }

    public static function findById(int $id)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT `id`,`name`,`email`,`mobile`,`password`,`created_at`,`updated_at` FROM `restaurants` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $restaurant = null;
        if ($row = mysqli_fetch_assoc($result)) {
            $restaurant = new Restaurant($row['id'], $row['name'], $row['mobile'], $row['email'], $row['password'], $row['created_at'], $row['updated_at']);
        }
        return $restaurant;
    }

    public static function findByMobile(string $mobile)
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("SELECT `id`,`name`,`email`,`mobile`,`password`,`created_at`,`updated_at` FROM `restaurants` WHERE `mobile`=?");
        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $restaurant = null;
        if ($row = mysqli_fetch_assoc($result)) {
            $restaurant = new Restaurant($row['id'], $row['name'], $row['mobile'], $row['email'], $row['password'], $row['created_at'], $row['updated_at']);
        }
        return $restaurant;
    }
}
