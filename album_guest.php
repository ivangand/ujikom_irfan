<?php
include 'db.php'; // Include the database connection
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
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

        <h1 class="text-2xl font-bold mb-4">Daftar Album</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Query to get all albums from the database
            $sql = "SELECT * FROM album";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $album_id = $row['id_album'];
                    echo "
            <div class='bg-white rounded-lg shadow-lg overflow-hidden'>
                <img src='https://png.pngtree.com/png-clipart/20221115/original/pngtree-polaroid-cartoon-photo-frame-album-picture-image_7253003.png' alt='Album Thumbnail' class='w-full h-48 object-cover'>
                <div class='p-4'>
                    <h3 class='font-semibold text-lg mb-2'>{$row['nama_album']}</h3>
                    <p class='text-sm text-gray-500 mb-4'>{$row['deskripsi']}</p>
                    <a href='foto_guest.php?album_id=$album_id' class='text-blue-500 hover:underline'>
                        Lihat Album
                    </a>
                </div>
            </div>";
                }
            } else {
                echo "<p class='text-gray-500'>Belum ada album yang tersedia.</p>";
            }
            ?>
        </div>

    </div>
</body>

</html>