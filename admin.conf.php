<?php
$conn = mysqli_connect("localhost", "root", "", "brms");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>