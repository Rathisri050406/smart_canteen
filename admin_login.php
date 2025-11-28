<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; text-align:center; padding-top:80px; }
        input { padding: 10px; width: 250px; margin: 10px; }
        button { padding: 10px 20px; background: blue; color: white; border: none; }
    </style>
</head>
<body>

<h2>Admin Login</h2>

<form action="admin_process.php" method="POST">
    <input type="text" name="username" placeholder="Admin Username" required><br>
    <input type="password" name="password" placeholder="Admin Password" required><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
