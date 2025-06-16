<?php
// koneksi.php

// Konfigurasi database
$host = "localhost";     // Host database
$user = "root";          // Username MySQL (default Laragon: root)
$pass = "";              // Password MySQL (default Laragon: kosong)
$db   = "jackduls";       // Nama database

// Membuat koneksi
$mysqli = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Optional: Set charset untuk menghindari masalah karakter
$mysqli->set_charset("utf8mb4");
?>