<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "brms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages
$sql = "SELECT id, full_name, phone_number, email, message, submitted_at FROM contact_messages";
$result = $conn->query($sql);

if (!$result) {
    // Query failed, handle the error
    die("Error fetching messages: " . $conn->error);
}

// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply'])) {
    $replyMessage = $conn->real_escape_string($_POST['replyMessage']);
    $messageId = intval($_POST['messageId']);
    
    // Insert the reply into a replies table (ensure this table exists)
    $insertSql = "INSERT INTO replies (message_id, reply_message, replied_at) VALUES ($messageId, '$replyMessage', NOW())";
    if (!$conn->query($insertSql)) {
        die("Error inserting reply: " . $conn->error);
    } else {
        echo "<script>alert('Reply sent successfully!');</script>";
    }
}
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
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 1000px;
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        thead th {
            background-color: #495057;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            padding: 12px 15px;
        }
        tbody tr:nth-child(even) {
            background-color: #f9fbfd;
        }
        tbody tr:hover {
            background-color: #e9ecef;
            transition: 0.3s ease;
        }
        tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #495057;
        }
        .no-messages {
            text-align: center;
            color: #dc3545;
            font-weight: bold;
            padding: 20px;
        }
        .btn-primary {
            background-color: #17a2b8;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #138496;
        }
        .reply-form {
            margin-top: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group textarea {
            resize: none;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        /* Navigation Bar Styles */
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

    <!-- Content Section -->
    <div class="container">
        <h1>Messages</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['submitted_at']}</td>
                            <td>
                                <button class='btn btn-primary' data-toggle='collapse' data-target='#replyForm{$row['id']}'>Reply</button>
                                <div id='replyForm{$row['id']}' class='collapse reply-form'>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='messageId' value='{$row['id']}'>
                                        <div class='form-group'>
                                            <textarea class='form-control' name='replyMessage' rows='3' required placeholder='Type your reply here...'></textarea>
                                        </div>
                                        <button type='submit' class='btn btn-success' name='reply'>Send Reply</button>
                                    </form>
                                </div>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='no-messages'>No messages found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (required for responsive navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
