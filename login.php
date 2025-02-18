<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email=? AND role='user'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result["password"])) {
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["role"] = $result["role"];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Electronic Archive</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Login to Electronic Archive</h2>

    <form method="post">
        <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <input type="email" name="email" required placeholder="Enter Email">
        <input type="password" name="password" required placeholder="Enter Password">
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Sign Up Here</a></p>
    <p><a href="admin-login.php">Admin Login</a></p>
</body>
</html>
