<!-- aturan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aturan</title>
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

        <!-- Aturan Content -->
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Peraturan Galeri Foto</h2>
            <p class="text-gray-700 mb-4">Untuk menciptakan lingkungan yang nyaman dan positif bagi semua pengguna, harap patuhi aturan berikut saat berpartisipasi di Galeri Foto kami:</p>
            
            <ul class="list-disc ml-6 text-gray-700">
                <li class="mb-3"><strong>Konten Positif dan Ramah:</strong>
                    <p>Mohon unggah foto yang memberikan dampak positif bagi komunitas. Hindari konten yang bersifat negatif, kontroversial, atau yang dapat menyinggung pihak lain.</p>
                </li>
                
                <li class="mb-3"><strong>Hormati Hak Cipta dan Privasi:</strong>
                    <p>Pastikan Anda hanya mengunggah foto milik sendiri atau yang memiliki izin. Jangan memuat gambar yang melanggar hak cipta atau privasi orang lain. Jika Anda memerlukan izin dari orang dalam foto, pastikan untuk mendapatkannya sebelum mengunggah.</p>
                </li>
                
                <li class="mb-3"><strong>Komunikasi Sopan dalam Komentar:</strong>
                    <p>Komentar yang Anda berikan harus menjaga sopan santun. Hindari bahasa yang kasar, merendahkan, atau menghina orang lain. Jadikan kolom komentar tempat berbagi inspirasi dan apresiasi dengan kata-kata positif.</p>
                </li>
                
                <li class="mb-3"><strong>Partisipasi yang Positif:</strong>
                    <p>Berperanlah secara aktif dalam menciptakan lingkungan yang mendukung. Anda dapat menyukai, mengomentari, atau berbagi konten dengan tujuan membangun komunitas yang ramah dan saling mendukung.</p>
                </li>
                
                <li class="mb-3"><strong>Laporkan Konten yang Tidak Sesuai:</strong>
                    <p>Jika Anda menemukan konten atau perilaku yang tidak sesuai dengan aturan, silakan laporkan kepada administrator. Ini membantu menjaga pengalaman yang aman bagi semua pengguna.</p>
                </li>
                
                <li class="mb-3"><strong>Foto Profil dan Informasi Pribadi:</strong>
                    <p>Pastikan informasi profil yang Anda unggah bersifat sopan dan pantas. Jaga privasi diri sendiri dan jangan bagikan data pribadi yang sensitif di halaman profil atau dalam konten yang Anda unggah.</p>
                </li>
            </ul>

            <p class="text-gray-700 mt-4">Dengan mematuhi aturan ini, Anda turut serta dalam menjaga Galeri Foto sebagai tempat yang aman, inspiratif, dan positif bagi semua pengguna. Selamat menikmati pengalaman Anda di komunitas ini!</p>
        </section>
    </div>
</body>

</html>
