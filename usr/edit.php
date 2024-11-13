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
                    <a class="nav-link" href="edit.php">Edit Registerd Businesses</a>
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
</head>
<body>
  <div class="container">
    <h2>Business Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
      <div class="form-group">
        <label for="id">BR Number :</label>
        <input type="text" class="form-control" id="BR_Number" name="BR_Number" required>
      </div>
	   <div class="form-group">
        <label for="GN_div">GN Division:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="name">Business Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
     
      <div class="form-group">
        <label for="Nature_Of_Business ">Nature Of Business:</label>
        <input type="text" class="form-control" id="repair_option" name="repair_option" required>
      </div>
	   <div class="form-group">
        <label for="Address_of_business">Address Of Business:</label>
        <input type="text" class="form-control" id="warranty" name="warranty" required>
      </div>
      <div class="form-group">
        <label for="Start_date">Start_date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
      </div>
	  <div class="form-group">
        <label for="Ower name">Ower Name/Names:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
	 
	  
	   <div class="form-group">
        <label for="any_other_business">Any Othet Business(if)</label>
        <input type="text" class="form-control" id="warranty" name="warranty" required>
      </div>
	    <div class="form-group">
        <label for="If_Ower_had_name">If Owner had had any other Names:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
	  
	   <div class="form-group">
        <label for="Nationality">Nationality</label>
        <input type="text" class="form-control" id="warranty" name="warranty" required>
      </div>
	   <div class="form-group">
        <label for="Address_of_owner">Address Of Owner:</label>
        <input type="text" class="form-control" id="warranty" name="warranty" required>
      </div>
	  <div class="form-group">
    <label for="Business_type">Business Type:</label>
    <select class="form-control" id="Business_type" name="Business_type" required>
        <option value="" disabled selected>Select Business Type</option>
        <option value="individual">Individual</option>
        <option value="partnership">Partnership</option>
    </select>
</div>

      
      <div class="form-group">
        <label for="others">Others:</label>
        <input type="text" class="form-control" id="others" name="others">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
 


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>