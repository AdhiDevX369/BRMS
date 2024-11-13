<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["nic"])) {
    header("Location: login.php");
    exit();
}



// Check if the welcome message should be displayed
$showWelcomeMessage = isset($_GET["welcome"]) && $_GET["welcome"] === "true";
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
		 <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a> &nbsp; &nbsp; &nbsp; &nbsp;
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
            </span>
        </div>
    </nav>



    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
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

                     <a href="view.php" class="btn btn-info" aria-hidden="true">View Registerd Business</a> &nbsp; &nbsp; &nbsp; &nbsp; 
                     <a href="download/index.php" class="btn btn-success" aria-hidden="true">Serculer and formats</a> &nbsp; &nbsp; &nbsp; &nbsp;
					 <a href="payments.php" class="btn btn-info" aria-hidden="true">Payment Details</a> &nbsp; &nbsp; &nbsp; &nbsp;
					 
					
                       

                     
                      
                      
                     
        
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