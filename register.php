<?php
include 'db.php'; // Menyertakan file koneksi database

$notification = ""; // Variable for notification message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ke tabel user
    $sql = "INSERT INTO user (username, password, email, nama_lengkap, alamat) VALUES ('$username', '$hashed_password', '$email', '$nama_lengkap', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        // Success message
        $notification = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
        <strong class='font-bold'>Registrasi berhasil!</strong>
        <span class='block sm:inline'>Anda sekarang dapat <a href='login.php' class='underline'>masuk</a>.</span>
        </div>";
    } else {
        // Error message
        $notification = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
        <strong class='font-bold'>Error!</strong>
        <span class='block sm:inline'>Registrasi gagal: " . $conn->error . "</span>
        </div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Registrasi Pengguna</h1>

        <!-- Notification -->
        <?php echo $notification; ?>

        <form action="" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                <input type="text" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nama Lengkap">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat</label>
                <input type="text" name="alamat" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Alamat">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Daftar</button>
            </div>
        </form>
        <p>Sudah punya akun? <a href="login.php" class="text-blue-500">Masuk di sini</a>.</p>
    </div>
</body>

</html>