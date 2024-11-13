<?php
session_start(); 

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "brms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    $password = $_POST['password'];

    // Query to check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE nic = ? AND password = ?");
    $stmt->bind_param("ss", $nic, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, set session variables
        $_SESSION['nic'] = $nic;
        header("Location: dashboard.php"); 
        exit();
    } else {
        $error = "Invalid NIC or password.";
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
    <title>Divisional Secretariat Udapalatha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <img align="right" src="images/logo.png" alt="brms" width="5%"> <br>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-lock"></i> Welcome To Business Registration Management System</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="nic">NIC</label>
                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter your NIC" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-left">
                        Don't have an account? <a href="register.php">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
