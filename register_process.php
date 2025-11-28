<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "smart_canteen");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Read form data
$name = $_POST['name'];
$roll = $_POST['roll'];
$password = $_POST['password'];

// Insert into database
$sql = "INSERT INTO students (name, roll_number, password) 
        VALUES ('$name', '$roll', '$password')";

if($conn->query($sql) === TRUE){
    echo "Registration successful!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
