<?php
// Start session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the index page
header("Location: /BRMS/index.php");
exit();
?>