<?php
$servername = "localhost";
$username = "root";     // default XAMPP username
$password = "";         // default XAMPP password is empty
$dbname = "parish_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>
