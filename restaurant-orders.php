<?php

require './restaurant-session.php';

use Controllers\RestaurantOrderController;

require './Controllers/RestaurantOrderController.php';
spl_autoload_register();

$restaurant = unserialize($_SESSION['restaurant']);
$orders = RestaurantOrderController::index();

include './Templates/restaurant-header.php';
include './Templates/message.php';
?>

<section class="orders">
    <div class="container">
        <div class="text-center">
            <span class="fs-2">All Orders</span>
        </div>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">OrderId</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orders as $order) {
                    $id = $order->id;
                    $name = $order->name;
                    $address = $order->address;
                    $city = $order->city;
                    $pin = $order->pin;
                    $status = $order->status;
                    $total_amount = $order->total_amount;
                ?>
                    <tr>
                        <th scope="row"><?= $id ?></th>
                        <td><?= $name ?></td>
                        <td><?= $address ?>, <?= $city ?>, <?= $pin ?></td>
                        <td>₹ <?= $total_amount ?></td>
                        <td><?= $status ?></td>
                        <td><a href="./restaurant-order-detail.php?id=<?= $id ?>" class="btn btn-block btn-primary">View</a></td>
                        <td><button class="btn btn-block btn-primary">Mark As Complete</button></td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</section>
<?php include './Templates/footer.php'; ?>