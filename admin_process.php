<?php
session_start();

$u = $_POST['username'];
$p = $_POST['password'];

// Hard-coded admin credentials
if ($u == "admin" && $p == "1234") {
    $_SESSION['admin'] = "yes";
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid admin login!";
}
?>
