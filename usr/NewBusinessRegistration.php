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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $gnDivision = $_POST['GN_div'];
    $businessName = $_POST['Business_Name'];
    $natureOfBusiness = $_POST['Nature_Of_Business'];
    $addressOfBusiness = $_POST['Address_of_business'];
    $startDate = $_POST['Start_date'];
    $ownerName = $_POST['Owner_Name'];
    $nic = $_POST['NIC'];
    $anyOtherBusiness = $_POST['Any_Other_Business'];
    $ifOwnerHadNames = $_POST['If_Owner_Had_Names'];
    $nationality = $_POST['Nationality'];
    $addressOfOwner = $_POST['Address_of_Owner'];
    $businessType = $_POST['Business_type'];
    $others = $_POST['Others'];

    // Handle file upload
    $target_dir = "uploads/";
    
    // Make sure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $document_path = $target_dir . basename($_FILES["document"]["name"]);
    $fileType = strtolower(pathinfo($document_path, PATHINFO_EXTENSION));

    // Validate file type
    if ($fileType != "pdf" && $fileType != "zip") {
        die("Only PDF and ZIP files are allowed.");
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $document_path)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare(
            "INSERT INTO businesses 
            (GN_div, Business_Name, Nature_Of_Business, Address_of_business, Start_date, owner_name, NIC, Any_Other_Business, If_Owner_Had_Names, Nationality, Address_of_Owner, Business_type, Others, document_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        // Bind parameters
       $stmt->bind_param(
    "ssssssssssssss", 
    $gnDivision, $businessName, $natureOfBusiness, $addressOfBusiness, $startDate, $ownerName, $nic, $anyOtherBusiness, $ifOwnerHadNames, $nationality, $addressOfOwner, $businessType, $others, $document_path
);


        // Execute and check if the query was successful
        if ($stmt->execute()) {
            echo "Request send successfully! Thank you for connect with DS-Udapalatha";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
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
        .card-header.bg-primary {
            background-color: #A0522D !important; /* Brown for welcome banner */
            color: #FFD700 !important; /* Yellow text */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a> &nbsp; &nbsp; &nbsp; &nbsp;
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="usrdashboard.php">Dashboard</a>
            </li>
            <form method="GET" action="search_results.php" class="mb-3">
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

<div class="container">
    <h2>Business Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="GN_div">GN Division:</label>
            <input type="text" class="form-control" id="GN_div" name="GN_div" required>
        </div>
        <div class="form-group">
            <label for="Business_Name">Business Name:</label>
            <input type="text" class="form-control" id="Business_Name" name="Business_Name" required>
        </div>
        <div class="form-group">
            <label for="Nature_Of_Business">Nature Of Business:</label>
            <input type="text" class="form-control" id="Nature_Of_Business" name="Nature_Of_Business" required>
        </div>
        <div class="form-group">
            <label for="Address_of_business">Address Of Business:</label>
            <input type="text" class="form-control" id="Address_of_business" name="Address_of_business" required>
        </div>
        <div class="form-group">
            <label for="Start_date">Start Date:</label>
            <input type="date" class="form-control" id="Start_date" name="Start_date" required>
        </div>
        <div class="form-group">
            <label for="Owner_Name">Owner Name/Names:</label>
            <input type="text" class="form-control" id="Owner_Name" name="Owner_Name" required>
        </div>
        <div class="form-group">
            <label for="NIC">NIC:</label>
            <input type="text" class="form-control" id="NIC" name="NIC" required>
        </div>
        <div class="form-group">
            <label for="Any_Other_Business">Any Other Business:</label>
            <input type="text" class="form-control" id="Any_Other_Business" name="Any_Other_Business">
        </div>
        <div class="form-group">
            <label for="If_Owner_Had_Names">If Owner Had Any Other Names:</label>
            <input type="text" class="form-control" id="If_Owner_Had_Names" name="If_Owner_Had_Names">
        </div>
        <div class="form-group">
            <label for="Nationality">Nationality:</label>
            <input type="text" class="form-control" id="Nationality" name="Nationality" required>
        </div>
        <div class="form-group">
            <label for="Address_of_Owner">Address Of Owner:</label>
            <input type="text" class="form-control" id="Address_of_Owner" name="Address_of_Owner" required>
        </div>
        <div class="form-group">
            <label for="Business_type">Business Type:</label>
            <select class="form-control" id="Business_type" name="Business_type" required>
                <option value="" disabled selected>Select Business Type</option>
                <option value="individual">Individual</option>
                <option value="partnership">Partnership</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Others">Others:</label>
            <input type="text" class="form-control" id="Others" name="Others">
        </div>
        <div class="form-group">
            <label for="document">Attach Your Document (PDF or ZIP):</label>
            <input type="file" class="form-control" id="document" name="document" accept=".pdf, .zip" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
