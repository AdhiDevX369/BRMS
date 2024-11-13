<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "brms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $id = uniqid(); // Generate a unique ID for each message
    $fullName = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Prepare the SQL query to insert data into contact_messages table
    $sql = "INSERT INTO contact_messages (id, full_name, phone_number, email, message, submitted_at) 
            VALUES ('$id', '$fullName', '$phone', '$email', '$message', CURRENT_DATE())";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the contact page with a success message
        echo "<script>alert('Message sent successfully!'); window.location.href = 'contact.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
