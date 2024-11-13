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

// Check if the BR_Number is passed
if (isset($_GET['BR_Number'])) {
    $BR_Number = $_GET['BR_Number'];

    // Prepare statement to fetch business details
    $stmt = $conn->prepare("SELECT * FROM businesses WHERE BR_Number = ?");
    $stmt->bind_param("s", $BR_Number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
		
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Mangement System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat -Udapalatha</a>
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
        <a href="login.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="form-container bg-white p-4 rounded shadow">
        <h2 class="text-center">Edit Business Details</h2>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="BR_Number">BR Number:</label>
                    <input type="text" class="form-control" id="BR_Number" name="BR_Number" value="<?php echo $row['BR_Number']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="GN_div">GN Division:</label>
                    <input type="text" class="form-control" id="GN_div" name="GN_div" value="<?php echo $row['GN_div']; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Business_Name">Business Name:</label>
                    <input type="text" class="form-control" id="Business_Name" name="Business_Name" value="<?php echo $row['Business_Name']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="Nature_Of_Business">Nature Of Business:</label>
                    <input type="text" class="form-control" id="Nature_Of_Business" name="Nature_Of_Business" value="<?php echo $row['Nature_Of_Business']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Address_of_business">Address Of Business:</label>
                    <input type="text" class="form-control" id="Address_of_business" name="Address_of_business" value="<?php echo $row['Address_of_business']; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Start_date">Start Date:</label>
                    <input type="date" class="form-control" id="Start_date" name="Start_date" value="<?php echo $row['Start_date']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="Owner_Name">Owner Name:</label>
                    <input type="text" class="form-control" id="Owner_Name" name="Owner_Name" value="<?php echo $row['Owner_Name']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Any_Other_Business">Any Other Business:</label>
                    <input type="text" class="form-control" id="Any_Other_Business" name="Any_Other_Business" value="<?php echo $row['Any_Other_Business']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="If_Owner_Had_Names">If Owner Had Any Other Names:</label>
                    <input type="text" class="form-control" id="If_Owner_Had_Names" name="If_Owner_Had_Names" value="<?php echo $row['If_Owner_Had_Names']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Nationality">Nationality:</label>
                    <input type="text" class="form-control" id="Nationality" name="Nationality" value="<?php echo $row['Nationality']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="Address_of_Owner">Address Of Owner:</label>
                    <input type="text" class="form-control" id="Address_of_Owner" name="Address_of_Owner" value="<?php echo $row['Address_of_Owner']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Business_type">Business Type:</label>
                    <select class="form-control" id="Business_type" name="Business_type" required>
                        <option value="" disabled>Select Business Type</option>
                        <option value="individual" <?php if($row['Business_type'] == 'individual') echo 'selected'; ?>>Individual</option>
                        <option value="partnership" <?php if($row['Business_type'] == 'partnership') echo 'selected'; ?>>Partnership</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="Others">Others:</label>
                    <input type="text" class="form-control" id="Others" name="Others" value="<?php echo $row['Others']; ?>">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="update" class="btn btn-custom btn-lg">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php

        // Handle form submission
        if (isset($_POST['update'])) {
            // Collect updated form data
            $BR_Number = $_POST['BR_Number'];
            $GN_div = $_POST['GN_div'];
            $Business_Name = $_POST['Business_Name'];
            $Nature_Of_Business = $_POST['Nature_Of_Business'];
            $Address_of_business = $_POST['Address_of_business'];
            $Start_date = $_POST['Start_date'];
            $Owner_Name = $_POST['Owner_Name'];
            $Any_Other_Business = $_POST['Any_Other_Business'];
            $If_Owner_Had_Names = $_POST['If_Owner_Had_Names'];
            $Nationality = $_POST['Nationality'];
            $Address_of_Owner = $_POST['Address_of_Owner'];
            $Business_type = $_POST['Business_type'];
            $Others = $_POST['Others'];

            // Prepare the update query
            $updateSql = "UPDATE businesses SET 
                GN_div=?, 
                Business_Name=?, 
                Nature_Of_Business=?, 
                Address_of_business=?, 
                Start_date=?, 
                Owner_Name=?, 
                Any_Other_Business=?, 
                If_Owner_Had_Names=?, 
                Nationality=?, 
                Address_of_Owner=?, 
                Business_type=?, 
                Others=? 
                WHERE BR_Number=?";

            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param(
                "sssssssssssss", 
                $GN_div, 
                $Business_Name, 
                $Nature_Of_Business, 
                $Address_of_business, 
                $Start_date, 
                $Owner_Name, 
                $Any_Other_Business, 
                $If_Owner_Had_Names, 
                $Nationality, 
                $Address_of_Owner, 
                $Business_type, 
                $Others,
                $BR_Number
            );

            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Business updated successfully.</div>";
                header("Location: index.php"); // Redirect back to the list
                exit();
            } else {
                echo "<div class='alert alert-danger text-center'>Error updating record: " . $conn->error . "</div>";
            }
        }
	}
}
