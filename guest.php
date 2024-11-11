<!-- guest.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Terbaru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        <!-- Galeri Terbaru -->
        <div class="container mx-auto py-10 px-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Galeri Terbaru</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "root", "", "galeri");

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query untuk mengambil semua foto dari berbagai pengguna
                $sql = "SELECT photo.id, user.nama_lengkap, photo.judul, photo.gambar, photo.tanggal_upload 
                FROM photo 
                JOIN user ON photo.userid = user.userid
                ORDER BY photo.tanggal_upload DESC";
                $result = $conn->query($sql);

                // Cek jika ada foto yang ditemukan
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['judul']; ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold"><?php echo $row['judul']; ?></h3>
                                <p class="text-sm text-gray-500">Oleh: <?php echo $row['nama_lengkap']; ?></p>
                                <p class="text-sm text-gray-500">Tanggal: <?php echo date('d M Y', strtotime($row['tanggal_upload'])); ?></p>

                                <!-- Like Button -->
                                <button onclick="alert('Silakan login untuk memberikan like')" class="like-button text-blue-600 mt-2">
                                    <i class="fas fa-thumbs-up"></i> Like (<?php
                                                                            $photo_id = $row['id'];
                                                                            $likeCount = $conn->query("SELECT COUNT(*) as count FROM likee WHERE photo_id = $photo_id")->fetch_assoc()['count'];
                                                                            echo $likeCount;
                                                                            ?>)
                                </button>

                                <!-- Tombol untuk Mengarah ke Halaman Komentar -->
                                <a href="login.php" onclick="alert('Silakan login untuk melihat dan menambahkan komentar')"
                                    class="bg-blue-600 text-white py-2 px-4 mt-2 rounded-lg inline-block text-center">
                                    Lihat Komentar
                                </a>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo "<p class='text-gray-500'>Belum ada foto yang diunggah.</p>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>