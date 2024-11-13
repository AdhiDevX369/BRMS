<?php
// Start session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Change this if you have a password
$dbname = "brms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {
        // Check if the email or NIC already exists
        $checkUserQuery = $conn->prepare("SELECT * FROM users WHERE email = ? OR nic = ?");
        $checkUserQuery->bind_param("ss", $email, $nic);
        $checkUserQuery->execute();
        $checkResult = $checkUserQuery->get_result();
        
        if ($checkResult->num_rows > 0) {
            echo '<script>alert("Email or NIC already exists!");</script>';
        } else {
            // Prepare and bind the statement
            $stmt = $conn->prepare("INSERT INTO users (nic, name, address, email, password) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            // Bind parameters
            $stmt->bind_param("sssss", $nic, $name, $address, $email, $password); // No password hashing

            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>alert("Registration successful!"); window.location.href="login.php";</script>';
            } else {
                echo "Error: " . htmlspecialchars($stmt->error);
            }

            $stmt->close();
        }
        $checkUserQuery->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .bg-primary {
            background-color: #A0522D !important; /* Brown background for banner */
            color: #FFD700 !important; /* Yellow text */
        }
        .btn-custom {
            background-color: #A0522D; /* Brown background for button */
            border-color: #A0522D;
            color: #FFD700; /* Yellow text */
        }
        .btn-custom:hover {
            background-color: #8B4513; /* Darker brown on hover */
            border-color: #8B4513;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-plus"></i> BRMS User Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="nicInput">NIC</label>
                                <input type="text" class="form-control" id="nicInput" name="nic" placeholder="Enter your NIC" required pattern="^([0-9]{9}[vVxX]|[0-9]{12})$" title="NIC must be either 9 digits followed by a capital V or X, or 12 digits">
                            </div>
                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="addressInput">Address</label>
                                <textarea class="form-control" id="addressInput" name="address" placeholder="Enter your address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="emailInput">Email</label>
                                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordInput">Password</label>
                                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPasswordInput">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPassword" placeholder="Confirm your password" required>
                            </div>
                            <button type="submit" class="btn btn-custom btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Already have an account? <a href="login.php">Login now</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
