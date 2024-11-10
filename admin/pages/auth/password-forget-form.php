<?php

    require __DIR__ . '/../../../vendor/autoload.php';

    use Core\Helpers\Redirect;
    use Core\Helpers\Request;
    use Core\Helpers\Session;
    use Core\Models\Farmer;

    session_start();

    Redirect::ifLoggedIn(root_dir: '../../..');

    $message = null;
    if (Request::method('post')) {
        $new = password_hash(Request::get('password'), PASSWORD_DEFAULT);
        $email = Request::get('email');
        Farmer::query()->where("`email`='$email'")->update("
            `password`='{$new}'
        ");
        Session::set('done', 'Your password has been updated successfully');
        header("Location: login.php");
        exit;
    }

    if (Request::has('email')) {
        $email = Request::get('email');
        $farmer = Farmer::query()->where("`email`='$email'")->first();
        if (!$farmer)
            Redirect::withError('password-forget.php', 'This email does not exists!');
    } else {
        Redirect::withError('password-forget.php', 'This email does not exists!');
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand align-middle" href="#">
                <div class="logo rounded"></div>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                </ul>
                <div>
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead banner">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Password Recovery</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline" style="text-align: left !important;">
                    <form action="password-forget-form.php?email=<?= $email ?>" method="POST" class="form">
                        <div>
                            <label for="password" class="text-light col-form-label">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-light col-form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Footer-->
    <footer class="bg-light py-5 border-top border-primary">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">All rights reserved &copy; 2024 - Unusually Natural Fruits</div>
        </div>
    </footer>


    <script src="../../js/jquery.3.7.min.js"></script>
    <script src="../../js/jquery.validate.min.js"></script>
    <script src="../../js/jquery.validate.additional-methods.min.js"></script>
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

        $(".my-rating-4").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 40,
            emptyColor: 'lightgray',
            hoverColor: '#c34e2e',
            activeColor: '#D3A373',
            useGradient: false,
            readOnly: true,
        });
    </script>
</body>

</html>


<?= $message ?? '' ?>

<?php require __DIR__ . '/../../../components/messages.php' ?>
