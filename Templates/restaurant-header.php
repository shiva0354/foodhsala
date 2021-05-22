<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>FoodShala- Order Your Food From Nearby Restaurants</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">FoodShala</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-col-md-3 col-sm-6">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-col-md-3 col-sm-6">
                            <a class="nav-link" href="./menu.php">Menu</a>
                        </li>
                        <li class="nav-col-md-3 col-sm-6">
                            <a class="nav-link" href="./add-menu.php">Add Item</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="./orders.php" class="btn btn-block"><i class="fa fa-book"></i> View Orders</a>
                        </li>
                        <li>
                            <form action="./logout.php" method="post">
                                <button type="submit" class="btn btn-block"><i class="fa fa-sign-in-alt"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>