<?php
// Database configuration
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

// Check if the ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete the record
    $deleteSql = "DELETE FROM businesses WHERE id='$id'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Business deleted successfully.";
        header("Location: index.php"); // Redirect back to list
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID parameter provided.";
}

// Close connection
$conn->close();
?>
