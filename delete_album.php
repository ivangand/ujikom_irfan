<?php
include 'db.php'; // Include database connection

// Check if album_id is set
if (isset($_POST['album_id'])) {
    $album_id = $_POST['album_id'];

    // Delete query for the album
    $sql = "DELETE FROM album WHERE id_album = '$album_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Album berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus album: " . $conn->error;
    }
}

// Redirect back to album page
header("Location: album.php");
exit();
