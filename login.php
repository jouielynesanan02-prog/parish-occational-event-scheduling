<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM registrations WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['firstname'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Parish Management</title>
    <style>
        * { box-sizing: border-box; margin:0; padding:0; font-family:"Segoe UI", sans-serif; }
        body {
            background-image:url('sia.jpg');
            background-size:cover;
            background-position:center;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .form-container {
            background: rgba(255,255,255,0.95);
            width: 400px;
            padding: 40px;
            border-radius:15px;
            box-shadow:0 8px 25px rgba(0,0,0,0.2);
        }
        h2 { text-align:center; color:#003366; margin-bottom:25px; font-size:26px; }
        input { width:100%; padding:12px; margin-bottom:15px; border:1px solid #bbb; border-radius:6px; font-size:16px; }
        input:focus { border-color:#2193b0; outline:none; }
        button {
            width:100%; padding:12px; background: linear-gradient(90deg, #2193b0, #6dd5ed);
            border:none; border-radius:6px; color:white; font-size:18px; font-weight:600; cursor:pointer; transition:0.3s;
        }
        button:hover { background: linear-gradient(90deg, #1b7a91, #5bc4d9); }
        .footer-link { text-align:center; margin-top:12px; font-size:14px; }
        .footer-link a { color:#2193b0; text-decoration:none; font-weight:bold; }
        .footer-link a:hover { text-decoration:underline; }
        .error { color:red; text-align:center; margin-bottom:10px; }
        .success { color:green; text-align:center; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
            if(isset($_GET['registered'])) echo "<p class='success'>Registration successful! Please log in.</p>";
            if(isset($error)) echo "<p class='error'>$error</p>";
        ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="footer-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
