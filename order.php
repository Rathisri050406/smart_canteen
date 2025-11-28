<?php
session_start();

// Student must be logged in
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

// Check if item ID is sent
if (!isset($_GET['id'])) {
    echo "Invalid item!";
    exit;
}

$item_id = $_GET['id'];

// DB connection
$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch item details
$sql = "SELECT * FROM menu WHERE id = $item_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Item not found!";
    exit;
}

$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Order</title>
</head>
<body>

<h2>Confirm Your Order</h2>

<p><strong>Item:</strong> <?php echo $item['item_name']; ?></p>
<p><strong>Price:</strong> ₹<?php echo $item['price']; ?></p>

<br>

<a href="place_order.php?id=<?php echo $item_id; ?>">Confirm Order</a>
<br><br>
<a href="menu.php">Back to Menu</a>

</body>
</html>

<?php
$conn->close();
?>
