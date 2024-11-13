<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['code'];

    if ($entered_code == $_SESSION['code']) {
        // Redirect to reset password page
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Verify Code</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST">
            <div class="form-group">
                <label for="code">Enter the code sent to your email:</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify Code</button>
        </form>
    </div>
</body>
</html>
