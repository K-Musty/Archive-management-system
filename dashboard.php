<?php
session_start();
require __DIR__ . '/db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "user") {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
$search_query = "";

// Fetch documents uploaded by the user, with search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search_query = trim($_POST["search"]);
    $sql = "SELECT filename, filepath, metadata, uploaded_at FROM documents 
            WHERE user_id = ? AND (filename LIKE ? OR metadata LIKE ?)";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search_query . "%";
    $stmt->bind_param("iss", $user_id, $search_param, $search_param);
} else {
    $sql = "SELECT filename, filepath, metadata, uploaded_at, file_type FROM documents WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <nav>
            <a href="upload.php" class="btn">Upload Document</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </nav>
    </header>

    <section class="container">
        <h2>Your Uploaded Documents</h2>

        <!-- Search Form -->
        <form method="post" class="search-form">
            <input type="text" name="search" placeholder="Search by filename or metadata..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-search">Search</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Filename</th>
                        <th>Metadata</th>
                        <th>Uploaded Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <img src="icons/<?php echo htmlspecialchars($row["file_type"]); ?>" alt="icon" class="icon">
                            </td>
                            <td><?php echo htmlspecialchars($row["filename"]); ?></td>
                            <td><?php echo htmlspecialchars($row["metadata"]); ?></td>
                            <td><?php echo date("d M Y, H:i", strtotime($row["uploaded_at"])); ?></td>
                            <td><a href="<?php echo $row["filepath"]; ?>" download class="btn btn-download">Download</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-docs">No documents found.</p>
        <?php endif; ?>
    </section>

</body>

</html>