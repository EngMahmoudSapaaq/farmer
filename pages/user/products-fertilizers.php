<?php
    require_once __DIR__ . "/../../vendor/autoload.php";

    use Core\Components\Message;
    use Core\Helpers\Auth;
    use Core\Helpers\Redirect;
    use Core\Helpers\Request;
    use Core\Models\Cart;
    use Core\Models\Product;

    session_start();

    Redirect::ifNotUser();

    $message = null;
    if (Request::method('post')) {
        $id = Request::get('id');
        $product = Product::query()->find($id);
        $cart = new Cart;
        if ($cart->has($product->id)) {
            $message = Message::danger("Product has already been added");
        } else {
            if ($product->quantity > 0) {
                $cart->add($product);
                $message = Message::success("Product has been added successfully");
            } else {
                $message = Message::danger("Product is out of the stock now");
            }
        }
    }

    /**
     * @var Product[]
     */
    $fertilizers = Product::getFertilizers();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Unusually Natural Fruits</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/Logo.jpg" />
    <!-- Bootstrap Icons-->
    <link href="../../css/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Google fonts-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400&display=swap" rel="stylesheet">
    <!-- SimpleLightbox plugin CSS-->
    <link href="../../css/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- <link rel="stylesheet" href="./../../css/bootstrap.rtl.min.css"> -->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../../css/swiper.min.css">
    <!-- rating -->
    <link rel="stylesheet" href="../../css/star-rating-svg.css">
    <!-- dataTable -->
    <link rel="stylesheet" href="../../css/dataTables.bootstrap5.min.css">
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">
                <div class="logo"></div>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="farmers.php">Farmers</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products-fertilizers.php">Fertilizers</a></li>
                            <li><a class="dropdown-item" href="products-vegetables.php">Vegetables</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?= Auth::user()->name ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="orders.php"><i class="bi bi-list"></i> Orders</a></li>
                            <li><a class="dropdown-item text-danger" href="../auth/logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="chat.php" class="nav-link">Chat <i class="bi bi-chat-fill"></i> <span
                                class="d-none bg-danger rounded-circle text-light"
                                style="padding-left: 10px; padding-right: 10px;">5</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="purchases.php" class="nav-link">Cart <i class="bi bi-cart-fill"></i> <span
                                class="d-none bg-danger rounded-circle text-light"
                                style="padding-left: 10px; padding-right: 10px;">2</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Fertilizers</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5"><a href="index.php" class="white-link">Home</a> / Products / Fertilizers</p>
                    <a class="btn btn-primary btn-xl" href="#farmers">Learn More <i
                            class="bi bi-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </header>

    <!-- Farmers Section -->
    <section class="page-section bg-light" id="farmers">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php foreach ($fertilizers as $fertilizer): ?>
                    <?php
                        $farmer = $fertilizer->getFarmer();
                    ?>
                    <div class="col-lg-4 mt-3">
                        <div class="card h-100">
                            <img src="<?= '../../assets/uploads/' . $fertilizer->image ?>" onerror="this.src = 'https://ajsrp.com/wp-content/uploads/2022/10/placeholder.png'" class="card-img-top" alt="..."
                                style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= ucwords($fertilizer->name) ?></h5>
                                <p class="card-text"><?= $fertilizer->desc ?></p>
                            </div>
                            <div class="card-body">
                                <div>
                                    <small class="d-block"><b class="text-primary">Remaining Quantity:</b> <?= $fertilizer->quantity ?></small>
                                    <small class="d-block"><b class="text-primary">Price:</b> <?= $fertilizer->price ?> SAR</small>
                                </div>
                                <hr>
                                <div>
                                    <small class="d-block"><b class="text-primary">Farmer's Name:</b> <?= ucwords($farmer->name) ?></small>
                                    <small class="d-block"><b class="text-primary">Farmer's Rating:</b> <span class="my-rating-read-only" data-rating="<?= $farmer->getRating() ?>" dir="ltr"></span></small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form action="products-fertilizers.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $fertilizer->id ?>">
                                    <button type="submit" class="card-link btn btn-primary" style="font-weight: bold;">
                                        Add to Cart &nbsp;&nbsp;&nbsp;<i class="bi bi-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>



    <!-- Footer-->
    <footer class="bg-light py-5 border-top border-primary">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">All rights reserved &copy; 2024 - Unusually Natural Fruits</div>
        </div>
    </footer>

    <!-- jquery -->
    <script src="../../js/jquery.3.7.min.js"></script>
    <script src="../../js/jquery.validate.min.js"></script>
    <script src="../../js/jquery.validate.additional-methods.min.js"></script>
    <!-- rating -->
    <script src="../../js/jquery.star-rating-svg.js"></script>
    <!-- dataTables -->
    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="../../js/smipleLightbox.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Core theme JS-->
    <script src="../../js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- <script src="../../js/sb-forms-0.4.1.js"></script> -->
    <!-- swiper -->
    <script src="../../js/swiper.min.js"></script>
</body>

</html>

<?= $message ?? '' ?>

<?php require __DIR__ . '/../../components/messages.php' ?>
