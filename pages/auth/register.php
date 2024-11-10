<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use Core\Components\Message;
    use Core\Helpers\Auth;
    use Core\Helpers\Redirect;
    use Core\Helpers\Request;
    use Core\Models\User;
    use Core\Models\Account;

    use Core\Helpers\Services\FileManager;
    use Core\Models\Farmer;

    session_start();

    $message = null;
    if (Request::method('post')) {
        if(Request::get('type') == "buyer"){
            
            Redirect::ifLoggedIn(root_dir: '../..');
            
            $name       = Request::get('name');
            $email      = Request::get('email');
            $password   = password_hash(Request::get('password'), PASSWORD_DEFAULT);
            $phone      = Request::get('phone');
            $street     = Request::get('street');
            $city       = Request::get('city');
            $district   = Request::get('district');
            $exists = User::query()->where("`email`='{$email}'")->first();
            if (is_null($exists)) {
                $id = User::query()->insert("
                    `name`='{$name}',
                    `email`='{$email}',
                    `password`='{$password}',
                    `phone`='{$phone}',
                    `street`='{$street}',
                    `city`='{$city}',
                    `district`='{$district}'
                ");
                /*$account = Account::query()->insert("
                    `email`='{$email}',
                    `password`='{$password}',
                    `account_type`='Buyer'
                ");*/
                 include('../../connect.php');
                 $sql = "INSERT INTO accounts (email , password , account_type) VALUES ('$email' , '$password' , 'Buyer')";
                 $con->exec($sql);
                $user = User::query()->find($id);
                $user->type = 'user';
                Auth::login($user);
                Redirect::afterLoggedIn();
            } else {
                $message = Message::danger('Email is already exists!');
            }
            
        }elseif(Request::get('type') == "farmer"){
        
        //Redirect::ifLoggedIn('../../..');   
        
        $name               = Request::get('name');
        $email              = Request::get('email');
        $phone              = Request::get('phone');
        $commercial_number  = Request::get('commercial_number');
        $bank_name          = Request::get('bank_name');
        $bank_account       = Request::get('bank_account');
        $password           = password_hash(Request::get('password'), PASSWORD_DEFAULT);
        $filename           = null;

        if ($farmer = Farmer::query()->where("`email`='$email'")->first())
            Redirect::withError('register.php', 'Email already exists!');

        if ($file = Request::file('file')) {
            $fm = (new FileManager)
                ->setFile($file)
                ->setRootDir('../../')
                ->setFileName(Auth::user()->image);
            $fm->deleteFile();
            $filename = $fm->storeFile();
        }

        $id = Farmer::query()
        ->insert("
            `name`='$name',
            `email`='$email',
            `password`='$password',
            `phone`='$phone',
            `commercial_number`='$commercial_number',
            `bank_name`='$bank_name',
            `bank_account`='$bank_account'" .
            ($filename ? ",`image`='$filename'" : '')
        );
        include('../../connect.php');
         $sql = "INSERT INTO accounts (email , password , account_type) VALUES ('$email' , '$password' , 'Farmer')";
         $con->exec($sql);
        $user = Farmer::query()->find($id);
        $user->type = 'farmer';
        Auth::login($user);
        //Redirect::afterLoggedIn();
            
        header('location:../../admin/pages/farmer/index.php');    
            
        
        }
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
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../../index.php">
                <div class="logo"></div>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../outer/farmers.php">Farmers</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../outer/products-fertilizers.php">Fertilizers</a></li>
                            <li><a class="dropdown-item" href="../outer/products-vegetables.php">Vegetables</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item"><a class="nav-link" href="../outer/products.php">Products</a></li> -->
                </ul>
                <div>
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead min-h-100 pb-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">New Registration</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline" style="text-align: left !important;">
                    <form action="register.php" method="POST" class="form">
                        <div>
                            <label for="name" class="text-light col-form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div>
                            <label for="email" class="text-light col-form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div>
                            <label for="password" class="text-light col-form-label">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-light col-form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div>
                            <label for="phone" class="text-light col-form-label">Phone Number *</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div>
                            <label for="street" class="text-light col-form-label">Select Account Type *</label>
                            <select placeholder="" style="border-radius: 5px;font-family: cairo" name="type" required class="form-control select">
                                <option value="">Select Account Type</option>

                                <option value="farmer"  id="farmer">Farmer</option>
                                <option value="buyer" id="buyer">Buyer</option>
                          </select>
                        </div>
                        <div class="q1">
                            <label for="street" class="text-light col-form-label">Street *</label>
                            <input type="text" class="form-control" id="street" name="street">
                        </div>
                        <div class="q2">
                            <label for="city" class="text-light col-form-label">City *</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>

                        <div class="q3">
                            <label for="district" class="text-light col-form-label">District *</label>
                            <input type="text" class="form-control" id="district" name="district">
                        </div>
                        
                         <div class="q4">
                            <label for="commercial-register" class="text-light col-form-label">Commercial Register Number *</label>
                            <input type="text" class="form-control" id="commercial-register" name="commercial_number">
                        </div>

                        <div class="q5">
                            <label for="bank-name" class="text-light col-form-label">Bank Name *</label>
                            <input type="text" class="form-control" id="bank-name" name="bank_name">
                        </div>

                        <div class="q6">
                            <label for="bank-account-number" class="text-light col-form-label">Bank Account Number *</label>
                            <input type="text" class="form-control" id="bank-account-number" name="bank_account">
                        </div>

                        <div class="q7">
                            <label for="image" class="text-light col-form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="file">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                            &nbsp;
                            <a class="white-link" href="login.php">Already have an account?</a>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Core theme JS-->
    <script src="../../js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="../../js/sb-forms-0.4.1.js"></script>
    <!-- swiper -->
    <script src="../../js/swiper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>    
  <script>
      
      $('.q1').hide();  
      $('.q2').hide();  
      $('.q3').hide(); 
      $('.q4').hide();  
      $('.q5').hide();  
      $('.q6').hide(); 
      $('.q7').hide();  
      
      $('.select').on('change', function() {      
          
       var types = ['farmer'];
       if (types.indexOf(this.value) >= 0){     
         $('.q4').show();
         $('.q5').show();
         $('.q6').show();
         $('.q7').show();   
         $('.q1').hide();   
         $('.q2').hide();   
         $('.q3').hide();   
            
       }else{    
         $('.q4').hide();
         $('.q5').hide();
         $('.q6').hide();
         $('.q7').hide();   
         $('.q1').show();   
         $('.q2').show();   
         $('.q3').show(); 
       }
     });
	
  </script>
</body>

</html>

<?= $message ?? '' ?>

<?php require __DIR__ . '/../../components/messages.php' ?>
