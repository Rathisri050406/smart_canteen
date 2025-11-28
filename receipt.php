<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Invalid order!";
    exit;
}

$order_id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT 
    orders.id AS order_id,
    orders.student_roll,
    orders.order_time,
    menu.item_name,
    menu.price
FROM orders
LEFT JOIN order_items ON orders.id = order_items.order_id
LEFT JOIN menu ON order_items.item_id = menu.id
WHERE orders.id = $order_id
";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Order not found!";
    exit;
}

$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
</head>
<body>

<h2>Order Receipt</h2>

<p><strong>Order ID:</strong> <?= $order['order_id'] ?></p>
<p><strong>Student Roll:</strong> <?= $order['student_roll'] ?></p>
<p><strong>Item:</strong> <?= $order['item_name'] ?></p>
<p><strong>Price:</strong> ₹<?= $order['price'] ?></p>
<p><strong>Order Time:</strong> <?= $order['order_time'] ?></p>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
