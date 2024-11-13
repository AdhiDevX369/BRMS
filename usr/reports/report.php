<?php

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
                    <a class="nav-link" href="gallery.php">Edit Registerd Businesses</a>
                </li>
            </ul>
			 <a href="report.php" class="btn btn-success" aria-hidden="true">Reports</a> &nbsp; &nbsp; &nbsp; &nbsp;
					
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </span>
        </div>
    </nav>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Registration</title>
  <!-- Bootstrap CSS from BootstrapCDN -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  
  </style>

    <div class="container">
        <h1>Registerd Business on Udapalatha DS</h1>
        <form id="dateForm">
            <label for="startDate">From:</label>
            <input type="date" id="startDate" required>

            <label for="endDate">TO:</label>
            <input type="date" id="endDate" required>

            <button type="submit">Generate PDF</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
