<?php
session_start();

// If not logged in, redirect
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "smart_canteen");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu - Smart Canteen</title>
</head>
<body>

<h2>Available Menu Items</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Item Name</th>
        <th>Price (₹)</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['item_name'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td><a href='order.php?id=" . $row['id'] . "'>Order</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No items found</td></tr>";
    }
    ?>

</table>

<br><br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>

<?php
$conn->close();
?>
