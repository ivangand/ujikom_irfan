<?php
include 'db.php'; // Include database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $album_id = $_POST['album_id'];  // Get album ID
    $foto = $_FILES['foto'];         // Get the uploaded file

    // Check if the file is an image
    if (isset($foto) && $foto['error'] == 0) {
        // Define the allowed file types (e.g., JPG, PNG, GIF)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($foto['tmp_name']);

        // Check if the file type is allowed
        if (in_array($file_type, $allowed_types)) {
            // Set a unique file name for the uploaded image
            $file_name = uniqid('foto_', true) . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);

            // Set the upload directory
            $upload_dir = 'uploads/'; // Make sure this directory exists and is writable

            // Create the full path for the uploaded file
            $file_path = $upload_dir . $file_name;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($foto['tmp_name'], $file_path)) {
                // Insert photo information into the database
                $sql = "INSERT INTO foto (album_id, file_path) VALUES ('$album_id', '$file_path')";
                if ($conn->query($sql) === TRUE) {
                    echo "<p class='text-green-500'>Foto berhasil ditambahkan ke album.</p>";
                } else {
                    echo "<p class='text-red-500'>Terjadi kesalahan saat menambahkan foto: " . $conn->error . "</p>";
                }
            } else {
                echo "<p class='text-red-500'>Terjadi kesalahan saat mengupload foto.</p>";
            }
        } else {
            echo "<p class='text-red-500'>File yang diupload bukan gambar yang valid.</p>";
        }
    } else {
        echo "<p class='text-red-500'>Silakan pilih gambar untuk diupload.</p>";
    }
}
