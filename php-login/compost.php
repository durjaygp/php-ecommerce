<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gardening Center</title>
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-circle"></div>
        <div class="preloader-img">
            <img src="img/core-img/leaf.png" alt="">
        </div>
    </div>

    <header class="header-area">

        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-header-content d-flex align-items-center justify-content-between">
                            <div class="top-header-meta">
                                <div class="top-header-meta d-flex">
                                    <div class="login" id="loginpermission">
                                    </div>
                                    <div class="register">
                                        <a href="../Register.html"><i class="fa fa-user"
                                                aria-hidden="true"></i><span>Register</span></a>
                                    </div>
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

                            <h1 style="color: greenyellow;">GARDEN CENTER</h1>

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
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="#">Plants</a>
                                            <ul class="dropdown">
                                                <li><a href="Roses.html">Roses</a></li>
                                                <li><a href="hedging.html">Hedging</a></li>
                                                <li><a href="shrubs.html">Shrubs</a>

                                                </li>

                                            </ul>
                                        </li>
                                        <li><a href="#">Gardening</a>
                                            <ul class="dropdown">
                                                <li><a href="Seeds.html">Seeds</a></li>
                                                <li><a href="compost.html">Compost</a></li>
                                                <li><a href="Fertilizers.html">Fertilizers</a></li>
                                                <li><a href="Watering.html">Watering</a></li>
                                            </ul>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
    </header>

    <div class="breadcrumb-area">
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center"
            style="background-image: url(img/bg-img/24.jpg);">
            <h2>Compost</h2>
        </div>
        <div class="col-12 col-md-8 col-lg-12 mt-5">
            <div class="shop-products-area">
                <div class="row">
                    <?php
                    include "config.php";
                    $query = "SELECT * FROM products";
                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    ?>
                        <?php
                        // Step 3: Use a loop to iterate through the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                        // Get the product details from the current row
                        $productName = $row['product_name'];
                        $productPrice = $row['product_price'];
                        $productImage = $row['product_image'];
                        ?>

                        <div class="col-10 col-sm-6 col-lg-4 ">
                            <div class="single-product-area mb-50">
                                <div class="product-img shadow">
                                    <a><img src="img/compost_1_960x960.jpg" class="rounded" alt=""></a>
                                    <div class="product-tag">
                                    </div>
                                    <div class="product-meta d-flex">
                                        <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                        <a href="#" class="add-to-cart-btn">Add to cart</a>
                                        <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                                    </div>
                                </div>

                                <div class="product-info mt-15 text-center">
                                    <a href="#">
                                        <h6>Green Acres Compost.</h6>
                                        <p>£20.50</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                            <?php
                        } // End of the while loop
                        ?>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-area mb-50">
                            <div class="product-img shadow">
                                <a><img src="img/compost_2_960x960.jpg" class="rounded" alt="" height="30pxs"></a>
                                <div class="product-meta d-flex">
                                    <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                    <a href="#" class="add-to-cart-btn">Add to cart</a>
                                    <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                                </div>
                            </div>
                            <div class="product-info mt-15 text-center">
                                <a href="#">
                                    <h6>Natural Compost</h6>
                                    <p>£18.42</p>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-area mb-50">
                            <div class="product-img shadow">
                                <a><img src="img/compost_3_960x960.jpg" class="rounded" alt=""></a>
                                <div class="product-tag sale-tag">
                                </div>
                                <div class="product-meta d-flex">
                                    <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                    <a href="#" class="add-to-cart-btn">Add to cart</a>
                                    <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                                </div>
                            </div>
                            <div class="product-info mt-15 text-center">
                                <a href="#">
                                    <h6>Topbase Compost</h6>
                                    <p>£10.23</p>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
    </div>

    <footer class="footer-area bg-img" style="background-image: url(img/bg-img/3.jpg);">
        <div class="main-footer-area">
            <div class="container">
                <div class="row">
                    <div class="top-breadcrumb-area  d-flex align-items-center justify-content-center"
                        class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="footer-logo mb-30">
                                <h1 style="color: greenyellow;">GARDEN CENTER</h1>
                                <p>Welcome to our gardening company website! Our aim is to help you create a beautiful
                                    and thriving garden that you can enjoy all year round. Our website is designed to
                                    provide you with easy access to all the information and products you need to get
                                    started. When you first visit our website, you will see a drop-down menu at the top
                                    of the page with two items: Plants and Gardening. These options will help you
                                    navigate to the products you need. If you select Plants, you will be taken to a
                                    second drop-down menu that will show you a range of options to choose from,
                                    including Roses, Hedging, and Shrubs.</p>
                            </div>

                        </div>
                    </div>




                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="copywrite-text">
                            <p>&copy;
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script> All rights reserved by
                                Garden Center

                            </p>
                        </div>
                        </>

                    </div>
                </div>
            </div>
    </footer>

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/Nav.js"></script>
    <script src="js/active.js"></script>

</body>

</html>