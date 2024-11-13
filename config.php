<?php
$mysqli = new mysqli("localhost", "root", "", "brms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
