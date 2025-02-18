<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Admin Dashboard</h2>
<a href="manage-users.php">Manage Users</a>
<a href="manage-uploads.php">View Uploaded Documents</a>
<a href="logout.php">Logout</a>

</body>
</html>



