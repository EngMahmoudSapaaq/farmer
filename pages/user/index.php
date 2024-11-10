<?php
    require_once __DIR__ . "/../../vendor/autoload.php";

    use Core\Helpers\Auth;
    use Core\Helpers\Redirect;
    use Core\Models\Farmer;

    session_start();

    Redirect::ifNotUser();

    /**
     * @var Farmer[]
     */
    $farmers = Farmer::query()->all();
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

    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Accessing Farmers is No Longer Difficult</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">This website provides you with ways to purchase the best agricultural products directly from farmers, in partnership with shipping companies that will deliver your order anywhere with a click of a button.</p>
                    <a class="btn btn-primary btn-xl" href="#about">Learn More <i class="bi bi-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </header>
    

    <!-- About-->
    <section class="page-section bg-primary" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">We Are Here to Help You</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">You can order any product from the available items, and it will be delivered to you wherever you are. You can also contact our responsible team in case of any errors to ensure you receive the best services.</p>
                    <a class="btn btn-light btn-xl" href="#services">Get Started <i class="bi bi-skip-end-fill"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">What Sets Us Apart</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Ease of Access</h3>
                        <p class="text-muted mb-0">We provide you with the most convenient ways to reach us through the website.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Speed</h3>
                        <p class="text-muted mb-0">We are known for our quick response to complaints and inquiries.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Coverage</h3>
                        <p class="text-muted mb-0">You'll find us everywhere due to the quality of our service.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Trust</h3>
                        <p class="text-muted mb-0">Your satisfaction is our priority. You can trust us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Farmers-->
    <section class="page-section bg-primary" id="farmers">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Farmers Working with Us</h2>
                    <hr class="divider divider-light" />
                    <!-- Slider main container -->
                    <div class="swiper pb-3">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach ($farmers as $farmer): ?>
                                <!-- Card 1 -->
                                <div class="card swiper-slide mx-auto" style="width: 18rem;" dir="ltr">
                                    <div class="card-body">
                                        <img src="<?= '../../assets/uploads/' . $farmer->image ?>" onerror="this.src = 'https://d2gtafdivcal5l.cloudfront.net/images/profile-placeholder-img_20210727172702.png'" class="card-img-top rounded-circle p-3" style="object-fit: cover; width: 100px; height: 100px;" width="300" height="300" alt="...">
                                        <h5 class="card-title"><?= ucwords($farmer->name) ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Rating</h6>
                                        <div class="my-rating-4" data-rating="<?= $farmer->getRating() ?>"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- If we need a scrollbar -->
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="bg-light py-5 border-top border-primary">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">All rights reserved &copy; 2024 - Unusually Natural Fruits</div>
        </div>
    </footer>


    <script src="../../js/jquery.3.7.min.js"></script>
    <script src="../../js/jquery.star-rating-svg.js"></script>
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

    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },

            autoplay: {
                delay: 5000,
            },

            slidesPerView: 2,
            spaceBetween: 20,
        });

        $(".my-rating-4").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 40,
            emptyColor: 'lightgray',
            hoverColor: '#c34e2e',
            activeColor: '#708657',
            useGradient: false,
            readOnly: true,
        });
    </script>
</body>

</html>

<?php require __DIR__ . '/../../components/messages.php' ?>
