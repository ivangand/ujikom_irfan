<?php
include 'db.php'; // Menyertakan file koneksi database

// Cek apakah ada form untuk menambah album
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_album = $_POST['nama_album'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk menambah album baru
    $sql = "INSERT INTO album (nama_album, deskripsi) VALUES ('$nama_album', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Album berhasil ditambahkan.";
    } else {
        echo "<p class='text-red-500'>Terjadi kesalahan: " . $conn->error . "</p>";
    }
}
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

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']); // Clear the message after displaying
                ?>
            </div>
        <?php endif; ?>

        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Album</h1>
            <div>
                <a href="logout.php" class="text-red-500 hover:text-red-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <nav class="mb-4">
            <div class="bg-white shadow rounded-lg">
                <ul class="flex space-x-4 p-4">
                    <li class="flex-1">
                        <a href="halaman_user.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="flex-1">
                        <a href="tambah_foto.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-plus"></i> Tambah Foto
                        </a>
                    </li>
                    <li class="flex-1">
                        <a href="foto_saya.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-images"></i> Foto Saya
                        </a>
                    </li>
                    <li class="flex-1">
                        <a href="album.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-photo-video"></i> Album</a>
                    </li>
                    <li class="flex-1">
                        <a href="profil.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-user"></i> Profil
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="text-2xl font-bold mb-4">Halaman Album</h1>

        <!-- Button to redirect to tambah_album.php -->
        <a href="tambah_album.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline inline-block">
            Tambah Album
        </a>

        <h2 class="text-xl font-semibold mt-6 mb-4">Daftar Album</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Query untuk mengambil semua album dari database
            $sql = "SELECT * FROM album";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $album_id = $row['id_album']; // Assuming 'id_album' is the primary key for each album
                    echo "
                    <div class='bg-white rounded-lg shadow-lg overflow-hidden'>
                        <img src='https://png.pngtree.com/png-clipart/20221115/original/pngtree-polaroid-cartoon-photo-frame-album-picture-image_7253003.png' alt='Album Thumbnail' class='w-full h-48 object-cover'>
                        <div class='p-4'>
                            <h3 class='font-semibold text-lg mb-2'>{$row['nama_album']}</h3>
                            <p class='text-sm text-gray-500 mb-4'>{$row['deskripsi']}</p>
                            <a href='lihat_album.php?id=$album_id' class='text-blue-500 hover:underline'>
                                Lihat Album
                            </a>
                        </div>
                        <!-- Form for uploading photos -->
                        <form action='upload_foto.php' method='POST' enctype='multipart/form-data' class='p-4 bg-gray-50'>
                            <input type='file' name='foto' accept='image/*' class='block w-full mb-2 text-sm'>
                            <input type='hidden' name='album_id' value='$album_id'>
                            <button type='submit' class='w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'>
                                Tambah Foto
                            </button>
                        </form>
                        <!-- Form for deleting the album -->
                        <form action='delete_album.php' method='POST' class='p-4 bg-gray-50 mt-4 rounded-lg'>
                            <input type='hidden' name='album_id' value='$album_id'>
                            <button type='submit' class='w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'>
                                Hapus Album
                            </button>
                        </form>
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