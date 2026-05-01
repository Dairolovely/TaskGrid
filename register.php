<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        $error = "Email already exists!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Register</title></head>
<body class="auth-page">
    <div class="auth-card">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn-primary">Sign Up</button>
        </form>
        <a href="index.php">Back to Login</a>
    </div>
</body>
</html>