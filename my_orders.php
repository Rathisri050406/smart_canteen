<?php
session_start();

// User must be logged in
if (!isset($_SESSION['student'])) {
    header("Location: index.php");
    exit();
}

$roll = $_SESSION['student'];

// Database connection
$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student orders
$sql = "SELECT * FROM orders WHERE student_roll='$roll' ORDER BY id DESC";
$order_result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background-color: #f2f2f2; }
        .btn { padding: 6px 12px; background: blue; color: white; text-decoration: none; }
    </style>
</head>
<body>

<h2>My Orders</h2>
<p>Logged in as: <b><?php echo $roll; ?></b></p>

<a href="dashboard.php" class="btn">Back to Dashboard</a>
<br><br>

<?php
if ($order_result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Order ID</th>
                <th>Order Time</th>
                <th>Items</th>
            </tr>";

    while ($order = $order_result->fetch_assoc()) {
        $order_id = $order['id'];

        // Fetch items for this order
        $item_sql = "SELECT menu.item_name, order_items.quantity 
                     FROM order_items 
                     JOIN menu ON order_items.item_id = menu.id 
                     WHERE order_items.order_id = $order_id";

        $items_result = $conn->query($item_sql);

        echo "<tr>
                <td>" . $order_id . "</td>
                <td>" . $order['order_time'] . "</td>
                <td>";

        if ($items_result->num_rows > 0) {
            while ($item = $items_result->fetch_assoc()) {
                echo $item['item_name'] . " (x" . $item['quantity'] . ")<br>";
            }
        }

        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

$conn->close();
?>
</body>
</html>
