<?php
$conn = new mysqli("localhost", "root", "", "smart_canteen");

$id = $_GET['id'];

$conn->query("UPDATE orders SET status='Completed' WHERE id=$id");

header("Location: admin_dashboard.php");
?>
