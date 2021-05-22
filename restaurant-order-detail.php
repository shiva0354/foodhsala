<?php
require './restaurant-session.php';

use Controllers\RestaurantOrderController;

require './Controllers/RestaurantOrderController.php';
spl_autoload_register();

$restaurant = unserialize($_SESSION['restaurant']);

if (!$_GET['id']) {
    header('Location:./restaurnat.php');
    exit();
}

$id = $_GET['id'];
$data = RestaurantOrderController::orderDetail($id);
$order_detail = $data['order_detail'];
$order = $data['order'];

include './Templates/restaurant-header.php';
include './Templates/message.php';
?>

<section class="orders">
    <div class="container">
        <div class="text-center">
            <span class="fs-2">Order Detail</span>
        </div>
        <table class="table table-success table-striped align-middle">
            <tbody>
                <tr>
                    <th><?= $order->name ?></th>
                    <th><?= $order->address ?>, <?= $order->city ?>, <?= $order->pin ?></th>
                    <th>Total ₹ <?= $order->total_amount ?></th>
                    <th><?= $order->status ?></th>
                    <th><button class="btn btn-block btn-primary">Mark As Delivered</button></th>
                </tr>
            </tbody>
        </table>
        <table class="table table-light table-striped align-middle">
            <span>Products</span>
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $order_detail->fetch_array()) {
                    $type = $item['type'];
                    $name = $item['name'];
                    $image = $item['image'];
                    $description = $item['description'];
                    $price = $item['price'];
                ?>
                    <tr>
                        <th scope="row"><?= $type ?></th>
                        <td><img src="./assets/images/<?= $item_image ?>" alt="menu pic" class="featured-pic"></td>
                        <td><?= $name ?></td>
                        <td><?= $description ?></td>
                        <td>₹ <?= $price ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include './Templates/footer.php'; ?>