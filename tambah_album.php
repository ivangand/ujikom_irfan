<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">

        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600"> Tambah Album</h1>
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

        <!-- Button to redirect to album.php -->
        <a href="album.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline inline-block">
            Kembali
        </a>

        <h1 class="text-2xl font-bold mb-4">Tambah Album Baru</h1>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']); // Clear the message after displaying
                ?>
            </div>
        <?php endif; ?>

        <!-- Form to Add Album -->
        <form action="album.php" method="POST" class="bg-white p-6 rounded-lg shadow-md w-96">
            <div class="mb-4">
                <label for="nama_album" class="block text-gray-700 text-sm font-bold mb-2">Nama Album</label>
                <input type="text" name="nama_album" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
                <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reset</button>
            </div>
        </form>
    </div>
</body>

</html>