<!-- showing menu of a particular restaurant

add to cart functionality -->

<?php

use Controllers\ItemController;

require './restaurant-session.php';
require './Controllers/ItemController.php';
spl_autoload_register();

$items = ItemController::index();
include './Templates/restaurant-header.php';
include './Templates/message.php';
?>

<section id="=restaurant" class="p-4">
    <div class="container">
        <div class="row">
            <?php
            include './Templates/message.php';
            foreach ($items as $item) {
                $item_id = $item->id;
                $item_name = $item->name;
                $item_price = $item->price;
                $item_description = $item->description;
                $item_type = $item->type;
                $item_image = $item->image;
            ?>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card p-2">
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
                            <form action="./restaurant-delete-menu.php" method="POST">
                                <input type="hidden" name="item-id" value="<?= $item->id ?>">
                                <button type="submit" class="btn btn-block btn-danger btn-sm float-start" id="product<?= $item->id ?>">Delete</button>
                            </form>
                            <button class="btn btn-block btn-info btn-sm float-end" id="product<?= $item->id ?>">Edit</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php include './Templates/footer.php'; ?>