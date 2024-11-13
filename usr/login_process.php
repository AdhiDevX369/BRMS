<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "brms";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get input data
    $nic = $_POST["nic"];
    $password = $_POST["password"];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE nic = ?");
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Fetch the hashed password and role
        $stmt->bind_result($hashed_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Login successful
            $_SESSION['username'] = $nic;
            $_SESSION['role'] = $role; // Store role in session

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin_dashboard.php"); // Admin dashboard
            } else {
                header("Location: user_dashboard.php"); // User dashboard
            }
            exit();
        } else {
            // Invalid password
            echo '<div class="error-message">';
            echo 'Invalid username or password. <br>';
            echo '<a href="login.php" class="try-again-button">Try Again</a>';
            echo '</div>';
        }
    } else {
        // Invalid username
        echo '<div class="error-message">';
        echo 'Invalid username or password. <br>';
        echo '<a href="login.php" class="try-again-button">Try Again</a>';
        echo '</div>';
    }

    $stmt->close();
    $conn->close();
}
?>
