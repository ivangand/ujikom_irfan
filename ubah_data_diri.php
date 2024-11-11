<?php
session_start();
$userId = $_SESSION['userid']; // pastikan userid disimpan dalam sesi

// Ganti dengan koneksi database Anda
$conn = new mysqli("localhost", "root", "", "galeri");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data pengguna berdasarkan ID
$sql = "SELECT * FROM user WHERE userid = $userId";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Proses form jika sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $email = $conn->real_escape_string($_POST['email']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);

    // Query untuk memperbarui data pengguna
    $sql_update = "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', alamat='$alamat', jenis_kelamin='$jenis_kelamin' WHERE userid=$userId";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
        // Reload data pengguna setelah update
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600"> Ubah Profil Pengguna</h1>
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
                        <a href="profil.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-user"></i> Profil
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="text-2xl font-bold mb-4">Data Diri</h1>

        <form action="profil.php" method="post" class="bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>" required class="border border-gray-300 p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required class="border border-gray-300 p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700">Alamat:</label>
                <input type="text" name="alamat" id="alamat" value="<?php echo $user['alamat']; ?>" class="border border-gray-300 p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="border border-gray-300 p-2 w-full rounded">
                    <option value="Laki-laki" <?php echo $user['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $user['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Perbarui Data Diri</button>
        </form>
    </div>
</body>

</html>