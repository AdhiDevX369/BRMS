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
        echo "No documents found.";
    }
} else {
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
    <title>Business Registration Documents</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-dark.bg-primary {
            background-color: #A0522D !important; /* Brown for navigation bar */
        }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #FFD700 !important; /* Yellow for text */
        }
        .btn-custom {
            background-color: #A0522D; /* Brown buttons */
            border-color: #A0522D;
            color: #FFD700; /* Yellow text */
        }
        .btn-custom:hover {
            background-color: #8B4513; /* Darker brown on hover */
            border-color: #8B4513;
        }
        .btn-info, .btn-warning, .btn-danger {
            background-color: #A0522D !important; /* Brown color for all buttons */
            border-color: #A0522D !important;
            color: #FFD700 !important; /* Yellow text */
        }
        .card-header.bg-info {
            background-color: #A0522D !important; /* Brown for card headers */
            color: #FFD700 !important; /* Yellow text */
        }
    </style>
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
                <a class="nav-link" href="usrdashboard.php">Dashboard</a>
            </li>
            <form method="GET" action="search_results.php" class="form-inline mb-3">
                <div class="input-group">
                    <input type="text" name="nic" class="form-control" placeholder="Search by your NIC" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </ul>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h1>Download Business Registration Documents</h1>

    <button class="btn btn-custom mb-4" onclick="printDocuments()">Print Document List</button>

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
                                <a href="path/to/documents/<?php echo htmlspecialchars($document['file_name']); ?>" target="_blank">
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

<script>
    function printDocuments() {
        var printContent = document.querySelector('.container').innerHTML;
        var newWin = window.open('', '_blank');
        newWin.document.write(`
            <html>
                <head>
                    <title>Document List</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        body { font-family: Arial, sans-serif; }
                        h1, h2 { text-align: center; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Business Registration Documents</h1>
                        ${printContent}
                    </div>
                </body>
            </html>
        `);
        newWin.document.close();
        newWin.print();
        newWin.close();
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
