<!DOCTYPE html>
<html lang="en">

<?php include("vendor/inc/head.php");?>

<head>
  <style>
    /* General Body Styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    /* Container Styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Heading Styling */
    h1, h2 {
        color: #007bff;
        font-weight: bold;
    }

    /* Breadcrumb Styling */
    .breadcrumb {
        background-color: #f1f1f1;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .breadcrumb a {
        text-decoration: none;
        color: #007bff;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Image Styling */
    .img-fluid {
        max-width: 100%;
        height: auto;
        border: 2px solid #ddd;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* About Us Section */
    .col-lg-6 h2 {
        font-size: 24px;
        margin-bottom: 30px;
    }

    .col-lg-6 p {
        text-align: justify;
        margin-bottom: 20px;
        font-size: 16px;
        color: #555;
    }

    /* Footer Styling */
    footer {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 5px 0;
        width: 100%;
        display: none; /* Hide by default */
    }

    /* Show footer when scrolled to bottom */
    footer.visible {
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .col-lg-6 {
            margin-bottom: 20px;
        }
    }
  </style>
</head>

<body>

  <script>
    window.onscroll = function() {
      var footer = document.querySelector('footer');
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        footer.classList.add('visible');
      } else {
        footer.classList.remove('visible');
      }
    };
  </script>

  <?php include("vendor/inc/nav.php");?>

  <div class="container">
    <h1 class="mt-4 mb-3">About</h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">About</li>
    </ol>

    <div class="row">
      <div class="col-lg-6">
        <img class="img-fluid rounded mb-4" src="vendor/img/br.jpeg" alt="">
      </div>
      <div class="col-lg-6">
        <h2>About Us</h2>
        <p>Our Vision <br>
          To be the excellent divisional secretariat in Sri Lanka by providing an efficient and qualitative service to the public.
        </p>
        <p>Our Mission <br>
          To be the excellent divisional secretariat in Sri Lanka by providing an efficient and qualitative service to the public.
        </p>
        <p>Divisional Secretariat Office Udapalatha – Business Registration Management System <br>
          The Divisional Secretariat Office of Udapalatha – Gampola is dedicated to providing efficient and streamlined services to our local business community. Our Business Registration Management System (BRMS) is designed to simplify and enhance the process of business registration within the Udapalatha region. By leveraging technology, we aim to reduce the time and complexity involved in registering a business, ensuring that entrepreneurs and businesses can focus on growth and development. Our commitment is to deliver transparency, efficiency, and reliability in every service we provide, supporting the economic progress of the Gampola area.
        </p>
      </div>
    </div>
  </div>

  <?php include("vendor/inc/footer.php");?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
