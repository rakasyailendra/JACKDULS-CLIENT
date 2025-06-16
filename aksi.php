<?php
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode   = isset($_POST['kode']) ? $mysqli->real_escape_string($_POST['kode']) : '';
    $nama   = $mysqli->real_escape_string($_POST['nama']);
    $email  = $mysqli->real_escape_string($_POST['email']);
    $isi    = $mysqli->real_escape_string($_POST['isi']);
    $proses = isset($_POST['proses']) ? $_POST['proses'] : '';

    if ($proses == 'hapus') {
        // Proses hapus dilakukan via GET, bukan POST ini
        header("Location: data_support.php");
        exit();
    } elseif (!empty($kode)) {
        // Update data
        $query = "UPDATE data_support SET 
                    Nama='$nama', 
                    Email='$email', 
                    Isi='$isi' 
                  WHERE Kode='$kode'";
        $pesan = "Data berhasil diupdate.";
    } else {
        // Insert data baru
        $query = "INSERT INTO data_support (Nama, Email, Isi)
                  VALUES ('$nama', '$email', '$isi')";
        $pesan = "Data berhasil ditambahkan.";
    }

    $result = $mysqli->query($query);

    if ($result) {
        header("Location: data_support.php?status=sukses&pesan=" . urlencode($pesan));
    } else {
        header("Location: data_support.php?status=gagal&pesan=" . urlencode("Proses gagal: " . $mysqli->error));
    }
    exit();
} else {
    echo "Akses tidak valid.";
}
?>