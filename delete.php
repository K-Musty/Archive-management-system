<?php
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        try {
            $id = $_GET['id'];
            $stmt = "DELETE FROM documents WHERE id = '$id'";
            $result = $conn->query($stmt);

            if ($result) {
                header('Location: dashboard.php');
            }
        } catch (Exception $e) {
            echo "Error occured" . $e->getMessage();
        }
    }
}
