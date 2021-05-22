<?php
session_start();

use Controllers\BackController;
use Controllers\CartController;

require './Controllers/CartController.php';
require './Controllers/BackController.php';

spl_autoload_register();

if (!isset($_SESSION['cart'])) {
    BackController::goBack(['Cart is empty, order your food now']);
}

$items = $_SESSION['cart'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place-order'])) {
    $name       = test_input($_POST["cart-name"]);
    $mobile       = test_input($_POST["cart-mobile"]);
    $email       = test_input($_POST["cart-email"]);
    $address       = test_input($_POST["cart-address"]);
    $city       = test_input($_POST["cart-city"]);
    $pin       = test_input($_POST["cart-pin"]);

    CartController::placeOrder($name, $mobile, $email, $address, $city, $pin);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include './Templates/header.php';
?>
<section id="=restaurant" class="p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12 border">
                <span class="text-bold text-muted fs-4"> Your Product</span>
                <?php

                $total_amount = 0;
                foreach ($items  as $item) {
                    $item_name = $item['name'];
                    $item_type = $item['type'];
                    $item_image = $item['image'];
                    $item_description = $item['description'];
                    $item_price = $item['price'];

                    $total_amount += $item_price;
                ?>
                    <div class="card p-2 mb-2">
                        <div class="menu-box">
                            <img src="./assets/images/<?= $item_image ?>" alt="menu pic" class="featured-pic">
                            <span class="badge bg-warning text-dark veg-non-veg"><?= $item_type ?></span>
                            <div class="menu-title ">
                                <h5 class="title bg-secondry">
                                    <span><?= $item_name ?></span>
                                </h5>
                                <span class="float-end fs-5">
                                    ₹<?= $item_price ?>
                                </span>
                                <p><?= $item_description ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-8 order-md-1">
                <span class="float-end fs-4 text-primary">Total ₹ <?= $total_amount ?>/-</span>
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cart-name">Name</label>
                            <input type="text" class="form-control" id="cart-name" placeholder="Enter Name" name="cart-name" required>
                            <div class="invalid-feedback"> Valid name is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cart-mobile">Mobile</label>
                            <input type="text" class="form-control" id="cart-mobile" placeholder="Enter Mobile" name="cart-mobile" required>
                            <div class="invalid-feedback">Valid Mobile number is required. </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cart-email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="cart-email" placeholder="you@example.com" name="cart-email">
                        <div class="invalid-feedback"> Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cart-address">Address</label>
                        <input type="text" class="form-control" id="cart-address" placeholder="Enter Address" name="cart-address" required>
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cart-city">City</label>
                            <input type="text" class="form-control" id="cart-city" placeholder="City" name="cart-city" required>
                            <div class="invalid-feedback"> City is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cart-pin">Pin Code</label>
                            <input type="text" class="form-control" id="cart-pin" placeholder="PIN Code" name="cart-pin" required>
                            <div class="invalid-feedback"> PIN code required. </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="">*Please keep exact change amount to give during the delivery</span>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="place-order">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include './Templates/footer.php'; ?>