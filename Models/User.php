<?php

namespace Models;

use Database\Db;

class User
{

    public $id, $name, $mobile, $email, $preferance, $password, $created_at, $updated_at;
    public function __construct($id, $name, $mobile, $email, $preferance, $password, $created_at, $updated_at)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->mobile     = $mobile;
        $this->email      = $email;
        $this->preferance = $preferance;
        $this->password   = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function create(string $name, string $mobile, string $email, string $password, string $preferance)
    {
        $conn = Db::getConnection();

        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stmt       = $conn->prepare("INSERT INTO `users`(`name`, `mobile`,`email`,`password`,`preferance`,`created_at`,`updated_at`) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $name, $mobile, $email, $password, $preferance, $created_at, $updated_at);
        $stmt->execute();
    }

    public static function findById(int $id)
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT 'id','name','email','mobile','preferance','created_at','updated_at' FROM `users` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = mysqli_fetch_assoc($result)) {
            $user = new User($row['id'], $row['name'], $row['mobile'], $row['email'], $row['preferance'], $row['password'], $row['created_at'], $row['updated_at']);
        }
        return $user;
    }

    public static function findByMobile(string $mobile)
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("SELECT `id`,`name`,`email`,`mobile`,`preferance`,`created_at`,`password`,`updated_at` FROM `users` WHERE `mobile`=?");
        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = null;
        if ($row = mysqli_fetch_assoc($result)) {
            $user = new User($row['id'], $row['name'], $row['mobile'], $row['email'], $row['preferance'], $row['password'], $row['created_at'], $row['updated_at']);
        }
        return $user;
    }
}
