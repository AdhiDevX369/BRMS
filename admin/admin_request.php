<?php
// Start session
session_start();

// Database connection
$servername = "localhost"; // Change if necessary
$username = "root";
$password = "";
$dbname = "brms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$message = '';

// Handle accept or reject
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $nic = $_POST['nic'];
    $action = $_POST['action']; // "accept" or "reject"

    if ($action == 'accept') {
        $sql = "UPDATE admin_request SET status = 'approved' WHERE nic = ?";
    } else if ($action == 'reject') {
        $sql = "UPDATE admin_request SET status = 'rejected' WHERE nic = ?";
    }

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nic);
        if ($stmt->execute()) {
            $message = "Request has been " . htmlspecialchars($action) . "ed successfully!";
        } else {
            $message = "Error: Unable to process the request.";
        }
        $stmt->close(); // Close the statement after execution
    }
}

// Fetch all pending admin requests
$sql = "SELECT * FROM admin_request WHERE status = 'pending'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: Could not fetch pending requests. " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Mangement System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
		
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a> &nbsp; &nbsp; &nbsp; &nbsp;
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
           <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="viewPastDropdown" role="button" 
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        View Past
    </a>
    <div class="dropdown-menu" aria-labelledby="viewPastDropdown">
        <a class="dropdown-item" href="deleted_businesses.php">Deleted Businesses</a>
        <a class="dropdown-item" href="edited_businesses.php">Edited Businesses</a>
    </div>
</li>

      
			<li class="nav-item">
				
			<a class="nav-link" href="admin_request.php">Admin Request</a>

			</li>
	  </ul>

        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>

    </div>
</nav>

<div class="container mt-5">
    <h3 class="text-center">Pending Admin Access Requests</h3>

    <?php if ($message): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>NIC</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td><?php echo htmlspecialchars($row['nic']); ?></td>
                        <td><?php echo htmlspecialchars($row['designation']); ?></td>
                        <td>
                            <form method="POST" action="admin_approve_reject.php">
                                <input type="hidden" name="nic" value="<?php echo htmlspecialchars($row['nic']); ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                                <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No pending requests</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
