<?php include "header.php";?>

<div class="breadcrumb-area">
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center"
         style="background-image: url(bgimage/micro.jpg);">
        <h2>Ajax Products Search</h2>
    </div>

    <div class="container mt-30">
        <div class="card mt-10">
            <div class="card-header">
                <h3 class="text-center">Ajax Products Search</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="categorySelect" class="form-label">Select Category:</label>
                        <select id="categorySelect" onchange="getBrandsByCategory()" class="form-select">
                            <option value="">Select Category</option>
                            <!-- Categories will be populated dynamically using AJAX -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="brandSelect" class="form-label">Select Brand:</label>
                        <select id="brandSelect" onchange="getProductsByBrand()" class="form-select">
                            <option value="">Select Brand</option>
                            <!-- Brands will be populated dynamically using AJAX based on the selected category -->
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-12 mt-5">
        <div class="shop-products-area">
            <div class="row">
                <div id="print-here" class="d-flex">


                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>

<footer class="footer-area bg-img" style="background-image: url(bgimage/tv-bg.jpg);">
    <div class="main-footer-area">
        <div class="container">
            <div class="row">
                <div class="top-breadcrumb-area  d-flex align-items-center justify-content-center" <div
                    class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget">
                        <div class="footer-logo mb-30">
                            <a href="index.php"><h1 style="color: greenyellow;">Electronics Shop</h1></a>
                            <p>Welcome to our gardening company website! Our aim is to help you create a beautiful and thriving garden that you can enjoy all year round. Our website is designed to provide you with easy access to all the information and products you need to get started. When you first visit our website, you will see a drop-down menu at the top of the page with two items: Plants and Gardening. These options will help you navigate to the products you need. If you select Plants, you will be taken to a second drop-down menu that will show you a range of options to choose from, including Roses, Hedging, and Shrubs.</p>
                        </div>
                    </div>
                </div </div>
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
                            <script>document.write(new Date().getFullYear());</script> All rights reserved by Garden
                            Center

                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/plugins.js"></script>
<script src="js/active.js"></script>

<script>
    // Function to fetch and populate the category dropdown
    function populateCategories() {
        var categorySelect = $("#categorySelect");

        $.ajax({
            url: "ajax/get_categories.php",
            type: "GET",
            dataType: "json",
            success: function(categories) {
                $.each(categories, function(index, category) {
                    var option = $("<option>")
                        .text(category.name)
                        .val(category.id);
                    categorySelect.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status);
            }
        });
    }

    // Function to fetch and populate the brand dropdown based on the selected category
    function getBrandsByCategory() {
        var categorySelect = $("#categorySelect");
        var brandSelect = $("#brandSelect");
        var categoryId = categorySelect.val();
        brandSelect.html("<option value=''>Select Brand</option>");

        if (categoryId !== "") {
            $.ajax({
                url: "ajax/get_brands.php?category_id=" + categoryId,
                type: "GET",
                dataType: "json",
                success: function(brands) {
                    $.each(brands, function(index, brand) {
                        var option = $("<option>")
                            .text(brand.name)
                            .val(brand.id);
                        brandSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status);
                }
            });
        }
    }

    // Function to fetch and populate the products table based on the selected brand
    function getProductsByBrand() {
        var brandSelect = $("#brandSelect");
        var brandId = brandSelect.val();

        $.ajax({
            url: "ajax/get_products.php?brand_id=" + brandId,
            type: "GET",
            dataType: "json",
            success: function(productsData) {
                var printHereDiv = $("#print-here");
                printHereDiv.empty(); // Clear existing data

                $.each(productsData, function(index, product) {
                    var productDiv = $("<div>")
                        .addClass("col-4 col-sm-6 col-lg-4");

                    var productImgDiv = $("<div>")
                        .addClass("product-img shadow");

                    var productImgLink = $("<a>")
                        .attr("href", product.product_image); // Assuming your product data has an 'image_url' property

                    var productImg = $("<img>")
                        .attr("src", product.product_image); // Assuming your product data has an 'image_url' property

                    var productInfoDiv = $("<div>")
                        .addClass("product-info mt-15 text-center");

                    var productLink = $("<a>")
                        .attr("href", "#");

                    var productName = $("<h6>")
                        .text(product.name);

                    var productPrice = $("<p>")
                        .text("£" + product.product_price);

                    <!-- ... Your previous code ... -->

                    var orderButton = $("<button>")
                        .addClass("btn btn-primary")
                        .text("Order"); // Set the button text

                    function checkLoginStatus(){
                        usrid = '<?=$_SESSION['id'];?>';
                        // alert(usrid);
                        if (usrid=="")
                            return true;
                        else return false;
                    }

                    orderButton.on("click", function() {
                        // Check if the user is logged in
                        // You can use a global variable or a function to check the login status
                        var loggedin = checkLoginStatus(); // Assuming this function checks the login status

                        if (loggedin) {
                            // If the user is logged in, save the order data
                            saveOrderToDatabase(product.name, product.product_price);
                        } else {
                            // If the user is not logged in, redirect to the login page
                            window.location.href = "login.php"; // Replace "login.php" with your actual login page URL
                        }
                    });

                    function saveOrderToDatabase(productName, productPrice) {
                        var userPhone = prompt("Please enter your phone number:"); // Ask for user's phone number

                        // Perform an AJAX request to save the order data
                        $.ajax({
                            url: "ajax/save_order.php",
                            type: "POST",
                            data: {
                                product_name: productName,
                                product_price: productPrice,
                                user_phone: userPhone
                            },
                            success: function(response) {
                                alert("Order saved successfully!");
                            },
                            error: function(xhr, status, error) {
                                console.error("Error: " + status);
                            }
                        });
                    }



                    productImgLink.append(productImg);
                    productImgDiv.append(productImgLink);
                    productLink.append(productName, productPrice);
                    productInfoDiv.append(productLink, orderButton);
                    productDiv.append(productImgDiv, productInfoDiv);

                    printHereDiv.append(productDiv);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status);
            }
        });
    }

    // Call the populateCategories function to load categories data on page load
    $(document).ready(function() {
        populateCategories();
    });
</script>


</body>

</html>