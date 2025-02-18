<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM documents";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>File: <a href='" . $row["filepath"] . "' download>" . $row["filename"] . "</a> | Uploaded by User ID: " . $row["user_id"] . "</p>";
}
?>

