<?php
session_start(); // Start the session to access session variables

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "brms"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Assuming you have the admin ID stored in session
    $admin_id = $_SESSION['admin_id'];

    // Fetch the current password from the database
    $stmt = $conn->prepare("SELECT password FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the current password
        if (password_verify($current_password, $row['password'])) {
            // Check if new password matches confirm password
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_stmt = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_new_password, $admin_id);
                if ($update_stmt->execute()) {
                    echo "Password changed successfully.";
                } else {
                    echo "Error updating password.";
                }
                $update_stmt->close();
            } else {
                echo "New password and confirmation do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "Admin not found.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> <!-- Add your custom CSS file -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .navbar {
            margin-bottom: 20px;
        }
        
        .card {
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        
        .form-control {
            border-radius: 25px;
        }
        
        .btn-primary {
            width: 100%;
            border-radius: 25px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
        <a href="NewBusinessRegistration.php" class="btn btn-info">Add New Business</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item active"><a class="nav-link" href="report.php">Monthly Report</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="viewPastDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">View Past</a>
                    <div class="dropdown-menu" aria-labelledby="viewPastDropdown">
                        <a class="dropdown-item" href="deleted_businesses.php">Deleted Businesses</a>
                        <a class="dropdown-item" href="edited_businesses.php">Edited Businesses</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="admin_request.php">Admin Request</a></li>
            </ul>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Change Password Form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-lock"></i> Change Your Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="change_password.php" method="POST">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> BRMS. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
