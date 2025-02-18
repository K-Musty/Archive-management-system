<?php
session_start();
require __DIR__ . '/db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit();
}

$sql = "SELECT id, username, email, role FROM users";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>User: " . $row["username"] . " | Email: " . $row["email"] . " | Role: " . $row["role"] . "</p>";
}
