<?php
session_start();

use Controllers\RegisterController;

spl_autoload_register();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user-register'])) {
    $name       = test_input($_POST["user-name"]);
    $email      = test_input($_POST["user-email"]);
    $mobile     = test_input($_POST["user-mobile"]);
    $password   = test_input($_POST["user-password"]);
    $preferance = test_input($_POST["user-preferance"]);

    RegisterController::userRegister($name, $mobile, $email, $password, $preferance);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restaurant-register'])) {
    $name       = test_input($_POST["restaurant-name"]);
    $email      = test_input($_POST["restaurant-email"]);
    $mobile     = test_input($_POST["restaurant-mobile"]);
    $password   = test_input($_POST["restaurant-password"]);

    RegisterController::restaurantRegister($name, $mobile, $email, $password, $preferance);
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
                        <h5 class="card-title text-center">User Registration</h5>
                        <form method="POST">
                            <div class="mb-2">
                                <label for="user-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="user-name" name="user-name">
                            </div>

                            <div class="mb-2">
                                <label for="user-mobile" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="user-mobile" pattern="[0-9]{10}" name="user-mobile">
                            </div>

                            <div class="mb-2">
                                <label for="user-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="user-email" name="user-email">
                            </div>

                            <div class="mb-2">
                                <label for="user-preferances" class="form-label">Food Preferance</label>
                                <select class="form-control form-select" id="user-preferance" name="user-preferance">
                                    <option value="VEG">VEG</option>
                                    <option value="NON-VEG">NON VEG</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="user-password" name="user-password">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Register" name="user-register">
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 col-lg-2 mx-aut"></div> -->
            <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Restaurant Registration</h5>
                        <form method="POST">
                            <div class="mb-2">
                                <label for="restaurant-name" class="form-label">Restaurant Name</label>
                                <input type="text" class="form-control" id="restaurant-name" name="restaurant-name">
                            </div>

                            <div class="mb-2">
                                <label for="restaurant-mobile" class="form-label">Restaurant Mobile</label>
                                <input type="text" class="form-control" id="restaurant-mobile" pattern="[0-9]{10}" name="restaurant-mobile">
                            </div>

                            <div class="mb-2">
                                <label for="restaurant-email" class="form-label">Restaurant Email</label>
                                <input type="email" class="form-control" id="restaurant-email" name="restaurant-email">
                            </div>
                            <div class="mb-2">
                                <label for="restaurant-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="restaurant-password" name="restaurant-password">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Register" name="restaurant-register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- .hero-->

<?php include './Templates/footer.php'; ?>