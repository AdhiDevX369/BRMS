<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <li class="nav-item">
                <a class="nav-link" href="deleted_businesses.php">Deleted Businesses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edited_businesses.php">Edited Businesses</a>
            </li>
        </ul>
        <a href="login.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Registered Businesses</h2>

    <!-- Search Form -->
    <form method="GET" action="" class="mb-4">
        <div class="row">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control" placeholder="Search by BR Number, Business Name, or Owner Name" 
                value="<?php if (isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <?php
    // Database configuration
    $servername = "localhost"; // Your server name
    $username = "root"; 
    $password = ""; 
    $dbname = "brms";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize search query
    $searchQuery = '';
    $result = null;

    // Prepared statement for searching
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = '%' . $conn->real_escape_string($_GET['search']) . '%';
        $stmt = $conn->prepare("SELECT BR_Number, Business_name, owner_name, Start_date, others FROM businesses WHERE BR_Number LIKE ? OR Business_name LIKE ? OR owner_name LIKE ?");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // SQL query to fetch registered businesses without search
        $sql = "SELECT BR_Number, Business_name, owner_name, Start_date, others FROM businesses";
        $result = $conn->query($sql);
    }

    // Check if query was successful
    if ($result === false) {
        die("SQL error: " . $conn->error);
    }

    // Check if there are results
    if ($result->num_rows > 0) {
        // Output data in table format with Bootstrap classes
        echo "<table class='table table-bordered table-hover'>
                <thead class='table-dark'>
                    <tr>
                        <th>BR Number</th>
                        <th>Business Name</th>
                        <th>Owner Name</th>
                        <th>Start Date</th>
                        <th>Others</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        // Fetch and display each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["BR_Number"]) . "</td>
                    <td>" . htmlspecialchars($row["Business_name"]) . "</td>
                    <td>" . htmlspecialchars($row["owner_name"]) . "</td>
                    <td>" . htmlspecialchars($row["Start_date"]) . "</td>
                    <td>" . htmlspecialchars($row["others"]) . "</td>
                    <td>
                        <a href='edit_business.php?BR_Number=" . urlencode($row["BR_Number"]) . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_business.php?BR_Number=" . urlencode($row["BR_Number"]) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this business?');\">Delete</a>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-info text-center'>No registered businesses found.</div>";
    }

    // Close connection
    $conn->close();
    ?>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
