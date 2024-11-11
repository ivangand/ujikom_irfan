<?php
session_start();
include 'db.php'; // Menyertakan file koneksi database

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Variabel untuk menampung pesan
$notification = "";

// Proses form jika sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_SESSION['userid'];
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    // Mengupload gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    // Cek apakah file gambar adalah gambar yang valid
    $check = getimagesize($_FILES['gambar']['tmp_name']);

    if ($check !== false) {
        // Mengupload gambar ke direktori
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Mendapatkan tanggal upload dari form (jika diisi)
            $tanggal_upload = $_POST['tanggal_upload'] ? $_POST['tanggal_upload'] : date('Y-m-d H:i:s');
            // Query untuk memasukkan data foto ke dalam database
            $sql = "INSERT INTO photo (userid, judul, deskripsi, gambar, tanggal_upload) VALUES ('$userid', '$judul', '$deskripsi', '$gambar', '$tanggal_upload')";

            if ($conn->query($sql) === TRUE) {
                $notification = "<div class='bg-green-500 text-white p-4 rounded-lg mb-4'>Foto berhasil ditambahkan!</div>";
            } else {
                $notification = "<div class='bg-red-500 text-white p-4 rounded-lg mb-4'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        } else {
            $notification = "<div class='bg-red-500 text-white p-4 rounded-lg mb-4'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
        }
    } else {
        $notification = "<div class='bg-red-500 text-white p-4 rounded-lg mb-4'>File yang diupload bukan gambar.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <?php
        // Tampilkan notifikasi jika ada
        echo $notification;
        ?>

        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Tambah Foto</h1>
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
                        <a href="album.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-user"></i> ALbum</a>
                    </li>
                    <li class="flex-1">
                        <a href="profil.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200"> <i class="fas fa-user"></i> Profil</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="text-2xl font-bold mb-4">Tambah Foto</h1>

        <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul:</label>
                <input type="text" name="judul" id="judul" required class="border border-gray-300 p-2 w-full rounded" placeholder="Masukkan judul foto">
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="border border-gray-300 p-2 w-full rounded" placeholder="Masukkan deskripsi foto"></textarea>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Unggah Gambar:</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required class="border border-gray-300 p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label for="tanggal_upload" class="block text-gray-700">Tanggal Unggah:</label>
                <input type="date" name="tanggal_upload" id="tanggal_upload" class="border border-gray-300 p-2 w-full rounded" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tambah Foto</button>
        </form>
    </div>
</body>

</html>