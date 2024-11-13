<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration Management System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .navbar-dark.bg-primary {
            background-color: #A0522D !important;
        }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #FFD700 !important;
        }
        .btn-custom, .btn-info, .btn-warning, .btn-danger {
            background-color: #A0522D !important;
            border-color: #A0522D !important;
            color: #FFD700 !important;
        }
        .btn-custom:hover {
            background-color: #8B4513 !important;
            border-color: #8B4513 !important;
        }
        .card-header.bg-primary {
            background-color: #A0522D !important;
            color: #FFD700 !important;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
        }
        .slide {
            display: none; /* Hide slides by default */
        }
        img {
            width: 100%; /* Responsive images */
            height: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Divisional Secretariat - Udapalatha</a>
    <a href="NewBusinessRegistration.php" class="btn btn-info" aria-hidden="true">Add New Business</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="usrdashboard.php">Dashboard</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="request_admin.php">Request Admin</a>
            </li>
            <form method="GET" action="view_business_details.php" class="form-inline ml-3">
    <input type="text" name="nic" class="form-control mr-2" placeholder="Search by your NIC" required>
    <button type="submit" class="btn btn-info">Check Status</button>
</form>
        </ul>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>


<div class="container mt-5">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Business Name Registration Delay Period</h4>
        </div>
        <div class="card-body">
            <p class="lead">
                The period from the date of starting your business to the date of application for business name registration is considered as the delay period, and late fees are charged for that.
            </p>
            <hr>
            <h5>Examples:</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <strong>Start Date:</strong> 16.05.2024
                </li>
                <li class="list-group-item">
                    <strong>Registration Date:</strong> 17.07.2024
                </li>
                <li class="list-group-item">
                    <strong>Delay Period:</strong> 03 months
                </li>
            </ul>
            <p class="alert alert-warning">
                Even if it is delayed by one day, a sum of Rs. <strong>80.00</strong> will be charged for it.
            </p>
        </div>
    </div>

    <h2 class="text-center mt-4">Check Your Fee Here</h2>
    <div class="card shadow mt-4">
        <div class="card-body">
            <form id="registrationForm">
                <div class="form-group">
                    <label for="registration_fee">Registration Fee (Rs. 250):</label>
                    <input type="text" class="form-control" id="registration_fee" name="registration_fee" value="250" readonly>
                </div>

                <div class="form-group">
                    <label for="months_late">Months Late:</label>
                    <input type="number" class="form-control" id="months_late" name="months_late" min="0" required>
                </div>

                <div class="form-group">
                    <label for="late_fee">Late Fee (Rs. 80 per month):</label>
                    <input type="text" class="form-control" id="late_fee" name="late_fee" readonly>
                </div>

                <div class="form-group">
                    <label for="total_amount">Total Amount:</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                </div>

                <button type="button" class="btn btn-custom mb-3" onclick="printBill()">Print Bill</button>
               
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('months_late').addEventListener('input', function() {
        var monthsLate = parseInt(this.value) || 0;
        var lateFee = monthsLate * 80;
        document.getElementById('late_fee').value = lateFee;
        var totalAmount = 250 + lateFee;
        document.getElementById('total_amount').value = totalAmount;
    });

    function printBill() {
        var registrationFee = document.getElementById('registration_fee').value;
        var monthsLate = document.getElementById('months_late').value || 0;
        var lateFee = document.getElementById('late_fee').value || 0;
        var totalAmount = document.getElementById('total_amount').value;

        var printContent = `
            <html>
                <head>
                    <title>Bill</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        .text-center { text-align: center; }
                        .mt-3 { margin-top: 1rem; }
                        .mb-3 { margin-bottom: 1rem; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1 class="text-center">Business Registration Bill</h1>
                        <h3 class="text-center">Divisional Secretariat - Udapalatha</h3>
                        <hr>
                        <p><strong>Registration Fee:</strong> Rs. ${registrationFee}</p>
                        <p><strong>Months Late:</strong> ${monthsLate}</p>
                        <p><strong>Late Fee:</strong> Rs. ${lateFee}</p>
                        <h4 class="mt-3"><strong>Total Amount:</strong> Rs. ${totalAmount}</h4>
                        <hr>
                        <p class="text-center">Thank you for regiser your business!</p>
                    </div>
                </body>
            </html>
        `;
        
        var newWin = window.open('', '_blank');
        newWin.document.write(printContent);
        newWin.document.close();
        newWin.print();
        newWin.close();
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
