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

<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/plugins.js"></script>
<script src="js/active.js"></script>
<script>
    // Function to fetch and populate the category dropdown
    function populateCategories() {
        var categorySelect = document.getElementById("categorySelect");
        // AJAX request to get categories data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var categories = JSON.parse(xhr.responseText);
                    categories.forEach(function(category) {
                        var option = document.createElement("option");
                        option.text = category.name;
                        option.value = category.id;
                        categorySelect.add(option);
                    });
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.open("GET", "ajax/get_categories.php", true);
        xhr.send();
    }

    // Function to fetch and populate the brand dropdown based on the selected category
    function getBrandsByCategory() {
        var categorySelect = document.getElementById("categorySelect");
        var brandSelect = document.getElementById("brandSelect");
        var categoryId = categorySelect.value;
        // Clear existing brands
        brandSelect.innerHTML = "<option value=''>Select Brand</option>";

        if (categoryId !== "") {
            // AJAX request to get brands data by category
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var brands = JSON.parse(xhr.responseText);
                        brands.forEach(function(brand) {
                            var option = document.createElement("option");
                            option.text = brand.name;
                            option.value = brand.id;
                            brandSelect.add(option);
                        });
                    } else {
                        console.error("Error: " + xhr.status);
                    }
                }
            };
            xhr.open("GET", "ajax/get_brands.php?category_id=" + categoryId, true);
            xhr.send();
        }
    }

    // Function to fetch and populate the products table based on the selected brand


    function getProductsByBrand() {
        var brandSelect = document.getElementById("brandSelect");
        var brandId = brandSelect.value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var productsData = JSON.parse(xhr.responseText);
                    var printHereDiv = document.getElementById("print-here");
                    printHereDiv.innerHTML = ""; // Clear existing data

                    // Loop through productsData and print each product
                    productsData.forEach(function (product) {
                        var productDiv = document.createElement("div");
                        productDiv.classList.add("col-4", "col-sm-6", "col-lg-4");

                        var productImgDiv = document.createElement("div");
                        productImgDiv.classList.add("product-img", "shadow");

                        var productImgLink = document.createElement("a");
                        var productImg = document.createElement("img");
                        productImg.src = product.product_image; // Assuming your product data has an 'image_url' property

                        var productInfoDiv = document.createElement("div");
                        productInfoDiv.classList.add("product-info", "mt-15", "text-center");

                        var productLink = document.createElement("a");
                        var productName = document.createElement("h6");
                        productName.textContent = product.name;
                        var productPrice = document.createElement("p");
                        productPrice.textContent = "£" + product.product_price;

                        productImgLink.appendChild(productImg);
                        productImgDiv.appendChild(productImgLink);
                        productInfoDiv.appendChild(productLink);
                        productLink.appendChild(productName);
                        productLink.appendChild(productPrice);
                        productDiv.appendChild(productImgDiv);
                        productDiv.appendChild(productInfoDiv);

                        printHereDiv.appendChild(productDiv);
                    });
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.open("GET", "ajax/get_products.php?brand_id=" + brandId, true);
        xhr.send();
    }

    // Call the populateCategories function to load categories data on page load
    populateCategories();
</script>


</body>
</html>