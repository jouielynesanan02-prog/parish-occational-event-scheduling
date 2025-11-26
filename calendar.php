<?php
// ------------------- PHP BACKEND (API) -------------------
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'save') {
        $data = json_decode(file_get_contents("php://input"), true);
        $event = $conn->real_escape_string($data['event']);
        $date = $conn->real_escape_string($data['date']);
        $time = $conn->real_escape_string($data['time']);

        // Check if duplicate reservation exists
        $check = $conn->query("SELECT * FROM reservations WHERE event_type='$event' AND event_date='$date' AND event_time='$time'");
        if ($check->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "This date and time are already reserved."]);
        } else {
            $conn->query("INSERT INTO reservations (event_type, event_date, event_time) VALUES ('$event', '$date', '$time')");
            echo json_encode(["status" => "success", "message" => "Reservation saved successfully."]);
        }
        exit;
    }

    if ($action === 'list') {
        $res = $conn->query("SELECT * FROM reservations ORDER BY event_date, event_time");
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        exit;
    }
}
?>
