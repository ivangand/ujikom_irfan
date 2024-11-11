<?php
session_start();
$conn = new mysqli("localhost", "root", "", "galeri");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'photo_id' is set in the POST request
if (isset($_POST['photo_id'])) {
    $photo_id = (int)$_POST['photo_id']; // Cast to an integer for security

    // Delete comments related to this photo
    $stmt = $conn->prepare("DELETE FROM komentar WHERE photo_id = ?");
    $stmt->bind_param("i", $photo_id);
    if ($stmt->execute()) {
        // After comments are deleted, delete the photo itself
        $stmt = $conn->prepare("DELETE FROM photo WHERE id = ?");
        $stmt->bind_param("i", $photo_id);
        if ($stmt->execute()) {
            // Redirect to 'foto_saya.php' after successful deletion
            header("Location: foto_saya.php");
            exit(); // Stop further script execution after redirection
        } else {
            echo "Error deleting photo: " . $conn->error;
        }
    } else {
        echo "Error deleting comments: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error: No photo ID provided.";
}

$conn->close();
