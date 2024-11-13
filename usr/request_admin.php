<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["nic"])) {
    header("Location: login.php");
    exit();
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];


    // Database connection
    $servername = "localhost";
    $username = "root"; 
    $password_db = ""; 
    $dbname = "brms";
    
    $conn = new mysqli($servername, $username, $password_db, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO admin_request (full_name, dob, nic, designation, password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $fullName, $dob, $nic, $designation, $password);
        if ($stmt->execute()) {
            $message = "Admin request has been submitted successfully for $fullName with NIC $nic!";
        } else {
            $message = "Error submitting request: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Request Admin Access</h4>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-success">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="request_admin.php" method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="nic">NIC</label>
                            <input type="text" class="form-control" id="nic" name="nic" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="designation" name="designation" required>
                                <option value="Divisional Secretariat">Divisional Secretariat</option>
                                <option value="Assistant Divisional Secretariat">Assistant Divisional Secretariat</option>
                                <option value="Administration Officer">Administration Officer</option>
                                <option value="Subject Officer">Subject Officer</option>
                                <option value="IT Officer">IT Officer</option>
                            </select>
                        </div>
						 <div class="form-group">
                            <label for="password">password</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-custom btn-block">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
