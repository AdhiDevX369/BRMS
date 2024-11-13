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
        header("Location: usrdashboard.php"); 
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
    <title>Divisional Secretariat - Udapalatha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .bg-primary {
            background-color: brown !important; 
            border-bottom: 5px solid #A0522D; /* Brown bottom border */
            color: #FFD700 !important; /* Yellow text */
        }
        .btn-custom {
            background-color: brown; 
            color: #FFD700; /* Yellow text */
        }
        .btn-custom:hover {
            background-color: #8B4513; /* Darker brown on hover */
            border-color: #8B4513;
        }
        .register-link {
            color: #A0522D; /* Brown color for Register link */
        }
        .register-link:hover {
            color: #FFD700; /* Yellow on hover */
		
        }
	
		 .footer-links {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: yellow;
            color: #fff;
            margin-top: 20px;
        }

        .footer-links a {
            color: black;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <img src="images/logo.png" alt="Divisional Secretariat - Udapalatha Logo" width="6%">
        <h1 class="my-3">Divisional Secretariat - Udapalatha</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
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
                            <button type="submit" class="btn btn-custom btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-left">
                        Don't have an account? <a href="register.php" class="register-link">Register</a>
       <div class="footer-links">
    <form action="redirect_home.php" method="post">
        <button type="submit" class="btn btn-link"><i class="fas fa-home"></i> Home</button>
    </form>
    <a href="forgot_password.php"><i class="fas fa-key"></i> Forgot Password?</a>
</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

