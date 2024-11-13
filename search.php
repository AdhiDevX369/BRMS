<?php
// Sample array for demonstration; replace this with your database connection.
$applications = [
    '123' => 'Your application is pending review.',
    '456' => 'Your application has been approved.',
    '789' => 'Your application was rejected due to missing documents.',
];

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    if (array_key_exists($id, $applications)) {
        $message = $applications[$id];
    } else {
        $message = 'No application found for this ID.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Application Status Check</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Check Your Application Status</h2>
    <form method="post">
        <div class="form-group">
            <label for="id">Enter Your ID Number:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <button type="submit" class="btn btn-primary">Check Status</button>
    </form>

    <?php if ($message): ?>
        <div class="result alert alert-info mt-3">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
