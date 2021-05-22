<?php
session_start();

use Controllers\UserItemController;

require './Controllers/UserItemController.php';
spl_autoload_register();

if (!$_GET['id']) {
    header("Location:./");
}

$id = $_GET['id'];
$items = UserItemController::restaurantMenu($id);

include './Templates/header.php';
include './Templates/message.php' ?>
<section class="hero hero-search-page">
    <div class="container">
        <div class="col-12">
            <div class="search text-center">
                <h1 class="text-white">Order your favourite food</h1>
            </div>
        </div>
    </div>
    <img src="./assets/images/hero-image.jpg" alt="">

</section><!-- .hero-->

<section id="=restaurant" class="p-4">
    <div class="container">
        <div class="row">
            <?php
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
                            <form action="./add-to-cart.php" method="post">
                                <input type="hidden" name="item-id" value="<?= $item->id ?>">
                                <button type="submit" class="btn btn-block btn-info btn-sm float-end" id="product<?= $item->id ?>">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<footer>
    <div class="text-center bg-secondary pt-2 pb-2">
        <span class="text-white">Copyright &#169; 2021 <a href="./" class="text-white"> FoodShala</a></span>
    </div>
</footer>
<!--Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" crossorigin="anonymous"></script>
</body>

</html>