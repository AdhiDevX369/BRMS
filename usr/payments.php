<?php
// Database configuration
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "brms"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch payment details
$sql = "SELECT p.payment_date, p.business_id, p.BR_Number, p.registration_fee, p.late_fee, 
        (p.registration_fee + p.late_fee) AS total_amount 
        FROM payments p";
$result = $conn->query($sql);

// Check for SQL query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

echo '
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
    <h2 class="text-center mb-4">Payment Details</h2>';

// Check if there are results
if ($result->num_rows > 0) {
    // Prepare HTML for the table with Bootstrap classes
    $html = '<div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Business ID</th>
                            <th>BR Number</th>
                            <th>Registration Fee (Rs. 250)</th>
                            <th>Late Fee (Rs.)</th>
                            <th>Total Amount (Rs.)</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Fetch and display each row
    while ($row = $result->fetch_assoc()) {
        $registration_fee = 250; // Fixed registration fee
        $late_fee = $row["late_fee"];
        $total_amount = $registration_fee + $late_fee; // Calculate total amount

        $html .= '<tr>
                    <td>' . htmlspecialchars($row["business_id"]) . '</td>
                    <td>' . htmlspecialchars($row["BR_Number"]) . '</td>
                    <td>' . htmlspecialchars($registration_fee) . '</td>
                    <td>' . htmlspecialchars($late_fee) . '</td>
                    <td>' . htmlspecialchars($total_amount) . '</td>
                    <td>' . htmlspecialchars($row["payment_date"]) . '</td>
                  </tr>';
    }

    $html .= '</tbody>
            </table>
        </div>';

    echo $html;

    // Print and Download buttons with Bootstrap styling
    echo '<div class="text-center">
            <button class="btn btn-primary mr-2" onclick="window.print()">Print Bill</button>
            <form method="post" action="generate_pdf.php" style="display:inline;">
                <input type="hidden" name="html" value="' . htmlspecialchars($html, ENT_QUOTES, 'UTF-8') . '">
                <input type="submit" class="btn btn-success" value="Download PDF">
            </form>
          </div>';
} else {
    echo '<div class="alert alert-warning text-center">No payment details found.</div>';
}

// Close connection
$conn->close();

echo '</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>';
?>
