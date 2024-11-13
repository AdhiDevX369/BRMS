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


<div class="container">
    <h1>Registered Businesses on Udapalatha DS</h1>
    <form id="dateForm">
        <label for="startDate">From:</label>
        <input type="date" id="startDate" required>

        <label for="endDate">To:</label>
        <input type="date" id="endDate" required>

        <button type="submit">Generate PDF</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.getElementById("dateForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Fetch business data
        fetch('fetch_business_data.php')
            .then(response => response.json())
            .then(data => {
                generatePDF(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    });

    function generatePDF(businesses) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(20);
        doc.text("Registered Businesses on Udapalatha DS", 14, 20);
        
        let startY = 30;
        doc.setFontSize(12);
        
        businesses.forEach(business => {
            // Ensure to access the correct properties of the business object
            doc.text(`BR_Number: ${business.BR_Number}`, 14, startY);
            doc.text(`Business_Name: ${business.Business_Name}`, 14, startY + 10);
            doc.text(`Address_of_business: ${business.Address_of_business}`, 14, startY + 20);
            startY += 30; // Adjust vertical spacing for the next business
        });

        // Save the PDF
        doc.save("business_report.pdf");
    }
</script>
</body>
</html>
