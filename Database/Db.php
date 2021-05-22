<?php

namespace Database;

class Db
{
    private static $conn = null;

    public static function getConnection()
    {
        // $GLOBALS['url'] = 'http::localhost/foodshala/';
        if (self::$conn == null) {
            self::$conn = mysqli_connect('localhost', 'root', '', 'foodshala');
        }

        return self::$conn;
    }
}
