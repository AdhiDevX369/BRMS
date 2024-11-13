<?php
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

// Check if form data has been posted
$feedbackSubmitted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs and validate
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO tms_feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $comments);

    if ($stmt->execute()) {
        $feedbackSubmitted = true;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-dark.bg-primary { background-color: #A0522D !important; }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link { color: #FFD700 !important; }
        body { background-color: #f0f8ff; }
        .container { max-width: 600px; margin-top: 50px; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { color: #007bff; }
        .form-group label { font-weight: bold; color: #333333; }
        .rating { display: flex; gap: 10px; font-size: 1.5em; color: #ffbf00; cursor: pointer; }
        .rating input { display: none; }
        .rating label:hover, .rating label:hover ~ label, .rating input:checked ~ label { color: #ffcc00; }
        .thank-you { display: <?php echo $feedbackSubmitted ? 'block' : 'none'; ?>; font-size: 1.2em; color: #28a745; margin-top: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info">Add New Business</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="usrdashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="request_admin.php">Request Admin</a></li>
            <form method="GET" action="view_business_details.php" class="form-inline ml-3">
                <input type="text" name="nic" class="form-control mr-2" placeholder="Search by your NIC" required>
                <button type="submit" class="btn btn-info">Check Status</button>
            </form>
        </ul>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <h2 class="text-center">We Value Your Feedback</h2>
    <p class="text-center">Let us know how we’re doing! Your feedback helps us improve.</p>

    <?php if ($feedbackSubmitted): ?>
        <div class="alert alert-success text-center">Thank you for your feedback!</div>
    <?php else: ?>
        <form method="POST" action="">

            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Rate Us:</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                </div>
            </div>

            <div class="form-group">
                <label for="comments">Your Feedback:</label>
                <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Tell us what you think..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
        </form>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
