<?php
// Clear all session data (log out the user)
session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit();
?>
