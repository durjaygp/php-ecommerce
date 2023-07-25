<!DOCTYPE html>
<html>
<head>
    <title>AJAX Table Example</title>
</head>
<body>
    <h1>Products Table</h1>
    <label for="categorySelect">Select Category:</label>
    <select id="categorySelect" onchange="getBrandsByCategory()">
        <option value="">Select Category</option>
        <!-- Categories will be populated dynamically using AJAX -->
    </select>

    <label for="brandSelect">Select Brand:</label>
    <select id="brandSelect" onchange="getProductsByBrand()">
        <option value="">Select Brand</option>
        <!-- Brands will be populated dynamically using AJAX based on the selected category -->
    </select>

    <table id="productsTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody></tbody>
    </table>

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
            xhr.open("GET", "get_categories.php", true);
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
                xhr.open("GET", "get_brands.php?category_id=" + categoryId, true);
                xhr.send();
            }
        }

        // Function to fetch and populate the products table based on the selected brand
        function getProductsByBrand() {
            var brandSelect = document.getElementById("brandSelect");
            var brandId = brandSelect.value;
            // AJAX request to get products data by brand
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var products = JSON.parse(xhr.responseText);
                        var tableBody = document.querySelector("#productsTable tbody");
                        tableBody.innerHTML = ""; // Clear existing rows

                        // Populate the table with products data
                        products.forEach(function(product) {
                            var row = "<tr>" +
                                "<td>" + product.name + "</td>" +
                                "<td>" + product.product_price + "</td>" +
                                "</tr>";
                            tableBody.innerHTML += row;
                        });
                    } else {
                        console.error("Error: " + xhr.status);
                    }
                }
            };
            xhr.open("GET", "get_products.php?brand_id=" + brandId, true);
            xhr.send();
        }

        // Call the populateCategories function to load categories data on page load
        populateCategories();
    </script>
</body>
</html>
