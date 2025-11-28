<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");

$conn = new mysqli("localhost", "root", "", "smart_canteen");

$id = $_GET['id'];

$conn->query("DELETE FROM menu WHERE id=$id");

header("Location: admin_menu.php");
?>
