<?php
session_start();

$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['roll']) || !isset($_POST['password'])) {
    echo "Invalid access!";
    exit;
}

$roll = $_POST['roll'];
$password = $_POST['password'];

// Check student credentials
$sql = "SELECT * FROM students WHERE roll_number='$roll' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login success
    $_SESSION['student'] = $roll;
    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid Roll Number or Password!";
}

$conn->close();
?>
