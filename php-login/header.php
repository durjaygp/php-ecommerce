<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Website</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <!-- Add other navigation links here -->
                <?php if (isset($_SESSION['id'])) { ?>
                    <!-- Show the user's data in the header menu -->
                    <li>Welcome, <?php echo $_SESSION['name']; ?></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
</body>
</html>
