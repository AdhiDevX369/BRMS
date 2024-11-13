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
    $position = $_POST['position'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (nic, name, address, email, position, password) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bind_param("ssssss", $nic, $name, $address, $email, $position, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Registration successful!"); window.location.href="login.php";</script>';
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
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
                                <label for="positionInput">Position</label>
                                <select class="form-control" id="positionInput" name="position" required>
                                    <option value="">Select a position</option>
                                    <option value="Divisional Secretariat">Divisional Secretariat</option>
                                    <option value="Additional Divisional Secretariat">Additional Divisional Secretariat</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Administration Officer">Administration Officer</option>
                                    <option value="IT Staff">IT Officer</option>
                                    <option value="Subject Officer">Subject Officer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="passwordInput">Password</label>
                                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPasswordInput">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPassword" placeholder="Confirm your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
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
