<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_size = $_FILES["file"]["size"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_exts = ["pdf", "jpg", "jpeg", "png", "gif", "mp3", "wav", "mp4", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt"];

    if (!in_array($file_ext, $allowed_exts)) {
        echo "Invalid file type. Allowed types: PDF, images, audio, video, documents.";
        exit();
    }

    if ($file_size > 50 * 1024 * 1024) { // 50MB file limit
        echo "File too large. Maximum allowed size is 50MB.";
        exit();
    }

    $upload_dir = "uploads/" . basename($file_name);

    if (move_uploaded_file($file_tmp, $upload_dir)) {
        $metadata = $_POST["metadata"];
        $user_id = $_SESSION["user_id"];
        $sql = "INSERT INTO documents (user_id, filename, filepath, metadata) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $file_name, $upload_dir, $metadata);
        $stmt->execute();
        echo "Upload successful!";
    } else {
        echo "Error uploading file.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <textarea name="metadata" placeholder="Enter metadata (tags, keywords, etc.)"></textarea>
    <button type="submit">Upload</button>
</form>

