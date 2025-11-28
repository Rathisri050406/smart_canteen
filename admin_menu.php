<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "smart_canteen");
$result = $conn->query("SELECT * FROM menu ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Menu Management</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background: #ddd; }
        a.btn { padding: 6px 12px; background: green; color: white; text-decoration:none; }
        a.del { padding: 6px 12px; background: red; color: white; text-decoration:none; }
    </style>
</head>
<body>

<h2>Admin Menu Management</h2>
<a class="btn" href="add_item.php">Add New Item</a>

<table>
<tr>
    <th>ID</th>
    <th>Item Name</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['item_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td>
        <a class="btn" href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a class="del" href="delete_item.php?id=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
