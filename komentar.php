<?php
session_start();
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['userid']) && !empty($_POST['komentar']) && !empty($_POST['photo_id'])) {
        // Ambil data dari form
        $user_id = $_SESSION['userid'];
        $photo_id = $_POST['photo_id'];
        $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

        // Masukkan komentar ke database
        $sql = "INSERT INTO komentar (photo_id, user_id, komentar) 
                VALUES ($photo_id, $user_id, '$komentar')";

        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman sebelumnya setelah berhasil menambahkan komentar
            header("Location: halaman_user.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Komentar atau foto tidak valid.";
    }
}
?>

<?php

// Cek apakah photo_id ada di URL
if (!isset($_GET['photo_id'])) {
    header("Location: halaman_user.php"); // Jika tidak ada, redirect ke halaman utama
    exit();
}

// Ambil photo_id dari URL
$photo_id = intval($_GET['photo_id']);

// Mengambil data foto dari database
$sql = "SELECT user.nama_lengkap, photo.judul, photo.gambar, photo.tanggal_upload 
        FROM photo 
        JOIN user ON photo.userid = user.userid 
        WHERE photo.id = $photo_id";

$result = $conn->query($sql);
$photo = $result->fetch_assoc();

if (!$photo) {
    echo "Foto tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($photo['judul']); ?> - Komentar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600"><?php echo htmlspecialchars($photo['judul']); ?></h1>
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

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="relative mb-4">
                <img src="uploads/<?php echo htmlspecialchars($photo['gambar']); ?>"
                    alt="<?php echo htmlspecialchars($photo['judul']); ?>"
                    class="w-full h-auto max-h-60 object-cover rounded-lg transition-transform duration-300 transform hover:scale-105">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 rounded-lg">
                    <h2 class="text-white font-bold text-lg sm:text-xl md:text-2xl"><?php echo htmlspecialchars($photo['judul']); ?></h2>
                </div>
            </div>

            <div class="p-4">
                <p class="text-sm text-gray-500">Oleh: <?php echo htmlspecialchars($photo['nama_lengkap']); ?></p>
                <p class="text-sm text-gray-500">Tanggal: <?php echo date('d M Y', strtotime($photo['tanggal_upload'])); ?></p>
            </div>
        </div>

        <!-- Form Komentar -->
        <form action="" method="POST" class="mt-4">
            <textarea name="komentar" placeholder="Tulis komentar..." class="w-full p-2 border rounded-lg" required></textarea>
            <input type="hidden" name="photo_id" value="<?php echo $photo_id; ?>">
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 mt-2 rounded-lg">Kirim Komentar</button>
        </form>

        <!-- Daftar Komentar -->
        <div class="mt-4">
            <h4 class="font-semibold text-sm">Komentar:</h4>
            <?php
            // Ambil komentar berdasarkan photo_id
            $comments_sql = "SELECT komentar.komentar, user.nama_lengkap, komentar.tanggal_komentar 
                             FROM komentar 
                             JOIN user ON komentar.user_id = user.userid 
                             WHERE komentar.photo_id = $photo_id 
                             ORDER BY komentar.tanggal_komentar DESC";
            $comments_result = $conn->query($comments_sql);

            if ($comments_result->num_rows > 0) {
                while ($comment = $comments_result->fetch_assoc()) {
                    echo "<div class='mt-2 border-b pb-2'>
                            <p><strong>" . htmlspecialchars($comment['nama_lengkap']) . "</strong> (" . htmlspecialchars($comment['tanggal_komentar']) . ")</p>
                            <p>" . htmlspecialchars($comment['komentar']) . "</p>
                          </div>";
                }
            } else {
                echo "<p class='text-gray-500'>Belum ada komentar.</p>";
            }

            // Proses untuk menyimpan komentar jika form disubmit
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_SESSION['userid']) && !empty($_POST['komentar'])) {
                    // Ambil data dari form
                    $user_id = $_SESSION['userid'];
                    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

                    // Masukkan komentar ke database
                    $insert_sql = "INSERT INTO komentar (photo_id, user_id, komentar) 
                                   VALUES ($photo_id, $user_id, '$komentar')";

                    if ($conn->query($insert_sql) === TRUE) {
                        // Refresh halaman untuk menampilkan komentar yang baru ditambahkan
                        header("Location: komentar.php?photo_id=$photo_id");
                        exit();
                    } else {
                        echo "<p class='text-red-500'>Error: " . htmlspecialchars($conn->error) . "</p>";
                    }
                } else {
                    echo "<p class='text-red-500'>Komentar tidak valid.</p>";
                }
            }
            ?>
        </div>

    </div>
</body>

</html>

<?php
$conn->close();
?>