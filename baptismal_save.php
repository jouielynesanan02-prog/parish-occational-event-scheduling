<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parish_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $childName = $_POST['childName'];
    $birthDate = $_POST['birthDate'];
    $birthPlace = $_POST['birthPlace'];
    $marriage = isset($_POST['option']) ? $_POST['option'] : 'none';
    $gender = $_POST['gender'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $address = $_POST['address'];
    $contact = $_POST['contactNumber'];
    $godparents = $_POST['godparents'];
    $sponsors = $_POST['sponsors'];
    $baptize = $_POST['baptize'];
    $schedule_date = $_POST['date'];
    $schedule_time = $_POST['time'];

    // Determine schedule type (regular / extra)
    $day = date('w', strtotime($schedule_date)); // 0 = Sunday
    $hour = date('H', strtotime($schedule_time));
    $minute = date('i', strtotime($schedule_time));
    $schedule_type = ($day == 0 && $hour == 11 && $minute == 30)
        ? "Regular"
        : "Extra Regular";

    $sql = "INSERT INTO baptismal (
                child_name, birth_date, birth_place, marriage_of_parents, gender,
                father_name, mother_name, address, contact_number,
                godparents, sponsors, baptized_by, schedule_date, schedule_time, schedule_type
            )
            VALUES (
                '$childName', '$birthDate', '$birthPlace', '$marriage', '$gender',
                '$fatherName', '$motherName', '$address', '$contact',
                '$godparents', '$sponsors', '$baptize', '$schedule_date', '$schedule_time', '$schedule_type'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Registration submitted successfully!'); window.location.href='baptismal.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
