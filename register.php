<?php
require __DIR__ . '/db.php';

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "user"; // Ensures only 'user' role is assigned

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        $message = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Electronic Archive</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container">
            <form method="post">
                <h2 style="margin-top: 30px;">Electronic Archive Signup</h2>
                <div style="text-align: center;">
                    <p style="color: green;"><?= isset($message) ? $message : "" ?></p>
                    <p style="color: red;"><?= isset($error) ? $error : "" ?></p>
                </div>
                <input type="text" name="username" required placeholder="Username">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Password">
                <button type="submit" class="btn">Register</button>
                <p style="text-align: center;">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>

    </main>
</body>

</html>