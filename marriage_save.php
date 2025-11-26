<?php
// Connect to database
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = "";     // default XAMPP password
$dbname = "parish_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$bride_name = $_POST['bride_name'];
$bride_dob = $_POST['bride_dob'];
$bride_address = $_POST['bride_address'];
$bride_nationality = $_POST['bride_nationality'];

$groom_name = $_POST['groom_name'];
$groom_dob = $_POST['groom_dob'];
$groom_address = $_POST['groom_address'];
$groom_nationality = $_POST['groom_nationality'];

$marriage_date = $_POST['date'] ?? null;
$marriage_time = $_POST['time'] ?? null;

// Insert data into database
$stmt = $conn->prepare("INSERT INTO marriage_applications 
(bride_name, bride_dob, bride_address, bride_nationality, groom_name, groom_dob, groom_address, groom_nationality, marriage_date, marriage_time)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssss",
    $bride_name, $bride_dob, $bride_address, $bride_nationality,
    $groom_name, $groom_dob, $groom_address, $groom_nationality,
    $marriage_date, $marriage_time
);

if ($stmt->execute()) {
    echo "<script>alert('Marriage application submitted successfully!'); window.location='marriage.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
