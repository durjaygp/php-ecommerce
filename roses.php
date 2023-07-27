<?php include"header.php";?>

    <div class="breadcrumb-area">
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center"
            style="background-image: url(img/bg-img/24.jpg);">
            <h2>Roses</h2>
        </div>
        <div class="col-12 col-md-8 col-lg-12 mt-5">
            <div class="shop-products-area">
                <div class="row">

                    <div class="col-10 col-sm-6 col-lg-4 ">
                        <div class="single-product-area mb-50">
                            <div class="product-img shadow">
                                <a><img src="img/Rosana_Flower.jpg" class="rounded" alt=""></a>
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
                                    <h6>Rosana Rose</h6>
                                    <p>£2.50</p>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-area mb-50">
                            <div class="product-img shadow">
                                <a><img src="img/primula.jpeg" class="rounded" alt="" height="30pxs"></a>
                                <div class="product-meta d-flex">
                                    <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                    <a href="#" class="add-to-cart-btn">Add to cart</a>
                                    <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                                </div>
                            </div>
                            <div class="product-info mt-15 text-center">
                                <a href="#">
                                    <h6>Primmula Rose</h6>
                                    <p>£7.4</p>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-area mb-50">
                            <div class="product-img shadow">
                                <a><img src="img/tulip.jpg" class="rounded" alt=""></a>
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
                                    <h6>Tulip Rose</h6>
                                    <p>£11.99</p>
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
                                <p>Welcome to our gardening company website! Our aim is to help you create a beautiful and thriving garden that you can enjoy all year round. Our website is designed to provide you with easy access to all the information and products you need to get started. When you first visit our website, you will see a drop-down menu at the top of the page with two items: Plants and Gardening. These options will help you navigate to the products you need. If you select Plants, you will be taken to a second drop-down menu that will show you a range of options to choose from, including Roses, Hedging, and Shrubs.</p>
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
    <script>
        var sessionStorage = window.sessionStorage;
        var user = sessionStorage.getItem("id");

        if (user !== null && user !== undefined) {
            document.getElementById('loginpermission').innerHTML = `
        <a id="logout-btn" style="cursor: pointer;"><i class="fa fa-user" aria-hidden="true"></i><span>Logout</span></a>`;
        } else {
            document.getElementById('loginpermission').innerHTML = `
        <a id="login-btn" style="cursor: pointer;"><i class="fa fa-user" aria-hidden="true"></i><span>Login</span></a>`;
        }

        var loginBtn = document.getElementById('login-btn');
        var logoutBtn = document.getElementById('logout-btn');


        if (loginBtn !== null) {
            loginBtn.addEventListener('click', function () {
                window.location.href = 'login.php';
            });
        }

        if (logoutBtn !== null) {
            logoutBtn.addEventListener('click', function () {
                sessionStorage.removeItem('id');
                window.location.href = 'login.php';
            });
        }
        
        $(document).ready(function () {
            $('.add-to-cart-btn').click(function () {
                var user = sessionStorage.getItem("id");
                if (user !== null && user !== undefined) {
                    var product_name = $(this).closest('.single-product-area').find('p').text();
                    var product_price = $(this).closest('.single-product-area').find('h6').text();
                    var user = sessionStorage.getItem("userid");
                    var data = {
                        'product_name': product_name,
                        'product_price': product_price,
                        'user_id': user
                    };

                    $.ajax({
                        url: 'AddToCart.php',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json',
                        data: JSON.stringify(data),
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Product Purchase',
                                text: response.message,
                            });
                        },
                        error: function (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Product Purchase',
                                text: error.error,
                            });
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Product Purchase',
                        text: 'Please login before purchasing our product.',
                        footer: '<a href="login.php">Click Here To Login</a>'

                    });
                }
            });
        });
    </script>
</body>

</html>