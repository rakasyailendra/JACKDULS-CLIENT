<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<?php
include_once('koneksi.php');

$kode   = "";
$nama   = "";
$email  = "";
$isi    = "";
$balasan = "";
$submit_value = "Kirim";
$proses = isset($_GET['proses']) ? $_GET['proses'] : '';
$readonly = '';

// Cek apakah pengguna ingin melihat feedback sendiri
$tampilkan_feedback_saya = false;
if (isset($_GET['lihat_saya'])) {
    $tampilkan_feedback_saya = true;
}

if (isset($_GET['kode'])) {
    // Sanitasi input
    $kode_input = $mysqli->real_escape_string($_GET['kode']);
    
    // Query ke tabel yang benar: data_support
    $query = "SELECT Kode, Nama, Email, Isi, Balasan FROM data_support WHERE Kode='$kode_input'";
    $result = $mysqli->query($query);

    if ($data = $result->fetch_assoc()) {
        $kode     = $data['Kode'];
        $nama     = $data['Nama'];
        $email    = $data['Email'];
        $isi      = $data['Isi'];
        $balasan  = $data['Balasan'];
    } else {
        die("Data tidak ditemukan.");
    }

    if ($proses == 'hapus') {
        $submit_value = "Hapus";
        $readonly = 'readonly';
    } else {
        $submit_value = "Update";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Support</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(255, 255, 255);
      width: 100%;
    }

    .container {
      width: 100%;
      max-width: 700px;
      margin: 50px auto;
      padding: 20px;
      background:rgb(255, 255, 255);
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      
    }

.textheader {
    max-width: 1000px; /* Sesuaikan sesuai kebutuhan */
    margin: 0 auto;   /* Agar konten tetap di tengah */
    padding: 0 15px;  /* Tambahkan sedikit padding kiri-kanan agar tidak nempel di tepi */
    text-align: center; /* Agar teks tetap rata tengah */
}

.textheader p{
  justify-content: center;
  align-items: center;
  display: flex;
}


    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .btn-submit {
      background-color:rgb(0, 0, 0);
      color: white;
    }

    .btn-submit:hover {
      background-color:rgb(88, 88, 88);
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
    }

    .btn-delete:hover {
      background-color: #c82333;
    }

    nav {
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.6);
    }

    /* Styling tambahan untuk balasan */
    .balasan-box {
      background-color:rgb(255, 255, 255);
      padding: 15px;
      margin-top: 20px;
      font-style: italic;
      color: #333;
      border-radius: 4px;
    }


    /* Feedback list styling */
    .feedback-list {
      margin-top: 40px;
      border-top: 1px solid #ddd;
    }

    .feedback-item {
      padding: 15px 0;
      border-bottom: 1px solid #eee;
    }

    .feedback-item:last-child {
      border-bottom: none;
    }

    .feedback-item strong {
      display: inline-block;
      min-width: 80px;
    }
footer {
    position: relative;
    width: 100%;
    box-sizing: border-box;
}

.footer-container {
    max-width: 1140px;
    margin: auto;
}

/* Pastikan padding pada container tidak benturan */
.container-footer {
    padding-left: 15px;
    padding-right: 15px;
}
  </style>
</head>
<body>

<nav class="navbar shadow-none">
  <div class="container-fluid">
    <a style="font-weight: bold; cursor: pointer; margin-left: 20px; justify-content: center; align-items: center; display: flex;" class="navbar-brand" href="index.php">
      <img style="height: 20px; margin-right:5px;" src="ASSETS\iconback.png" alt="">Kembali
    </a>
  </div>
</nav>

<!-- TEXT AREA FEEDBACK -->
<style>
  .container {
  width: 100%;
  max-width: 700px;
  margin: 50px auto;
  padding: 20px;
  background: rgb(255, 255, 255);
  border-radius: 8px;
  border: none;
  box-shadow: none;
}
</style>
<div class="textheader">
  <p>Hubungi kami</p>
  <h2 style="font-weight: bold;" >Kami di sini jika Anda membutuhkan kami</h2>
  <p>Kami senang mendengar dari Anda! Apakah Anda memiliki pertanyaan tentang koleksi kami, membutuhkan bantuan dengan pesanan, atau ingin memberikan umpan balik? Tim kami siap membantu.</p>
