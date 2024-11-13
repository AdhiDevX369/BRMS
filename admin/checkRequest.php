<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch business details
$sql = "SELECT GN_div, Business_Name, NIC, Owner_Name, Nature_Of_Business, Business_type, Start_date FROM businesses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- Brand Name -->
        <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>

        <!-- Button to Add New Business -->
        <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>

        <!-- Navbar Toggle Button for Mobile Devices -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>

                <!-- Monthly Report Link (Active) -->
                <li class="nav-item active">
                    <a class="nav-link" href="report.php">Monthly Report</a>
                </li>

                <!-- View Past Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="viewPastDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View Past
                    </a>
                    <div class="dropdown-menu" aria-labelledby="viewPastDropdown">
                        <a class="dropdown-item" href="deleted_businesses.php">Deleted Businesses</a>
                        <a class="dropdown-item" href="edited_businesses.php">Edited Businesses</a>
                    </div>
                </li>

                <!-- Admin Request Link -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_request.php">Admin Request</a>
                </li>
            </ul>

            <!-- Change Password Icon -->
            <a href="change_password.php" class="btn btn-secondary btn-sm ml-3" aria-hidden="true">
                <i class="fas fa-cogs"></i> Change Password
            </a>

            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-danger btn-sm ml-2">Logout</a>
        </div>
    </nav>
<div class="container mt-4">
    <h2>Business Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>GN Division</th>
                <th>Business Name</th>
                <th>NIC</th>
                <th>Owner Name</th>
                <th>Nature of Business</th>
                <th>Type of Business</th>
                <th>Start Date</th>
                <th>Registration Fee (Rs. 250)</th>
                <th>Months Late</th>
                <th>Late Fee (Rs. 80/month)</th>
                <th>Total Fee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $nic = htmlspecialchars($row['NIC']);
                    echo "<tr>
                            <td>{$row['GN_div']}</td>
                            <td>{$row['Business_Name']}</td>
                            <td>{$nic}</td>
                            <td>{$row['Owner_Name']}</td>
                            <td>{$row['Nature_Of_Business']}</td>
                            <td>{$row['Business_type']}</td>
                            <td>{$row['Start_date']}</td>
                            <td>250</td>
                            <td>
                                <input type='number' class='form-control' id='monthsLate{$nic}' onchange='updateFees(\"{$nic}\")' min='0' value='0'>
                            </td>
                            <td id='lateFee{$nic}'>0</td>
                            <td id='totalFee{$nic}'>250</td>
                            <td><button class='btn btn-primary' onclick='addPayment(\"{$nic}\")'>Add Payment</button></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No business details found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function updateFees(nic) {
        const monthsLate = parseInt(document.getElementById(`monthsLate${nic}`).value) || 0;
        const lateFee = monthsLate * 80;
        const totalFee = 250 + lateFee;

        document.getElementById(`lateFee${nic}`).innerText = lateFee;
        document.getElementById(`totalFee${nic}`).innerText = totalFee;
    }

    function addPayment(nic) {
        // Implement the payment addition logic here, possibly an AJAX request to your backend
        alert(`Payment details for NIC: ${nic} will be processed.`);
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
