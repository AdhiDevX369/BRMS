<?php
session_start();
include('admin/vendor/inc/config.php'); // Ensure this file has the correct database connection settings

// Check if the database connection exists
if (!$mysqli) {
    die("Database connection error: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("vendor/inc/head.php"); ?>

<body>

  <?php include("vendor/inc/nav.php"); ?>

  <!-- Header with Carousel -->
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active" style="background-image: url('vendor/img/br.jpeg')"></div>
        <div class="carousel-item" style="background-image: url('vendor/img/image2.jpg')"></div>
        <div class="carousel-item" style="background-image: url('vendor/img/image3.jpg')"></div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Main Container -->
  <div class="container">
    <h1 class="my-4">Welcome to Business Registration System</h1>

    <!-- Information Cards -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Why Us</h4>
          <div class="card-body">
            <p class="card-text">We create accountability in the efficiency of government service.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Core Values</h4>
          <div class="card-body">
            <p class="card-text">Excellence, Trust and Openness, Integrity, Responsibility, Customer Orientation.</p>
          </div>
        </div>
      </div>
    </div>
    
    <hr>

    <!-- Customer Feedback Section -->
    <h2 class="text-center">Customer Feedback</h2>
    <hr>

    <div class="row">
      <?php
        // Query to retrieve feedback
        $query = "SELECT name, email, rating, comments FROM tms_feedback ORDER BY RAND() LIMIT 3";
        $stmt = $mysqli->prepare($query);

        // Error handling for query preparation
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Display each feedback
                while ($row = $result->fetch_object()) {
      ?>
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo htmlspecialchars($row->name); ?></h4>
            <div class="card-body">
              <p class="card-text">Email: <?php echo htmlspecialchars($row->email); ?></p>
              <p class="card-text">Rating: <?php echo htmlspecialchars($row->rating); ?> / 5</p>
              <p class="card-text"><?php echo htmlspecialchars($row->comments); ?></p>
            </div>
          </div>
        </div>
      <?php 
                }
            } else {
                echo "<p class='text-center'>No feedback available at the moment.</p>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<p class='text-center'>Error preparing the statement: " . $mysqli->error . "</p>";
        }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <?php include("vendor/inc/footer.php"); ?>

  <!-- Bootstrap & jQuery Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
