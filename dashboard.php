<?php
session_start();

// Check if student logged in
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['student']; ?>!</h2>

<p>You are now logged in to Smart Canteen.</p>

<a href="menu.php">View Menu</a> |
<a href="logout.php">Logout</a>

</body>
</html>
