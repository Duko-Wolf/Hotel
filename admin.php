<?php include('includes/session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen || B&B Webshop</title>
    <link rel="icon" type="image/x-icon" href="img/buurmanheader2.jpg">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styling/global.css">
</head>

<body>

    <?php

    include("functions/function.php");

    $conn = dbConnect();

    if (isset($_SESSION['name'])) {
        header("Location: index.php");
        exit();
    }
    ?>
 <?php include("includes/navbar.php");
    ?>
    <?php include("includes/header.php");
    ?>
   

    <section class="bg-image" style="margin-bottom: 5%;">
        <div class="container h-90">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login</h2>

                            <form method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" id="loginform" name="name" class="form-control form-control-lg" required>
                                    <label class="form-label" for="loginform">Naam</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="loginform" name="password" class="form-control form-control-lg" required>
                                    <label class="form-label" for="loginform">Wachtwoord</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">
                                </div>
<!-- 
                                <p class="text-center text-muted mt-5 mb-0">Heeft u nog geen account? <a href="registreer.php" class="fw-bold text-body"><u>Registreer hier</u></a></p>
                                <p class="text-center text-muted mt-5 mb-0">Wachtwoord vergeten? <a href="wachtwoord-vergeten.php" class="fw-bold text-body"><u>Nieuw Wachtwoord hier</u></a></p> -->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    // import functions.php
    require_once 'functions\function.php';

    $conn = dbConnect();

    // use function login() from functions.php
    login($conn);

    ?>

    <?php include("includes/footer.php");
    ?>

</body>

</html>