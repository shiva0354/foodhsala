<?php

require './restaurant-session.php';

use Controllers\ItemController;

require './Database/Db.php';
require './Models/Item.php';
require './Models/Restaurant.php';
require './Controllers/ItemController.php';
require './Controllers/AuthController.php';
require './Controllers/BackController.php';
spl_autoload_register();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item-add'])) {
    $name       = test_input($_POST["item-name"]);
    $price      = test_input($_POST["item-price"]);
    $description     = test_input($_POST["item-description"]);
    $type   = test_input($_POST["item-type"]);

    $file_size = $_FILES['item-image']['size'];
    $file_tmp = $_FILES['item-image']['tmp_name'];
    $extension = pathinfo($_FILES["item-image"]["name"], PATHINFO_EXTENSION);
    $file_name = md5(uniqid($_FILES['item-image']['name'], true)) . '.' . $extension;
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($extension, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be less than 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "./assets/images/" . $file_name);
        ItemController::store($name, $price, $file_name, $description, $type);
        echo '<script>alert("Item Added successfully");</script>';
        exit();
    } else {
        print_r($errors);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include './Templates/restaurant-header.php';
include './Templates/message.php';
?>

<section id="menu-item" class="p-4">
    <div class="container">
        <div class="text-center p-2">
            <h2 class="text-primary">Add Item</h2>
        </div>
        <div class="col-md-8 col-sm-12 mx-auto">
            <?php include './Templates/message.php'; ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="mb-3">
                        <label for="item-name">Item Name</label>
                        <input type="text" class="form-control" id="item-name" placeholder="Item Name" name="item-name" required="">
                    </div>
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="item-price" placeholder="Price" pattern="[0-9]{2,4}" name="item-price" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Description</label>
                    <input type="text" class="form-control" id="item-description" placeholder="Item Description" name="item-description">
                </div>
                <div class="mb-3">
                    <label for="address">Type</label>
                    <select name="item-type" class="form-control form-select" id="item-type" required>
                        <option value="VEG">VEG</option>
                        <option value="NON-VEG">NON VEG</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="city">Item Image <small class="text-primary">*only jpg and jpeg</small></label>
                    <input type="file" class="form-control" id="item-image" accept="image/png, image/jpg, image/jpeg" name="item-image" required>
                </div>
                <input class="btn btn-primary btn-lg btn-block" type="submit" name="item-add" value="Add">
            </form>
        </div>
    </div>
</section>
<?php include './Templates/footer.php'; ?>