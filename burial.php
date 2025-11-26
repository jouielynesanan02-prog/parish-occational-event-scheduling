<?php
// burial.php
$host = "localhost";
$dbname = "parish_db";
$username = "root";
$password = "";
$message = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form only if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deceased_name = $conn->real_escape_string($_POST['deceased_name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $place_of_birth = $conn->real_escape_string($_POST['place_of_birth']);
    $spouse_name = $conn->real_escape_string($_POST['spouse_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $number_of_children = (int)$_POST['num_of_child'];
    $date_of_death = $_POST['date_of_death'];
    $sacraments = $conn->real_escape_string($_POST['sacraments']);
    $contact_number = $_POST['contact_number'];
    $type_of_burial = $_POST['burial_type'];
    $cause_of_death = $conn->real_escape_string($_POST['cause_of_death']);
    $burial_date = $_POST['burial_date'];
    $burial_time = $_POST['burial_time'];

    $sql = "INSERT INTO burial_forms (
        deceased_name, age, gender, dob, place_of_birth, spouse_name, address,
        number_of_children, date_of_death, sacraments, contact_number, type_of_burial,
        cause_of_death, burial_date, burial_time
    ) VALUES (
        '$deceased_name', $age, '$gender', '$dob', '$place_of_birth', '$spouse_name', '$address',
        $number_of_children, '$date_of_death', '$sacraments', '$contact_number', '$type_of_burial',
        '$cause_of_death', '$burial_date', '$burial_time'
    )";

    if ($conn->query($sql) === TRUE) {
        $message = "Form submitted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Burial Fill-Up Form</title>
<style>
/* Your CSS here (same as before) */
body {
  font-family: 'Times New Roman', Times, serif;
  background-image: url('sia.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 40px 20px;
  box-sizing: border-box;
}

.form-container {
  background-color: #ffffff;
  padding: 30px 40px;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  max-width: 700px;
  width: 100%;
  box-sizing: border-box;
}

h1, h2 {
  text-align: center;
  color: #333;
}

label {
  display: block;
  margin-top: 15px;
}

input, select, textarea, button {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

.submit-btn {
  background-color: #2193b0;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
  margin-top: 25px;
  transition: background-color 0.3s ease;
}

.submit-btn:hover {
  background-color: #176f8c;
}
.message {
  text-align: center;
  font-weight: bold;
  color: green;
}
</style>
</head>
<body>
<div class="form-container">
<h1>Burial Fill-Up Form</h1>

<?php if ($message != ""): ?>
<p class="message"><?php echo $message; ?></p>
<?php endif; ?>

<form id="burial-form" action="burial.php" method="POST">
  <label for="deceased-name">Full Name of Deceased:</label>
  <input type="text" id="deceased-name" name="deceased_name" required>

  <label for="age">Age:</label>
  <input type="number" id="age" name="age" required>

  <label for="gender">Gender:</label>
  <select id="gender" name="gender" required>
    <option value="">-- Select --</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="Other">Other</option>
  </select>

  <label for="dob">Date of Birth:</label>
  <input type="date" id="dob" name="dob" required>

  <label for="pob">Place of Birth:</label>
  <input type="text" id="pob" name="place_of_birth" required>

  <label for="spouse">Name of Wife or Husband:</label>
  <input type="text" id="spouse" name="spouse_name" required>

  <label for="address">Address:</label>
  <input type="text" id="address" name="address" required>

  <label for="num_of_child">Number of Child:</label>
  <input type="number" id="num_of_child" name="num_of_child" required>

  <label for="dod">Date of Death:</label>
  <input type="date" id="dod" name="date_of_death" required>

  <label for="sacraments">Sacraments:</label>
  <input type="text" id="sacraments" name="sacraments" required>

  <label for="contact-number">Contact Number:</label>
  <input type="tel" id="contact-number" name="contact_number" required pattern="[0-9]{10,15}" title="10 to 15 digits">

  <label for="type">Type of Burial:</label>
  <select id="type" name="burial_type" required>
    <option value="">-- Select --</option>
    <option value="Common">Common</option>
    <option value="Special">Special</option>
  </select>

  <label for="cause">Cause of Death:</label>
  <input type="text" id="cause" name="cause_of_death">

  <h2>Burial Schedule</h2>
  <label for="burial-date">Choose Date:</label>
  <input type="date" id="burial-date" name="burial_date" required>

  <label for="burial-time">Choose Time:</label>
  <input type="time" id="burial-time" name="burial_time" required>

  <button type="submit" class="submit-btn">Submit</button>
</form>
</div>
</body>
</html>
