<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gardening Center</title>
    <link rel="icon" href="img/flat/004-smart-tv.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-circle"></div>
    <div class="preloader-img">
        <img src="img/flat/001-smartphone.png" alt="">
    </div>
</div>

<header class="header-area">

    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <div class="top-header-meta">

                        </div>

                        <div class="top-header-meta d-flex">

                            <?php if (isset($_SESSION['id'])) { ?>
                                <!-- Show the user's data in the header menu -->
                                <li class="text-white h5">Welcome, <?php echo $_SESSION['phone']; ?></li>
                                <div class="login">
                                    <li><a href="logout.php" class="btn btn-danger ml-2">Logout</a></li>
                                </div>
                            <?php } else { ?>
                                <div class="login">
                                    <a href="login.php"><i class="fa fa-user"></i><span>Login</span></a>
                                </div>
                                <div class="register">
                                    <a href="register.php"><i class="fa fa-user" aria-hidden="true"></i><span>Register</span></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alazea-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <nav class="classy-navbar justify-content-between" id="alazeaNav">

                    <a href="index.php"><h1 style="color: greenyellow;">Electronics Shop</h1></a>

                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <div class="classy-menu">


                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <div class="classynav">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="ajax.php">Ajax</a></li>
                                <li><a href="#">Plants</a>
                                    <ul class="dropdown">
                                        <li><a href="roses.php">Roses</a></li>
                                        <li><a href="hedging.php">Hadging</a></li>
                                        <li><a href="shrubs.php">Shurbs</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a href="#">Gardening</a>
                                    <ul class="dropdown">
                                        <li><a href="seeds.php">Seeds</a></li>
                                        <li><a href="compost.php">Compost</a></li>
                                        <li><a href="fertilizers.php">Fertilizers</a>
                                        <li><a href="watering.php">Watering</a>
                                        </li>
                                    </ul>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
