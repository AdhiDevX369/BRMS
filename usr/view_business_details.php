<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["nic"])) {
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost"; // replace with your DB host
$username = "root"; // replace with your DB username
$password = ""; // replace with your DB password
$dbname = "brms"; // replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$message = '';
$businessDetails = [];

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nic'])) {
    $nic = $_GET['nic'];
  // Prepare the SQL query to fetch business details by NIC
$sql = "SELECT application_id, business_name, nic, GN_div, status, update_time FROM businesses WHERE NIC = ?";
$stmt = $conn->prepare($sql);

// Check if the SQL was prepared correctly
if ($stmt === false) {
    $message = "Error preparing the SQL query: " . $conn->error;
} else {
    // Bind the parameter and execute
    $stmt->bind_param("s", $nic); // 's' means we are expecting a string (for NIC)
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a business is found
    if ($result->num_rows > 0) {
        $businessDetails = $result->fetch_assoc(); // Fetch the result as an associative array
    } else {
        $message = 'No business found for this NIC.';
    }

    // Close the statement
    $stmt->close();
}

}


// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .navbar-dark.bg-primary {
            background-color: #A0522D !important;
        }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #FFD700 !important;
        }
        .btn-custom, .btn-info, .btn-warning, .btn-danger {
            background-color: #A0522D !important;
            border-color: #A0522D !important;
            color: #FFD700 !important;
        }
        .btn-custom:hover {
            background-color: #8B4513 !important;
            border-color: #8B4513 !important;
        }
        .card-header.bg-primary {
            background-color: #A0522D !important;
            color: #FFD700 !important;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
        }
        .slide {
            display: none; /* Hide slides by default */
        }
        img {
            width: 100%; /* Responsive images */
            height: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="usrdashboard.php">Dashboard</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="request_admin.php">Request Admin</a>
            </li>
            <form method="GET" action="view_business_details.php" class="form-inline ml-3">
    <input type="text" name="nic" class="form-control mr-2" placeholder="Search by your NIC" required>
    <button type="submit" class="btn btn-info">Check Status</button>
</form>
        </ul>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>


<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Business Details</h4>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-info mt-3">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($businessDetails)): ?>
                        <div class="result alert alert-success mt-3">
                            <p><strong>Business Name:</strong> <?php echo htmlspecialchars($businessDetails['business_name']); ?></p>
                            <p><strong>NIC:</strong> <?php echo htmlspecialchars($businessDetails['nic']); ?></p>
                            <p><strong>Division:</strong> <?php echo htmlspecialchars($businessDetails['GN_div']); ?></p>
                            <p><strong>Status:</strong> <?php echo htmlspecialchars($businessDetails['status']); ?></p>
                            <p><strong>Last Update:</strong> <?php echo htmlspecialchars($businessDetails['update_time']); ?></p>
                            <button onclick="window.print();" class="btn btn-danger">Print Details</button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nic">Search by NIC:</label>
                            <input type="text" name="nic" class="form-control" placeholder="Enter your NIC" required>
                        </div>
                        <button type="submit" class="btn btn-info">Check Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
