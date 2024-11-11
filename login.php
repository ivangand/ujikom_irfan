<?php
include 'db.php'; // Menyertakan file koneksi database

session_start(); // Memulai session

$error_message = ''; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Memverifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['userid'] = $row['userid']; // Menyimpan ID pengguna ke session
            header("Location: halaman_user.php?id=" . $row['userid']); // Redirect ke halaman pengguna
            exit();
        } else {
            $error_message = 'Password salah.';
        }
    } else {
        $error_message = 'Username tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Login Pengguna</h1>

        <?php if ($error_message): ?>
            <div class="bg-red-100 text-red-700 border-l-4 border-red-500 p-4 mb-4">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                <input type="text" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Masuk</button>
            </div>
        </form>
        <p>Belum punya akun? <a href="register.php" class="text-blue-500">Daftar di sini</a>.</p>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="guest.php" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                Kembali ke Halaman Guest
            </a>
        </div>
    </div>
</body>

</html>