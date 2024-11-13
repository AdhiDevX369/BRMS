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
    $id = intval($_GET['id']); // Convert ID to an integer for security

    // Fetch the business details before editing
    $selectSql = "SELECT * FROM businesses WHERE id='$id'";
    $result = $conn->query($selectSql);

    if ($result && $result->num_rows > 0) {
        $business = $result->fetch_assoc();

        // Example: New values (these should be received from a form or some input fields)
        $newName = isset($_POST['name']) ? $_POST['name'] : $business['name']; // Replace with actual input values
        $newBRNumber = isset($_POST['BR_Number']) ? $_POST['BR_Number'] : $business['BR_Number']; // Example

        // Prepare SQL to log the edited business details
        $editedSql = "INSERT INTO edited_businesses (business_id, old_name, new_name, old_br_number, new_br_number) VALUES (
            '$id',
            '" . $conn->real_escape_string($business['name']) . "',
            '" . $conn->real_escape_string($newName) . "',
            '" . $conn->real_escape_string($business['BR_Number']) . "',
            '" . $conn->real_escape_string($newBRNumber) . "'
        )";

        // Start transaction
        $conn->begin_transaction();

        try {
            // Insert the edited record into edited_businesses table
            if ($conn->query($editedSql) === TRUE) {
                // Now update the original record in the businesses table
                $updateSql = "UPDATE businesses SET 
                    name='" . $conn->real_escape_string($newName) . "', 
                    BR_Number='" . $conn->real_escape_string($newBRNumber) . "' 
                    WHERE id='$id'";
                    
                if ($conn->query($updateSql) === TRUE) {
                    echo "Business updated successfully.";
                    header("Location: index.php"); // Redirect back to list
                    exit();
                } else {
                    throw new Exception("Error updating record: " . $conn->error);
                }
            } else {
                throw new Exception("Error inserting edited record: " . $conn->error);
            }

            // Commit transaction
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction on error
            echo $e->getMessage();
        }
    } else {
        echo "No business found with the provided ID.";
    }
} else {
    echo "No ID parameter provided.";
}

// Close connection
$conn->close();
?>
