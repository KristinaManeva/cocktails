<?php
// Start the session
session_start();

// Destroy session and clear session variables
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>
