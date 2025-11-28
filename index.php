<?php
session_start();

// If already logged in → go to dashboard
if (isset($_SESSION['student'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Canteen - Login</title>
</head>
<body>

<h2>Student Login</h2>

<form action="login_process.php" method="POST">
    <label>Roll Number:</label><br>
    <input type="text" name="roll" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
