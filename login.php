<?php

session_start();

use Controllers\AuthController;

require './Controllers/AuthController.php';

spl_autoload_register();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user-login'])) {
    $mobile = test_input($_POST["user-mobile"]);
    $password = test_input($_POST["user-password"]);

    AuthController::userLogin($mobile, $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restaurant-login'])) {
    $mobile = test_input($_POST["restaurant-mobile"]);
    $password = test_input($_POST["restaurant-password"]);

    AuthController::restaurantLogin($mobile, $password);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include './Templates/header.php';
include './Templates/message.php';
?>
<section id="login" class="p-4">

    <div class="container">
        <div class="row">
            <?php include './Templates/message.php'; ?>
            <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">User Login</h5>
                        <form class="form-signin" method="POST">
                            <div class="form-label-group">
                                <input type="number" pattern="[0-9]{10}" id="user-mobile" class="form-control" placeholder="Mobile" name="user-mobile" required autofocus>
                                <label for="user-mobile">Mobile</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="user-password" required>
                                <label for="user-password">Password</label>
                            </div>

                            <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Sign in" name="user-login">
                            <hr class="my-4">
                            <span class="fs-5"><a href="./register" style="text-decoration: none;">Register as
                                    User</a></span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 col-lg-2 mx-aut"></div> -->
            <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Restaurant Login</h5>
                        <form class="form-signin" method="POST">
                            <div class="form-label-group">
                                <input type="number" pattern="[0-9]{10}" id="restuarnt-mobile" class="form-control" placeholder="Mobile" name="restaurant-mobile" required autofocus>
                                <label for="restuarnt-mobile">Restaurant Mobile</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="restuarnt-password" class="form-control" placeholder="Password" name="restaurant-password" required>
                                <label for="restuarnt-password">Password</label>
                            </div>

                            <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Sign in" name="restaurant-login">
                            <hr class="my-4">
                            <span class="fs-5"><a href="./register" style="text-decoration: none;">Register as
                                    Restaurant</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- .hero-->

<?php include './Templates/footer.php'; ?>