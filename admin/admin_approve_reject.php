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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['nic'])) {
    $nic = $_POST['nic'];
    $action = $_POST['action']; // "accept" or "reject"

    // Update the status in the admin_request table
    if ($action == 'accept') {
        // Update request status to approved
        $sql_update_status = "UPDATE admin_request SET status = 'approved' WHERE nic = ?";
        
        if ($stmt = $conn->prepare($sql_update_status)) {
            $stmt->bind_param("s", $nic);
            if ($stmt->execute()) {
                // Fetch approved admin NIC and password
                $sql_get_admin = "SELECT nic, password FROM admin_request WHERE nic = ?";
                if ($stmt_get = $conn->prepare($sql_get_admin)) {
                    $stmt_get->bind_param("s", $nic);
                    $stmt_get->execute();
                    $result = $stmt_get->get_result();
                    if ($result->num_rows == 1) {
                        $admin = $result->fetch_assoc();
                        
                        // Insert into brms database admin table
                        $default_role = 'admin'; // You can change the role as needed
                        $sql_insert_admin = "INSERT INTO admin (nic, password, role) VALUES (?, ?, ?)";
                        if ($stmt_insert = $conn->prepare($sql_insert_admin)) {
                            $stmt_insert->bind_param("sss", $admin['nic'], $admin['password'], $default_role);
                            if ($stmt_insert->execute()) {
                                $message = "Admin request accepted and added to system successfully!";
                            } else {
                                $message = "Error: Could not add admin to system.";
                            }
                            $stmt_insert->close();
                        }
                    }
                    $stmt_get->close();
                }
            } else {
                $message = "Error: Could not update request status.";
            }
            $stmt->close();
        }
    } elseif ($action == 'reject') {
        // Reject request
        $sql = "UPDATE admin_request SET status = 'rejected' WHERE nic = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $nic);
            if ($stmt->execute()) {
                $message = "Admin request has been rejected successfully!";
            } else {
                $message = "Error: Unable to reject the request.";
            }
            $stmt->close();
        }
    }
}

// Redirect back to the main admin request page with message
$_SESSION['message'] = $message;
header("Location: admin_request.php");
exit();
?>
