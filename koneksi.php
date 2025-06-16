<?php
// koneksi.php

// Konfigurasi database
$host = "db.be-mons1.bengt.wasmernet.com";     // Host database
$user = "fb5ed1f8735380005f5d44bbe46d";          // Username MySQL (default Laragon: root)
$pass = "0684fb5e-d1f8-74be-8000-a88679480759";              // Password MySQL (default Laragon: kosong)
$db   = "if0_39241990_db_jackduls";       // Nama database

// Membuat koneksi
$mysqli = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Optional: Set charset untuk menghindari masalah karakter
$mysqli->set_charset("utf8mb4");
?>
