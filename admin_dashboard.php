<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders joined with order_items and menu
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
ORDER BY orders.id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>
<p>Logged in as Admin</p>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Student Roll</th>
        <th>Item</th>
        <th>Price</th>
        <th>Order Time</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['order_id'] ?></td>
        <td><?= $row['student_roll'] ?></td>
        <td><?= $row['item_name'] ?: '-' ?></td>
        <td><?= $row['price'] ?: '-' ?></td>
        <td><?= $row['order_time'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="logout.php">Logout</a>

</body>
</html>

<?php
$conn->close();
?>
