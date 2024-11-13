<?php
// Start the session
session_start();

// Database connection parameters
$servername = "localhost"; // Your database server
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "brms";           // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to update status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['NIC'];
    $statusMessage = $_POST['status_message'];

    // Prepare the SQL statement to update the status message
    $stmt = $conn->prepare("UPDATE businesses SET status_message = ? WHERE NIC = ?");
    $stmt->bind_param("ss", $statusMessage, $nic);

    if ($stmt->execute()) {
        echo "<script>alert('Status updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Fetch all businesses for display
$result = $conn->query("SELECT * FROM businesses");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Business Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .table {
            margin-top: 20px;
        }
        /* Custom styles for navigation bar */
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-item .nav-link {
            color: #fff !important;
        }
        .navbar-nav .nav-item .nav-link:hover {
            background-color: #138496;
            border-radius: 5px;
        }
    </style>
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
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="report.php">Monthly Report</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="viewPastDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <a href="change_password.php" class="btn btn-secondary btn-sm ml-3" aria-hidden="true">
                <i class="fas fa-cogs"></i> Change Password
            </a>
            <a href="logout.php" class="btn btn-danger btn-sm ml-2">Logout</a>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
        <h2>Update Business Status</h2>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIC</th>
                    <th>Business Name</th>
                    <th>Owner Name</th>
                    <th>Status Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                               <td>{$row['NIC']}</td>
                                <td>{$row['Business_Name']}</td>
                                <td>{$row['Owner_Name']}</td>
                                <td>{$row['status_message']}</td>
                                <td>
                                    <button class='btn btn-primary' data-toggle='modal' data-target='#statusModal' data-nic='{$row['NIC']}' data-status='{$row['status_message']}'>Update Status</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No business records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for updating status -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Business Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="statusForm" method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="NIC">NIC:</label>
                            <input type="text" class="form-control" id="NIC" name="NIC" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status_message">Status Message:</label>
                            <textarea class="form-control" id="status_message" name="status_message" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script to fill the modal with data
        $('#statusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var nic = button.data('nic'); // Extract NIC from data-* attributes
            var status = button.data('status'); // Extract status from data-* attributes

            var modal = $(this);
            modal.find('.modal-body #NIC').val(nic);
            modal.find('.modal-body #status_message').val(status);
        });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