</div>
<div class="container">
<h4 style="text-align: center; font-weight: bold; margin-bottom: 15px;" >Kirim pesan kepada kami</h4>
<p style="margin-bottom: 0px;" >Gunakan formulir di bawah ini untuk mengirimkan pesan langsung:</p>
  <!-- Form Input Feedback -->
  <form method="POST" action="aksi.php">
    <!-- Hidden fields -->
    <input type="hidden" name="kode" value="<?php echo htmlspecialchars($kode); ?>">
    <input type="hidden" name="proses" value="<?php echo htmlspecialchars($proses); ?>">

    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>"
      <?php echo ($proses == 'hapus') ? 'readonly' : 'required'; ?>>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"
      <?php echo ($proses == 'hapus') ? 'readonly' : 'required'; ?>>

    <label for="isi">Isi Feedback</label>
    <textarea name="isi" id="isi" <?php echo ($proses == 'hapus') ? 'readonly' : ''; ?>><?php echo htmlspecialchars($isi); ?></textarea>



    <!-- Tampilkan balasan admin jika ada -->
    <?php if (!empty($balasan)): ?>
      <div class="balasan-box">
        <strong>Balasan Admin:</strong><br>
        <?= nl2br(htmlspecialchars($balasan)) ?>
      </div>
    <?php endif; ?>

    <!-- Tombol submit -->
    <?php if ($proses == 'hapus'): ?>
      <input type="submit" class="btn-delete btn btn-danger" value="Hapus">
    <?php elseif (!$tampilkan_feedback_saya): ?>
      <input style="background-color: blue; font-weight: bold;" type="submit" class="btn-submit btn btn-success" value="<?php echo $submit_value; ?>">
    <?php endif; ?>
         <!-- Tambahkan link untuk melihat feedback pengguna -->
<?php if (!$tampilkan_feedback_saya): ?>
  <div class="mt-3 text-center">
    <a style="background-color: black; color: white;" href="data_support.php" class="btn w-100">Lihat Feedback Saya</a>
  </div>
<?php endif; ?>
  </form>
  <!-- Tampilkan Feedback Pengguna Saat Klik Tombol -->
  <?php if ($tampilkan_feedback_saya && !empty($email)): ?>
    <div class="feedback-list">
      <h4>Feedback Saya</h4>
      <?php
      // Ambil semua feedback dari email ini
      $email_filter = $mysqli->real_escape_string($email);
      $query_list = "SELECT * FROM data_support WHERE Email='$email_filter' ORDER BY Tanggal DESC";
      $result_list = $mysqli->query($query_list);

      if ($result_list && $result_list->num_rows > 0):
        while ($row = $result_list->fetch_assoc()):
      ?>
        <div class="feedback-item">
          <p><strong>Kode:</strong> <?= htmlspecialchars($row['Kode']) ?></p>
          <p><strong>Isi:</strong> <?= nl2br(htmlspecialchars($row['Isi'])) ?></p>
          <?php if (!empty($row['Balasan'])): ?>
            <p><strong>Balasan:</strong> <?= nl2br(htmlspecialchars($row['Balasan'])) ?></p>
          <?php endif; ?>
          <p><small><?= date("d M Y, H:i", strtotime($row['Tanggal'])) ?></small></p>
        </div>
      <?php endwhile; ?>
      <?php else: ?>
        <p>Belum ada feedback dari Anda.</p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  </div>
<!-- FOOTER -->
<footer class="bg-black text-white pt-4 pb-3">
    <div class="container-footer text-center text-md-start">
        <div class="row">
            <!-- Branding -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">JACKDULS</h5>
                <p class="">Fashion that fits your freedom. Discover your style with JACKDULS Pants®.</p>
            </div>

            <!-- Links -->
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="SHOP/kaos.php" class="text-white text-decoration-none">Shop</a></li>
                </ul>
            </div>

            <!-- Social -->
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Follow Us</h6>
                <a href="https://www.instagram.com/jackduls/"  target="_blank"
                   class="text-white text-decoration-none d-block mb-2">Instagram</a>
                <a href="https://www.tiktok.com/@jackduls"  target="_blank"
                   class="text-white text-decoration-none d-block mb-2">TikTok</a>
                <a href="mailto:cs@jackduls.id" class="text-white text-decoration-none d-block">Email Us</a>
            </div>
        </div>

        <hr class="bg-light" />

        <div class="text-center">
            &copy; 2024 JACKDULS - All Rights Reserved
        </div>
    </div>
</footer>


<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>       
</body>
</html>
