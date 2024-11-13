<?php
session_start(); // Start the session to access session variables

// Example to define $showWelcomeMessage and $name
// You can replace this with your logic to check whether the user should see the welcome message
$showWelcomeMessage = true; // Set this to true if you want to display the welcome message
$name = ""; // Replace this with the actual user name (e.g., from the session or database)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- Brand Name -->
        <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>

        <!-- Button to Add New Business -->
        <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>

        <!-- Navbar Toggle Button for Mobile Devices -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>

                <!-- Monthly Report Link (Active) -->
                <li class="nav-item active">
                    <a class="nav-link" href="report.php">Monthly Report</a>
                </li>

                <!-- View Past Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="viewPastDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View Past
                    </a>
                    <div class="dropdown-menu" aria-labelledby="viewPastDropdown">
                        <a class="dropdown-item" href="deleted_businesses.php">Deleted Businesses</a>
                        <a class="dropdown-item" href="edited_businesses.php">Edited Businesses</a>
                    </div>
                </li>

                <!-- Admin Request Link -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_request.php">Admin Request</a>
                </li>
            </ul>

            <!-- Change Password Icon -->
            <a href="change_password.php" class="btn btn-secondary btn-sm ml-3" aria-hidden="true">
                <i class="fas fa-cogs"></i> Change Password
            </a>

            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-danger btn-sm ml-2">Logout</a>
        </div>
    </nav>

    <!-- Bootstrap JS (required for responsive navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</span>
        </div>
    </nav>



    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 text-align=center; class="mb-0"><i class="fas fa-tachometer-alt"></i> Welcome to BRMS</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($showWelcomeMessage) { ?>
    <style>
        .custom-alert {
            text-align: center;
            font-weight: bold;
            color: Brown;
        }
    </style>
    <div class="alert alert-success custom-alert" role="alert">
        We work for a government service that fulfills the needs of the clients quickly and efficiently...! <?php echo $name; ?>
    </div>
<?php } ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slideshow</title>
    <link rel="stylesheet" href="css/css.css">


</head>
<body>
    <div class="slideshow-container">
        <div class="slide fade">
            <img src="images/br.jpeg" alt="Image 1">
        </div>
        <div class="slide fade">
            <img src="images/image2.jpg" alt="Image 2">
        </div>
        <div class="slide fade">
            <img src="images/image3.jpg" alt="Image 3">
        </div>
    </div>

    <script>
	let currentIndex = 0;
const slides = document.querySelectorAll('.slide');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'block' : 'none';
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

// Show the first slide initially
showSlide(currentIndex);

// Change slides every 6 seconds
setInterval(nextSlide, 6000);

	</script>
</body>
</html>
   
<br>

                     <div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-auto">  <!-- This allows the button to take only the width it needs -->
            <a href="checkRequest.php" class="btn btn-warning" aria-hidden="true">Check Request</a>
        </div>
        <div class="col-auto">
            <a href="view.php" class="btn btn-info" aria-hidden="true">View Registered Business</a>
        </div>
        <div class="col-auto">
            <a href="admin_view_messages.php" class="btn btn-warning" aria-hidden="true">View Messages</a>
        </div>
        <div class="col-auto">
            <a href="payments.php" class="btn btn-info" aria-hidden="true">Payment Details</a>
        </div>
        <div class="col-auto">
            <a href="update_status.php" class="btn btn-warning" aria-hidden="true">Give Update</a>
        </div>
    </div>
</div>

					
                       

                     
                      
                      
                     
        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>