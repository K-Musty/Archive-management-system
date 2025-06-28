<?php
session_start();
require __DIR__ . '/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_size = $_FILES["file"]["size"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_type = $_POST['file_type'];

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
        header("Location: dashboard.php");
    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" required class="input">
                <select name="file_type" class="input">
                    <option value="photo.png">Photo</option>
                    <option value="text.png">Text</option>
                    <option value="docx.png">Document(Word)</option>
                    <option value="doc.png">Document(Google)</option>
                    <option value="spreadsheet.png">Spreadsheet(Excel)</option>
                    <option value="pdf.png">PDF</option>
                    <option value="video.png">Video</option>
                    <option value="audio.png">Audio</option>
                    <option value="gif.png">GIF</option>
                </select>
                <textarea name="metadata" placeholder="Enter metadata (tags, keywords, etc.)"></textarea>
                <button type="submit" class="btn">Upload</button>
            </form>
        </div>
    </main>
</body>

</html>