<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+YVgSnuC1MEv1Gv9Wqu7XuX4Fq3AZrjwvCthWUm6V9ddaz" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1 class="mb-4">Login</h1>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div id="message" class="mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-4K5FYy4nfwNC6qE/Z8r+qFKn/d9Op6Cyt/zl2mszzqAj1JRLStAXewgKtQ5fwwqF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault(); // Prevent form submission and page reload

                var phone = $("#phone").val();
                var password = $("#password").val();

                // Send AJAX request to the login process PHP script
                $.ajax({
                    url: "login_process.php",
                    type: "POST",
                    data: {
                        phone: phone,
                        password: password
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            // If login is successful, redirect to the product page
                            window.location.href = "ajax.php";
                        } else {
                            // If login fails, display an error message
                            $("#message").text("Invalid phone number or password.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + status);
                        // Display an error message
                        $("#message").text("An error occurred. Please try again later.");
                    }
                });
            });
        });
    </script>
</body>
</html>
