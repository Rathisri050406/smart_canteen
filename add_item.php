<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");

$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $conn->query("INSERT INTO menu (item_name, price) VALUES ('$name', $price)");
    header("Location: admin_menu.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
</head>
<body>

<h2>Add New Menu Item</h2>

<form method="POST">
    Item Name: <input type="text" name="name" required><br><br>
    Price (₹): <input type="number" name="price" required><br><br>
    <button type="submit">Add Item</button>
</form>

</body>
</html>
