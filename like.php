<?php
session_start();
include 'db.php';

if (isset($_POST['photo_id']) && isset($_SESSION['userid'])) {
    $photo_id = $_POST['photo_id'];
    $user_id = $_SESSION['userid'];

    // Cek apakah pengguna sudah memberikan like
    $checkLike = $conn->query("SELECT * FROM likee WHERE photo_id = $photo_id AND user_id = $user_id");

    if ($checkLike->num_rows == 0) {
        // Insert like baru
        $conn->query("INSERT INTO likee (photo_id, user_id) VALUES ($photo_id, $user_id)");
    } else {
        // Hapus like jika sudah ada
        $conn->query("DELETE FROM likee WHERE photo_id = $photo_id AND user_id = $user_id");
    }
}

header("Location: halaman_user.php");
exit();
