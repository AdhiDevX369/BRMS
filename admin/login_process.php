<?php
// Database connection
require_once '../admin.conf.php';

// Start session
session_start();

// Define a variable to hold error message
$error_message = "";

// Get user input from the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize inputs
    $nic = $_POST['nic'];
    $password = $_POST['password'];

    // Prepared statement to check admin credentials
    $sql = "SELECT * FROM admin WHERE NIC = ? AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password using secure hash comparison
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['nic'] = $row['nic'];
            $_SESSION['role'] = $row['role'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid credentials";
            header("Location: login.php?error=" . urlencode($error_message));
            exit();
        }
    } else {
        $error_message = "Invalid credentials";
        header("Location: login.php?error=" . urlencode($error_message));
        exit();
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 400px;
            margin-top: 50px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary">Admin Login</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger mt-3">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nic">NIC:</label>
                <input type="text" class="form-control" id="nic" name="nic" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="text-center mt-3">
            <a href="logout.php">Not an admin? Use the User login</a>
        </p>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
