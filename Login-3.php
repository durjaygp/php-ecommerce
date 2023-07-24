<?php
// Initialize the session
session_start();

// Check if the user is already logged in, redirect to the dashboard if logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: dashboard.php");
    exit();
}

// Include database configuration
$host = "localhost"; // Change this to your MySQL host
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "live_react"; // Change this to your database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$phone = $password = "";
$phone_err = $password_err = "";

// Process form data on submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if there are no errors in form data
    if (empty($phone_err) && empty($password_err)) {
        // Prepare a SELECT statement
        $sql = "SELECT id, phone, password FROM users WHERE phone = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_phone);

            // Set parameters
            $param_phone = $phone;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store the result
                $stmt->store_result();

                // Check if phone number exists and verify the password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $phone, $hashed_password);

                    if ($stmt->fetch()) {
                        if ($password === $hashed_password) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["phone"] = $phone;

                            // Redirect to the dashboard
                            header("Location: dashboard.php");
                            exit();
                        } else {
                            // Display an error message if the password is incorrect
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else {
                    // Display an error message if the phone number is not found
                    $phone_err = "No account found with that phone number.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <title>Login</title>
    <link rel="icon" href="img/flat/004-smart-tv.png">
    <style>
        body {
            background-image: url('bgimage/desk.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .bg-primary {
            background: #70c745cf !important;
        }

        canvas {
            pointer-events: none;
        }
    </style>
</head>

<body>


    <section class="testimonial py-5" id="testimonial">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 py-5 bg-primary text-white text-center ">
                    <div class=" ">
                        <div class="card-body">
                            <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                            <h2 class="py-3">Login</h2>
                            <p>This is the login page for the Garden Company. You will be able
                                to login with the account you have created in the registration Page
                                along with doing a Captcha for security purposes.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 border">
                    <div class="card">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required>
                                    <span class="text-danger"><?php echo $phone_err; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <span class="text-danger"><?php echo $password_err; ?></span>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
        <div class="container mt-2">
            <div class="alert alert-success" id="success-message" role="alert" style="display: none;"></div>
            <div class="alert alert-danger" id="error-message" role="alert" style="display: none;"></div>
        </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

</body>

</html>