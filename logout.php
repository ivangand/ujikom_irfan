<?php
session_start();
session_unset(); // Menghapus semua session
session_destroy(); // Menghancurkan session
header("Location: guest.php"); // Redirect ke halaman guest
exit();
