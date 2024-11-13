<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisional Secretariat - Udapalatha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .nav-link { color: #fff; font-size: 16px; font-weight: 500; }
        .nav-link:hover { color: #ddd; text-decoration: none; }
        .footer-links { display: flex; justify-content: space-between; padding: 10px; background-color: yellow; color: #fff; margin-top: 20px; }
        .footer-links a { color: black; font-size: 14px; }
        .footer-links a:hover { color: #ddd; }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <img src="images/logo.png" alt="Divisional Secretariat - Udapalatha Logo" width="6%">
        <h1 class="my-3">Divisional Secretariat - Udapalatha</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-lock"></i> Welcome To Business Registration Management System</h4>
                    </div>
                    <div class="card-body">
                        <form action="login_process.php" method="POST">
                            <div class="form-group">
                                <label for="nic">NIC</label>
                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter your NIC" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="footer-links">
                            <a href="index.php"><i class="fas fa-home"></i> Home</a>
                            <a href="reset_password.php"><i class="fas fa-key"></i> Forgot Password?</a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
