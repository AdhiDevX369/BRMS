// fetch_business_data.php
<?php
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

// Get the data from the business table
$sql = "SELECT * FROM business";
$result = $conn->query($sql);

$businesses = [];

if ($result->num_rows > 0) {
    // Fetch data as an associative array
    while ($row = $result->fetch_assoc()) {
        $businesses[] = $row;
    }
}

// Close connection
$conn->close();

// Return the data in JSON format
echo json_encode($businesses);
?>
