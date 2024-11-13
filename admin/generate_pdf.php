<?php
// Include the mPDF library
require_once __DIR__ . '/vendor/autoload.php'; // Correct the path based on your installation

// Start session
session_start();

// Get HTML content from the POST request
$html = $_POST['html'];

// Create a new PDF instance
$mpdf = new \Mpdf\Mpdf();

// Write HTML to the PDF
$mpdf->WriteHTML($html);

// Output to browser
$mpdf->Output('payment_details.pdf', 'D'); // D for download
?>
