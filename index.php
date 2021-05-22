<!-- fetch random dishes with restaurant name and price with image and display -->
<!-- Add search to find dish from search bar -->
<?php
session_start();

use Models\Item;

require './Models/Item.php';
spl_autoload_register();
$items = Item::all();

include './Templates/header.php';
include './Templates/message.php';
?>

<section class="hero hero--search">
    <div class="container">
        <div class="col-12">
            <div class="search">
                <form method="GET" action="./search.php">
                    <input class="input" type="text" name="query" placeholder="Search your favourite food">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <img src="./assets/images/hero-image.jpg" alt="">

</section><!-- .hero-->

<section id="=restaurant" class="p-4">
    <div class="container-fluid text-center">
        <div class="col-md-6 mx-auto p-2">
            <h2>Popular Dish</h2>
        </div>
    </div>
    <div class="container">
        <div id="owl-restaurant" class="owl-carousel owl-theme">
            <?php while ($item = $items->fetch_array()) {
                $item_name = $item['name'];
                $item_price = $item['price'];
                $item_name = $item['name'];
                $item_type = $item['type'];
                $item_restaurant = $item['restaurant_id'];
                $item_restaurant_name = $item['restaurant_name'];
            ?>
                <div class="item">
                    <div class="card" style="width: 18rem;">
                        <span class="badge bg-warning text-dark dish-type"><?= $item_type ?></span>
                        <img src="./assets/images/carousel/carousel-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item_name ?></h5>
                            <span class="fs-5 text-info">Starts From ₹<?= $item_price ?>-</span>
                            <p class="card-text fs-5">Restaurant Name</p>
                            <a href="./menu.php?id=<?= $item_restaurant ?>" class="card-link btn btn-block btn-primary w-100">View
                                Menu</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<footer>
    <div class="text-center bg-secondary pt-2 pb-2">
        <span class="text-white">Copyright &#169; 2021 <a href="./" class="text-white" style="text-decoration: none;"> FoodShala</a></span>
    </div>
</footer>
<!--Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {

        $("#owl-restaurant").owlCarousel({
            navigation: true,
            autoPlay: 3000, //Set AutoPlay to 3 seconds

            items: 4,
            itemsDesktop: [1400, 4], //1400:screen size, 3: number if items in the slide
            itemsDesktopSmall: [1100, 3],
            itemsTablet: [700, 2],
            itemsMobile: [500, 1]
        });
    });
</script>
</body>

</html>