<?php
    require_once __DIR__ . "/../../../vendor/autoload.php";

    use Core\Helpers\Redirect;
    use Core\Models\Farmer;

    session_start();

    Redirect::ifNotLoggedIn();
    Redirect::ifNotAdmin();

    /**
     * @var Farmer[]
     */
    $farmers = Farmer::query()->all();
    $modals = '';
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand align-middle" href="index.php">
                <div class="logo rounded"></div>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="farmers.php">Farmers <i class="bi bi-people"></i></a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="companies.php">Shipping Companies <i class="bi bi-building"></i></a></li>-->
                    <!-- <li class="nav-item"><a class="nav-link" href="orders.php">Orders <i class="bi bi-list-ul"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="tickets.php">Tickets <i class="bi bi-paperclip"></i></a></li> -->
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ahmad Mohammed
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-danger" style="text-align: left;" href="../auth/logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            Registered as: <b class="text-primary">Administrator</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead banner">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Farmers <i class="bi bi-people"></i></h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <a class="btn btn-primary btn-xl" href="#about">Learn More <i
                            class="bi bi-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </header>

    <!-- about -->
    <section class="page-section bg-light" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <table id="dataTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Commercial Register</th>
                                <th>Account Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($farmers as $farmer): ?>
                                <tr>
                                    <td><?= $farmer->id ?></td>
                                    <td><?= $farmer->name ?></td>
                                    <td><?= $farmer->phone ?></td>
                                    <td><?= $farmer->commercial_number ?></td>
                                    <td><?php require "farmers-status.php" ?></td>
                                    <td>
                                        <a  href="farmers-status-change.php?id=<?= $farmer->id ?>&status=activated"
                                            class="btn p-0 btn-success mytooltip <?= $farmer->status == 'activated' ? 'd-none' : '' ?>"
                                            style="padding-right: 5px !important; padding-left: 5px !important;"
                                            onclick="return confirm('Do you want to proceed with the operation?')"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Accept">
                                            <i class="bi bi-check"></i>
                                        </a>
                                        <a href="farmers-status-change.php?id=<?= $farmer->id ?>&status=rejected"
                                            class="btn p-0 btn-warning mytooltip <?= $farmer->status == 'pending' ? '' : 'd-none' ?>"
                                            style="padding-right: 5px !important; padding-left: 5px !important;"
                                            onclick="return confirm('Do you want to proceed with the operation?')"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Reject">
                                            <i class="bi bi-x"></i>
                                        </a>
                                        <a  href="farmers-status-change.php?id=<?= $farmer->id ?>&status=blocked"
                                            class="btn p-0 btn-danger mytooltip <?= $farmer->status == 'activated' ? '' : 'd-none' ?>"
                                            style="padding-right: 5px !important; padding-left: 5px !important;"
                                            onclick="return confirm('Do you want to proceed with the operation?')"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Ban">
                                            <i class="bi bi-slash-circle"></i>
                                        </a>
                                        <div class="mytooltip d-inline-block"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="View More Data">
                                            <button href="farmers-show.php"
                                                class="btn p-0 btn-info"
                                                style="padding-right: 5px !important; padding-left: 5px !important;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showFarmerDataModal<?= $farmer->id ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    ob_start();
                                    require "farmers-show.php";
                                    $modals .= ob_get_clean();
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $modals ?>
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
    <!-- Core theme JS-->
    <script src="../../js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- <script src="../../js/sb-forms-0.4.1.js"></script> -->
    <!-- swiper -->
    <script src="../../js/swiper.min.js"></script>
    <!-- dataTables -->
    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

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

        $(".my-rating-read-only").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 25,
            emptyColor: 'lightgray',
            hoverColor: '#0dcaf0',
            activeColor: '#0dcaf0',
            useGradient: false,
            readOnly: true,
        });

        new DataTable('#dataTable');
    </script>
</body>

</html>
 
<?php require __DIR__ . '/../../../components/messages.php' ?>
