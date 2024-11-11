<?php
session_start(); // Memulai session
include 'db.php'; // Menyertakan file koneksi database

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['userid'])) {
    header("Location: login.php"); // Jika belum login, redirect ke halaman login
    exit();
}

// Mengambil data pengguna dari database
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM user WHERE userid = $userid";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .like-button {
            transition: transform 0.2s ease-in-out;
        }

        .like-button.animate-like {
            transform: scale(1.3);
        }

        /* Teks tombol yang berubah warna saat di-like */
        .liked {
            color: #ff0000;
            /* Warna merah */
        }
    </style>

</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Selamat datang, <?php echo $user['nama_lengkap']; ?>!</h1>
            <div>
                <a href="logout.php" class="text-red-500 hover:text-red-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <nav class="mb-4">
            <div class="bg-white shadow rounded-lg">
                <ul class="flex space-x-4 p-4">
                    <li class="flex-1">
                        <a href="halaman_user.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="flex-1">
                        <a href="tambah_foto.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-plus"></i> Tambah Foto</a>
                    </li>
                    <li class="flex-1">
                        <a href="foto_saya.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-images"></i> Foto Saya</a>
                    </li>
                    <li class="flex-1">
                        <a href="album.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-photo-video"></i> Album</a>
                    </li>
                    <li class="flex-1">
                        <a href="profil.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-user"></i> Profil</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Selamat datang di Galeri Foto!</h2>
            <p class="mb-2">Di sini Anda dapat mengelola foto Anda dengan mudah.</p>
            <p>Gunakan menu di atas untuk menavigasi ke bagian yang Anda inginkan.</p>
        </div>

        <h2 class="text-xl font-bold mb-4">Galeri Foto Terbaru</h2>

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
                            <form action="like.php" method="POST" class="mt-2">
                                <input type="hidden" name="photo_id" value="<?php echo $row['id']; ?>"> <!-- Menggunakan $row['id'] -->
                                <?php
                                // Mengambil jumlah like
                                $photo_id = $row['id']; // Pastikan ID diambil dengan benar
                                $likeCount = $conn->query("SELECT COUNT(*) as count FROM likee WHERE photo_id = $photo_id")->fetch_assoc()['count'];
                                $isLiked = $conn->query("SELECT * FROM likee WHERE photo_id = $photo_id AND user_id = $userid")->num_rows > 0;
                                ?>
                                <button type="submit" class="like-button text-blue-600 <?php echo $isLiked ? 'liked' : ''; ?>"
                                    onclick="animateLikeButton(this)">
                                    <i class="fas fa-thumbs-up"></i> Like (<?php echo $likeCount; ?>)
                                </button>
                            </form>

                            <!-- Tombol untuk Mengarah ke Halaman Komentar -->
                            <a href="komentar.php?photo_id=<?php echo $row['id']; ?>" class="bg-blue-600 text-white py-2 px-4 mt-2 rounded-lg inline-block text-center">
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

    <script>
        function animateLikeButton(button) {
            // Tambahkan kelas animasi
            button.classList.add("animate-like");

            // Hapus kelas animasi setelah animasi selesai (200ms)
            setTimeout(() => {
                button.classList.remove("animate-like");
            }, 200);
        }
    </script>
</body>

</html>