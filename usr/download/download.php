<?php
session_start();

// Database connection
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

// Fetch documents
$sql = "SELECT * FROM documents"; // Ensure 'documents' is the correct table name
$result = $conn->query($sql);

$documents = [];
if ($result) { // Check if $result is not false
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $documents[] = $row;
        }
    } else {
        // Optionally handle the case where no documents are found
        echo "No documents found.";
    }
} else {
    // Handle the error, e.g., log it or display a message
    error_log("Query failed: " . $conn->error);
    echo "Could not retrieve documents.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Business Registration Documents</title>
    <link rel="stylesheet" href="styles.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="BRMS/NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="BRMS/dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item active">
                 <a class="nav-link" href="BRMS/report.php">Monthly Report</a>
            </li>
        </ul>
        <a href="BRMS/logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <h1>Download Business Registration Documents</h1>
    <div class="year-section">
        <h2>Available Documents</h2>
        <ul id="document-list">
            <?php if (!empty($documents)): ?>
                <?php foreach ($documents as $document): ?>
                    <li>
                        <a href="path/to/documents/<?php echo htmlspecialchars($document['file_name']); ?>">
                            <?php echo htmlspecialchars($document['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No documents available for download.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script src="script.js"></script>
<!-- Include Bootstrap JS (optional, if using Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
