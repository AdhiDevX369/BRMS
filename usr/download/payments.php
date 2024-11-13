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
$sql = "SELECT p.payment_date, p.business_id, p.BR_Number, p.registration_fee, p.late_fee, p.total_amount, (p.registration_fee + p.late_fee) AS total_amount 
        FROM payments p";
$result = $conn->query($sql);

// Check for SQL query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}


echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item active">
                 <a class="nav-link" href="report.php">Monthly Report</a>
            </li>
        </ul>
       
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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
                            <th>Registration Fee (rs.250)</th>
                            <th>Late Fee rs.)</th>
                            <th>Total Amount (₹)</th>
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
                    <td>' . $row["business_id"] . '</td>
                    <td>' . $row["BR_Number"] . '</td>
                    <td>' . $registration_fee . '</td>
                    <td>' . $late_fee . '</td>
                    <td>' . $total_amount . '</td>
                    <td>' . $row["payment_date"] . '</td>
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
                <input type="hidden" name="html" value="' . htmlspecialchars($html, ENT_QUOTES) . '">
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
