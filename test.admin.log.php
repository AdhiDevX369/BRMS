<?php
require_once 'admin.conf.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE nic='$nic' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            echo "Login successful";
            exit();
        }
    }
    $error = "Invalid credentials";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="nic" placeholder="NIC" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
