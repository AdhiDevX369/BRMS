<?php
require_once 'admin.conf.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'admin';

    // Check if NIC exists
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE nic='$nic'");
    if (mysqli_num_rows($check) > 0) {
        $error = "NIC already exists";
    } else {
        $sql = "INSERT INTO admin (nic, password, role) VALUES ('$nic', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            header("Location: test.admin.log.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
    <h2>Admin Registration</h2>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="nic" placeholder="NIC" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>