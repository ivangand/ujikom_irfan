<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .photo-container {
            width: 100%;
            height: 200px;
            /* Atur tinggi wadah gambar sesuai kebutuhan */
            overflow: hidden;
            border-radius: 0.5rem;
            /* Rounded corners */
            cursor: pointer;
            /* Tampilkan pointer saat hover */
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Memastikan gambar mengisi wadah dengan proporsi yang tepat */
            transition: transform 0.3s ease;
            /* Tambahkan transisi untuk efek zoom */
        }

        .photo-container:hover img {
            transform: scale(1.05);
            /* Zoom sedikit saat hover */
        }

        /* Gaya untuk gambar besar saat diperbesar */
        .modal {
            display: none;
            /* Sembunyikan modal secara default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            /* Latar belakang hitam transparan */
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
        }
    </style>
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

        // Query untuk mengambil data foto pengguna
        $sql = "SELECT * FROM photo WHERE userid = $userId ORDER BY tanggal_upload DESC";
        $result = $conn->query($sql);
        ?>

        <header class="flex items-center justify-between mb-6 bg-white shadow-md p-4 rounded-lg">
            <h1 class="text-2xl font-bold text-blue-600">Foto Saya</h1>
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

        <h2 class="text-xl font-bold mb-4">Foto yang Diunggah:</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Mengambil jumlah like dan status "liked" pengguna untuk foto ini
                    $photo_id = $row['id'];
                    $likeCount = $conn->query("SELECT COUNT(*) as count FROM likee WHERE photo_id = $photo_id")->fetch_assoc()['count'];
                    $isLiked = $conn->query("SELECT * FROM likee WHERE photo_id = $photo_id AND user_id = $userId")->num_rows > 0;

                    echo "<div class='bg-white p-4 rounded-lg shadow-lg transition-transform transform hover:scale-105'>";
                    echo "<div class='photo-container' onclick=\"openModal('uploads/" . $row['gambar'] . "')\">";
                    echo "<img src='uploads/" . $row['gambar'] . "' alt='" . $row['judul'] . "' class='w-full h-full object-cover rounded-lg'>";
                    echo "</div>";
                    echo "<h3 class='font-bold mt-2 text-lg'>" . $row['judul'] . "</h3>";
                    echo "<p class='text-gray-600'>" . $row['deskripsi'] . "</p>";
                    echo "<p class='text-gray-500 text-sm'>" . date('d M Y', strtotime($row['tanggal_upload'])) . "</p>";

                    // Menampilkan jumlah "like" dan tombol "like/unlike" di bawah foto
                    echo "<div class='mt-2 flex items-center'>";
                    echo "<span class='text-gray-700 font-semibold'>Likes: $likeCount</span>";
                    echo "<form action='like.php' method='POST' class='ml-4'>";
                    echo "<input type='hidden' name='photo_id' value='$photo_id'>";
                    echo "<button type='submit' class='text-blue-500 hover:text-blue-700'>";
                    echo $isLiked ? "<i class='fas fa-thumbs-up'></i> Unlike" : "<i class='fas fa-thumbs-up'></i> Like";
                    echo "</button>";
                    echo "</form>";
                    echo "</div>";


                    // View Comments Link
                    echo "<a href='komentar.php?photo_id=$photo_id' class='text-blue-500 hover:underline mt-2'>View Comments</a>";

                    // Delete Photo Button with Confirmation
                    echo "<form action='delete_photo.php' method='POST' class='mt-2' onsubmit='return confirmDelete()'>";
                    echo "<input type='hidden' name='photo_id' value='$photo_id'>";
                    echo "<button type='submit' class='text-red-500 hover:text-red-700'><i class='fas fa-trash-alt'></i> Delete Photo</button>";
                    echo "</form>";

                    echo "</div>";
                }
            } else {
                echo "<p class='text-gray-600'>Belum ada foto yang diunggah.</p>";
            }
            ?>
        </div>


        <!-- Modal untuk gambar yang diperbesar -->
        <div id="modal" class="modal" onclick="closeModal()">
            <img id="modal-img" src="" alt="Gambar Besar">
        </div>
    </div>

    <script>
        // JavaScript function to show confirmation dialog
        function confirmDelete() {
            return confirm("Apa kamu yakin ingin menghapus foto?");
        }
    </script>

    <script>
        function openModal(imgSrc) {
            const modal = document.getElementById('modal');
            const modalImg = document.getElementById('modal-img');
            modalImg.src = imgSrc; // Set gambar sumber modal
            modal.style.display = 'flex'; // Tampilkan modal
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.style.display = 'none'; // Sembunyikan modal saat diklik
        }
    </script>
</body>

</html>