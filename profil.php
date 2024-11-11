<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <?php
        session_start();
        $userId = $_SESSION['userid']; // pastikan userid disimpan dalam sesi

        // Ganti dengan koneksi database Anda
        $conn = new mysqli("localhost", "root", "", "galeri");

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data pengguna
        $sql = "SELECT * FROM user WHERE userid = $userId"; // Pastikan tabel 'users' ada dan sesuai
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

        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Profil Saya</h1>
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

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center mb-4">
                <img src="uploads/profile_pictures/irvan_png.png" alt="Foto Profil" class="w-24 h-24 rounded-full mr-4"> <!-- Ganti dengan path gambar profil -->
                <div>
                    <h2 class="text-xl font-bold"><?php echo $user['nama_lengkap']; ?></h2>
                    <p class="text-gray-600"><?php echo $user['email']; ?></p>
                </div>
            </div>

            <h3 class="text-lg font-bold mb-2">Informasi Tambahan:</h3>
            <p><strong>Alamat:</strong> <?php echo $user['alamat']; ?></p>
            <p><strong>Jenis Kelamin:</strong> <?php echo $user['jenis_kelamin']; ?></p>
            <p><strong>Tanggal Bergabung:</strong> <?php echo date('d M Y', strtotime($user['tanggal_bergabung'])); ?></p>
        </div>

        <!-- Tombol Ubah Data Diri -->
        <div class="mt-4">
            <a href="ubah_data_diri.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Ubah Data Diri</a>
        </div>
    </div>
</body>

</html>