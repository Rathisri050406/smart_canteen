<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Invalid item!";
    exit;
}

$item_id = $_GET['id'];
$roll = $_SESSION['student'];

$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert into orders
$order_sql = "INSERT INTO orders (student_roll) VALUES ('$roll')";
$conn->query($order_sql);
$order_id = $conn->insert_id;

// Insert into order_items
$item_sql = "INSERT INTO order_items (order_id, item_id, quantity)
             VALUES ($order_id, $item_id, 1)";
$conn->query($item_sql);

header("Location: receipt.php?id=$order_id");
exit;

$conn->close();
?>
