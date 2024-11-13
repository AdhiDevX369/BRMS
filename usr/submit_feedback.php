<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Adjust this if different
$password = ""; // Adjust this if different
$dbname = "brms"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data has been posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs and validate them
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = (int) $_POST['rating'];
    $comments = $conn->real_escape_string($_POST['comments']);

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO tms_feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $comments);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Thank you for your feedback!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>
