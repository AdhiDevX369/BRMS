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
    // Retrieve form data (including payment details)
    $brNumber = $_POST['BR_Number'];
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
    $registrationFee = 250;
    $monthsLate = (int)$_POST['months_late'];
    $lateFee = $monthsLate * 80;
    $totalAmount = $registrationFee + $lateFee;
    $paymentDate = date("Y-m-d");

    // Insert business information
    $stmt = $conn->prepare("INSERT INTO businesses (BR_Number, GN_div, Business_Name, Nature_Of_Business, Address_of_business, Start_date, owner_name, Any_Other_Business, If_Owner_Had_Names, Nationality, Address_of_Owner, Business_type, Others) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("sssssssssssss", $brNumber, $gnDivision, $businessName, $natureOfBusiness, $addressOfBusiness, $startDate, $ownerName, $anyOtherBusiness, $ifOwnerHadNames, $nationality, $addressOfOwner, $businessType, $others);
    if ($stmt->execute()) {
        $businessId = $stmt->insert_id;

        // Insert payment information
        $stmt2 = $conn->prepare("INSERT INTO payments (business_id, registration_fee, late_fee, total_amount, payment_date) VALUES (?, ?, ?, ?, ?)");
        if ($stmt2 === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt2->bind_param("iddds", $businessId, $registrationFee, $lateFee, $totalAmount, $paymentDate);
        $stmt2->execute();

        echo "New business registered successfully with payment!";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statements
    $stmt->close();
    $stmt2->close();
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

<div class="container">
    <h2>Business Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="BR_Number">BR Number:</label>
            <input type="text" class="form-control" id="BR_Number" name="BR_Number" required>
        </div>
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
    <label for="registration_fee">Registration Fee (Rs. 250):</label>
    <input type="text" class="form-control" id="registration_fee" name="registration_fee" value="250" readonly>
</div>

<div class="form-group">
    <label for="months_late">Months Late:</label>
    <input type="number" class="form-control" id="months_late" name="months_late" min="0">
</div>

<div class="form-group">
    <label for="late_fee">Late Fee (Rs. 80 per month):</label>
    <input type="text" class="form-control" id="late_fee" name="late_fee" readonly>
</div>

<div class="form-group">
    <label for="total_amount">Total Amount:</label>
    <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
</div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    document.getElementById('months_late').addEventListener('input', function() {
        var monthsLate = parseInt(this.value) || 0;
        var lateFee = monthsLate * 80;
        document.getElementById('late_fee').value = lateFee;
        var totalAmount = 250 + lateFee;
        document.getElementById('total_amount').value = totalAmount;
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
