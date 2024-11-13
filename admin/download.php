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

// Organize documents by category
$categorizedDocuments = [
    'Forms' => [],
    'Circulars' => [],
    'Indeed Documents' => [],
    'Special Requirements' => []
];

foreach ($documents as $document) {
    $categorizedDocuments[$document['category']][] = $document;
}
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
        </ul>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h1>Download Business Registration Documents</h1>

    <?php foreach ($categorizedDocuments as $category => $docs): ?>
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h2><?php echo htmlspecialchars($category); ?></h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php if (!empty($docs)): ?>
                        <?php foreach ($docs as $document): ?>
                            <li class="list-group-item">
                                <a href="path/to/documents/<?php echo htmlspecialchars($document['file_name']); ?>">
                                    <?php echo htmlspecialchars($document['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">No documents available in this category.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
