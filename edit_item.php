<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");

$conn = new mysqli("localhost", "root", "", "smart_canteen");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM menu WHERE id=$id");
$item = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $conn->query("UPDATE menu SET item_name='$name', price=$price WHERE id=$id");
    header("Location: admin_menu.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>

<h2>Edit Menu Item</h2>

<form method="POST">
    Item Name: <input type="text" name="name" value="<?php echo $item['item_name']; ?>" required><br><br>
    Price (₹): <input type="number" name="price" value="<?php echo $item['price']; ?>" required><br><br>
    <button type="submit">Update</button>
</form>

</body>
</html>
