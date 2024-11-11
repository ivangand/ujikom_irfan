<?php
include 'db.php'; // Include database connection

// Get album_id from URL
$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']) : 0;

// Fetch album information
$sql_album = "SELECT * FROM album WHERE id_album = $album_id";
$result_album = $conn->query($sql_album);
$album = $result_album->fetch_assoc();

// Fetch photos for the specified album
$sql_photos = "SELECT * FROM foto WHERE album_id = $album_id";
$result_photos = $conn->query($sql_photos);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Guest</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        
        <!-- Header -->
        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Selamat datang di Galeri Foto!</h1>
            <div>
                <a href="login.php" class="text-blue-500 hover:text-blue-700 mr-4"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="register.php" class="text-green-500 hover:text-green-700"><i class="fas fa-user-plus"></i> Register</a>
            </div>
        </header>

        <!-- Navbar -->
        <nav class="mb-4">
            <div class="bg-white shadow rounded-lg">
                <ul class="flex space-x-4 p-4">
                    <li class="flex-1">
                        <a href="guest.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-image"></i> Galeri</a>
                    </li>
                    <li class="flex-1">
                        <a href="album_guest.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-photo-video"></i> Album</a>
                    </li>
                    <li class="flex-1">
                        <a href="panduan.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-book"></i> Panduan
                        </a>
                    </li>
                    <li class="flex-1">
                        <a href="aturan.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-gavel"></i> Aturan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php if ($album): ?>
            <h2 class="text-2xl font-bold mb-4"><?php echo $album['nama_album']; ?></h2>
            <p class="text-gray-700 mb-4"><?php echo $album['deskripsi']; ?></p>

            <!-- Back to Album Page Button -->
            <a href="album_guest.php" class="inline-block mb-6 text-blue-500 hover:text-blue-700 font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Album
            </a>

            <!-- Display Photos in Album -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                if ($result_photos->num_rows > 0) {
                    while ($photo = $result_photos->fetch_assoc()) {
                        $photo_path = $photo['file_path']; // Get file path from database
                        echo "
                        <div class='bg-white rounded-lg shadow-lg p-4'>
                            <img src='$photo_path' alt='Foto' class='w-full h-48 object-cover rounded-lg mb-2'>
                            <a href='$photo_path' class='text-blue-500 hover:underline'>Lihat Gambar</a>
                        </div>";
                    }
                } else {
                    echo "<p class='text-gray-500'>Belum ada foto dalam album ini.</p>";
                }
                ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Album tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>

</html>