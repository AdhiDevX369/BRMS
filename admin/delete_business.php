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

    // Fetch the business details before deletion
    $selectSql = "SELECT * FROM businesses WHERE id='$id'";
    $result = $conn->query($selectSql);

    if ($result && $result->num_rows > 0) {
        $business = $result->fetch_assoc();

        // Prepare SQL to insert deleted record into the deleted_businesses table
        $deletedSql = "INSERT INTO deleted_businesses (business_id, name) VALUES ('$id', '" . $conn->real_escape_string($business['name']) . "')";

        // Start transaction
        $conn->begin_transaction();

        try {
            // Insert the deleted record
            if ($conn->query($deletedSql) === TRUE) {
                // Now delete the original record
                $deleteSql = "DELETE FROM businesses WHERE BR_Number='$BR_Number'";
                if ($conn->query($deleteSql) === TRUE) {
                    echo "Business deleted successfully.";
                    header("Location: index.php"); // Redirect back to list
                    exit();
                } else {
                    throw new Exception("Error deleting record: " . $conn->error);
                }
            } else {
                throw new Exception("Error inserting deleted record: " . $conn->error);
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
