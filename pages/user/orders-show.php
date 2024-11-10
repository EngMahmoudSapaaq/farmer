<?php
    require_once __DIR__ . "/../../vendor/autoload.php";

use Core\Components\Message;
use Core\Helpers\Auth;
    use Core\Helpers\Redirect;
    use Core\Helpers\Request;
    use Core\Helpers\Session;
    use Core\Models\Order;

    session_start();

    Redirect::ifNotUser();

    /**
     * @var Order
     */
    $order = null;
    $toast = null;
    if (Request::has('id')) {
        $id = Request::get('id');
        $order = Order::query()->find($id);
        if (!$order) {
            Session::set('error', 'This order is not found');
            header("Location: orders.php");
            exit;
        }

        if (Request::method('post')) {
            $rate = Request::get('rate');
            $message = Request::get('info');
            Order::query()->where("`id`=$id")->update("
                `rate`=$rate,
                `message`='$message'
            ");
            $order = Order::query()->find($id);
            $toast = Message::success('Your rating has been added successfully');
        }
    } else {
        Session::set('error', 'This order is not found');
        header("Location: orders.php");
        exit;
    }
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
                    <h1 class="text-white font-weight-bold">Order Details</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">
                        <a href="index.php" class="white-link">Home</a> /
                        <a href="orders.php" class="white-link">Orders</a> /
                        Details
                    </p>
                    <a class="btn btn-primary btn-xl" href="#farmers">Learn More <i
                            class="bi bi-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </header>

    <!-- farmers-->
    <section class="page-section bg-light" id="farmers">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-3" style="text-align: left;">
                        <a href="orders.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> All Orders</a>
                    </div>
                    <table class="table table-striped" style="width:100%; text-align: left;">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <td><?= $order->id ?></td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td><?= $order->created_at ?></td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>
                                    <?php include "orders-status.php" ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Products</th>
                                <td>
                                    <?php
                                        $res = '';
                                        $products = $order->getProducts();
                                        foreach ($products as $product) {
                                            $res .= $product->name . ' - ';
                                        }
                                        echo trim($res, ' - ');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <button class="btn btn-primary"
                                        data-bs-target="#rate"
                                        data-bs-toggle="modal">Rate This Order!</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="rate" tabindex="-1" aria-labelledby="rateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rateLabel">Rate Order</h5>
                    </div>

                    <form action="orders-show.php?<?= Request::queryString() ?>" class="form" method="POST">
                        <div class="modal-body">
                            <div>
                                <label for="oldPassword" class="col-form-label">Rate</label>
                                <small class="form-control border-0 p-0"><span class="my-rating-4" data-rating="<?= $order->rate ?>" dir="ltr"></span></small>
                                <input type="hidden" class="form-control" id="rate_input" name="rate" value="<?= $order->rate ?>">
                                <!-- <span class="text-danger" style="font-weight: bold;">* error</span> -->
                            </div>

                            <div>
                                <label for="newPassword" class="col-form-label">Message</label>
                                <textarea class="form-control" rows="5" placeholder="Enter your opinion here..." name="info" required><?= $order->message ?></textarea>
                                <!-- <span class="text-danger" style="font-weight: bold;">* error</span> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="sumbit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
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

        $(".my-rating").starRating({
            initialRating: 4,
            strokeColor: '#D3A373',
            strokeWidth: 10,
            starSize: 25
        });

        $(".my-rating-4").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 25,
            emptyColor: 'lightgray',
            hoverColor: '#c34e2e',
            activeColor: '#D3A373',
            useGradient: false,
            readOnly: false,
            callback: function (currentRating, $el) {
                $('#rate_input').val(currentRating);
            }
        });

        $(".my-rating-4").change(function (e) {
            $('#rate_input').val($(e.target).data('rating'));
        })

        new DataTable('#dataTable');
    </script>
</body>

</html>

<?= $toast ?>

<?php require __DIR__ . '/../../components/messages.php' ?>
