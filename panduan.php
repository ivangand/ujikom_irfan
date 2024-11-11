<!-- panduan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan</title>
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
                        <a href="guest.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-image"></i> Galeri
                        </a>
                    </li>
                    <li class="flex-1">
                        <a href="album_guest.php" class="block text-center text-blue-600 hover:bg-blue-100 rounded-lg py-2 transition duration-200">
                            <i class="fas fa-photo-video"></i> Album
                        </a>
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

        <!-- Panduan Content -->
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Cara Menggunakan Galeri Foto</h2>
            <p class="text-gray-700 mb-4">Galeri Foto ini dirancang untuk memudahkan Anda berbagi dan mengelola foto dalam album yang terstruktur. Berikut adalah panduan lengkap untuk membantu Anda memaksimalkan fitur-fitur di galeri kami:</p>
            
            <ul class="list-disc ml-6 text-gray-700">
                <li class="mb-3"><strong>1. Menjelajahi Galeri:</strong> 
                    <p>Bagian Galeri menampilkan koleksi foto terbaru dari pengguna lain. Anda dapat melihat foto yang diunggah oleh komunitas, memberikan apresiasi, dan terinspirasi oleh karya orang lain. Fitur ini juga memungkinkan Anda untuk menjelajahi berbagai kategori foto berdasarkan minat.</p>
                </li>
                <li class="mb-3"><strong>2. Membuat Album:</strong> 
                    <p>Menyusun foto dalam album membantu Anda mengorganisasi foto berdasarkan kategori, peristiwa, atau tema tertentu. Dengan membuat album, Anda dapat menyimpan kenangan khusus secara lebih rapi dan memudahkan orang lain untuk melihat koleksi foto Anda berdasarkan kategori yang jelas. Setiap album dapat diberi deskripsi untuk memberikan konteks atau cerita di balik foto yang ada di dalamnya.</p>
                </li>
                <li class="mb-3"><strong>3. Menambahkan Foto:</strong> 
                    <p>Setelah Anda membuat album, Anda bisa mulai menambahkan foto-foto ke dalamnya. Setiap foto dapat dilihat dalam kualitas yang lebih besar dengan mengklik pada gambar, dan Anda dapat memberi setiap foto deskripsi singkat untuk menambah makna pada gambar tersebut.</p>
                </li>
                <li class="mb-3"><strong>4. Memberikan Like dan Komentar:</strong> 
                    <p>Anda bisa menunjukkan apresiasi pada foto milik pengguna lain dengan memberikan <em>like</em> atau menulis komentar. Fitur ini memungkinkan Anda untuk terlibat lebih dekat dengan komunitas, serta menerima tanggapan dari pengguna lain. Like dan komentar hanya dapat diakses jika Anda telah login, untuk memastikan interaksi yang aman dan nyaman bagi semua pengguna.</p>
                </li>
                <li class="mb-3"><strong>5. Mengelola Profil:</strong> 
                    <p>Setelah login, Anda dapat memperbarui profil Anda. Unggah foto profil, tambahkan sedikit deskripsi tentang diri Anda, dan tentukan preferensi yang ingin Anda bagikan pada pengguna lain. Hal ini akan membuat profil Anda lebih menarik dan personal di komunitas galeri.</p>
                </li>
                <li class="mb-3"><strong>6. Keamanan dan Privasi:</strong> 
                    <p>Kami menjaga privasi pengguna dengan serius. Hanya pengguna yang telah login yang bisa memberikan like dan komentar, serta membuat dan mengelola album mereka sendiri. Pastikan untuk menjaga kerahasiaan informasi login Anda, dan ikuti panduan keamanan yang kami terapkan.</p>
                </li>
            </ul>

            <p class="text-gray-700 mt-4">Kami berharap panduan ini membantu Anda menikmati pengalaman terbaik dalam menggunakan Galeri Foto. Jika Anda memerlukan bantuan lebih lanjut, silakan hubungi tim dukungan kami.</p>
        </section>
    </div>
</body>

</html>
