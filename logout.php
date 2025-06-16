<?php
session_start();
session_destroy();

// Gunakan HTTP_REFERER untuk kembali ke halaman sebelumnya
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // Jika tidak ada referer, arahkan ke halaman default seperti homepage
    header("Location: index.php");
}
exit();
?>