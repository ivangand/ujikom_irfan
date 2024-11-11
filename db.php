<?php
$servername = "localhost";
$username = "root"; // ganti dengan username MySQL Anda
$password = ""; // ganti dengan password MySQL Anda
$dbname = "galeri";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
