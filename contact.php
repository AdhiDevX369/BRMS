<!DOCTYPE html>
<html lang="en">
<?php include("vendor/inc/head.php");?>

<body>

<?php include("vendor/inc/nav.php");?>

<div class="container">
    <h1 class="mt-4 mb-3">Contact Us</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
    </ol>

    <div class="row">
        <!-- Contact Details on the Left -->
        <div class="col-lg-4 mb-4">
            <h3>Contact Details</h3>
            <p>
                Divisional Secretariat<br>
                Udapalatha, Gampola<br>
            </p>
            <p>
                <abbr title="Phone">Phone</abbr>: (+94) 812352236
            </p>
            <p>
                <abbr title="Email">Email</abbr>:
                <a href="mailto:info@udapalatha.ds.gov.lk">info@udapalatha.ds.gov.lk</a>
            </p>
            <p>
                <abbr title="Hours">We are open</abbr>: Monday - Friday: 8:30 AM to 4:15 PM
            </p>
        </div>

        <!-- Contact Form on the Right -->
        <div class="col-lg-8 mb-4">
            <h3>Send us a Message</h3>
            <form name="sentMessage" id="contactForm" action="submit_message.php" method="POST" novalidate>
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label>Email Address:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>Message:</label>
                    <textarea rows="5" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php include("vendor/inc/footer.php");?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
