<?php
// Database connection
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

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the 'nic' key is set in the POST array
    if (isset($_POST['nic'])) {
        $nic = $_POST['nic']; // Get the NIC from form input

        // Validate NIC (you can customize this validation based on your requirements)
        if (empty($nic)) {
            echo "<div class='result alert alert-danger'>Please enter your NIC.</div>";
        } else {
            // Prepare the SQL query
            $sql = "SELECT application_id, business_name, status, update_time FROM businesses WHERE NIC = ?";
            $stmt = $conn->prepare($sql);

            // Check if the SQL was prepared correctly
            if ($stmt === false) {
                echo "<div class='result alert alert-danger'>Error preparing the SQL query: " . $conn->error . "</div>";
            } else {
                // Bind the parameter and execute
                $stmt->bind_param("s", $nic); // 's' means we are expecting a string (for NIC)
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if a business is found
                if ($result->num_rows > 0) {
                    $business = $result->fetch_assoc(); // Fetch the result as an associative array
                    echo "<div class='result alert alert-success'>";
                    echo "<p>Application ID: " . $business['application_id'] . "</p>";
                    echo "<p>Business Name: " . $business['business_name'] . "</p>";
                    echo "<p>Status: " . $business['status'] . "</p>";
                    echo "<p>Last Update: " . $business['update_time'] . "</p>";
                    echo "</div>";
                } else {
                    echo "<div class='result alert alert-warning'>No business found with the given NIC.</div>";
                }

                // Close the statement
                $stmt->close();
            }
        }
    } else {
        echo "<div class='result alert alert-danger'>NIC not provided. Please try again.</div>";
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
    <h2>Check Business Registration Status</h2>
    <form method="POST" action="" class="form-inline">
        <input type="text" name="nic" class="form-control mr-2" placeholder="Search by your NIC" required>
        <button type="submit" class="btn btn-info">Check Status</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
