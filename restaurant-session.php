<?php
session_start();
if (!isset($_SESSION['restaurant'])) {
    header('Location:./login.php');
    exit();
}
