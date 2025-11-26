<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO registrations (firstname, middlename, lastname, email, password, birthday, gender, address, contact)
            VALUES ('$firstname', '$middlename', '$lastname', '$email', '$hashed_password', '$birthday', '$gender', '$address', '$contact')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?registered=1");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Parish Management</title>
    <style>
        * { box-sizing: border-box; margin:0; padding:0; font-family: "Segoe UI", sans-serif; }
        body { 
            background-image: url('sia.jpg'); 
            background-size: cover; 
            background-position: center; 
            display:flex; 
            justify-content:center; 
            align-items:center; 
            height:100vh;
        }
        .form-container {
            background: rgba(255,255,255,0.95);
            width: 420px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 25px;
            font-size: 26px;
        }
        label {
            display:block;
            margin-bottom:5px;
            font-weight:600;
            color:#333;
        }
        input, select {
            width:100%;
            padding:12px;
            margin-bottom:15px;
            border:1px solid #bbb;
            border-radius:6px;
            font-size:16px;
        }
        input:focus, select:focus {
            border-color:#2193b0;
            outline:none;
        }
        button {
            width:100%;
            padding:12px;
            background: linear-gradient(90deg, #2193b0, #6dd5ed);
            border:none;
            border-radius:6px;
            color:white;
            font-size:18px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }
        button:hover { background: linear-gradient(90deg, #1b7a91, #5bc4d9); }
        .footer-link {
            text-align:center;
            margin-top:12px;
            font-size:14px;
        }
        .footer-link a { color:#2193b0; text-decoration:none; font-weight:bold; }
        .footer-link a:hover { text-decoration:underline; }
        .error { color:red; text-align:center; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label>First Name</label>
            <input type="text" name="firstname" required>
            <label>Middle Name</label>
            <input type="text" name="middlename" required>
            <label>Last Name</label>
            <input type="text" name="lastname" required>
            <label>Email Address</label>
            <input type="email" name="email" required>
            <label>Create Password</label>
            <input type="password" name="password" required>
            <label>Birthday</label>
            <input type="date" name="birthday" required>
            <label>Gender</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <label>Address</label>
            <input type="text" name="address" required>
            <label>Contact Number</label>
            <input type="text" name="contact" required>
            <button type="submit">Sign Up</button>
        </form>
        <div class="footer-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
