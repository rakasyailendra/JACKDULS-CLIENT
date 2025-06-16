<?php
include_once('koneksi.php');

// Proses hapus jika ada parameter GET
$pesan = '';
if (isset($_GET['kode']) && isset($_GET['proses']) && $_GET['proses'] == 'hapus') {
    $kode = $mysqli->real_escape_string($_GET['kode']);
    $query = "DELETE FROM data_support WHERE Kode='$kode'";
    if ($mysqli->query($query)) {
        $pesan = "Data berhasil dihapus.";
    } else {
        $pesan = "Gagal menghapus data: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Feedback Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #000;
        }

        .feedback-container {
            max-width: 800px;
            margin: auto;
        }

        .add-link {
            display: block;
            text-align: center;
            margin: 30px auto;
            padding: 12px 20px;
            background-color: #000;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            width: fit-content;
            text-decoration: none;
        }

        .add-link:hover {
            background-color: #555;
        }

        .feedback-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: #000;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-right: 10px;
        }

        .user-name {
            font-weight: bold;
            color: #000;
        }

        .user-email {
            color: #7f8fa6;
            font-size: 0.9em;
        }

        .feedback-text {
            font-size: 1em;
            line-height: 1.5;
            color: #000;
            margin-top: 10px;
        }

        .feedback-date {
            font-size: 0.8em;
            color: #6b6b6b;
            margin-top: 10px;
        }

        .action-buttons {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .btn {
            display: inline-block;
            padding: 6px 10px;
            margin-left: 5px;
            border-radius: 4px;
            font-size: 0.85em;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #e84118;
        }

        .admin-response {
            background-color: #ccc;
            padding: 10px;
            border-left: 4px solid #000;
            margin-top: 15px;
            font-style: italic;
            color: #2f3640;
        }

        @media (max-width: 600px) {
            .feedback-card {
                padding: 15px;
            }

            .btn {
                font-size: 0.75em;
                padding: 4px 8px;
            }
        }
    </style>
</head>
<body>

<!-- Popup Alert -->
<?php if (!empty($pesan)): ?>
  <?php
    $alert_class = (strpos($pesan, 'berhasil') !== false) ? 'alert-success' : 'alert-danger';
  ?>
  <div class="position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 1050;">
    <div class="alert <?= $alert_class ?> alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($pesan) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
<?php endif; ?>

    <nav class="navbar shadow-none">
        <div class="container-fluid">
            <a style="font-weight: bold; cursor: pointer; margin-left: 20px; justify-content: center; align-items: center; display: flex;" class="navbar-brand" href="index.php">
                <img style="height: 20px; margin-right:5px;" src="ASSETS\iconback.png" alt="">Kembali
            </a>
        </div>
    </nav>

<div class="feedback-container">


    <h2>Pesan anda kepada kami</h2>

    <a href="support.php" class="add-link">Kirim Pesan Anda Lagi</a>

    <?php
    // Ambil semua data untuk ditampilkan
    $query = "SELECT Kode, Nama, Email, Isi, Tanggal, Balasan FROM data_support ORDER BY Tanggal DESC";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query gagal: " . $mysqli->error);
    }

    if ($result->num_rows > 0) {
        while($data = $result->fetch_assoc()) {
            $inisial = strtoupper(substr($data['Nama'], 0, 1));
            $tanggal = date("d M Y, H:i", strtotime($data['Tanggal']));
            ?>
            <div class="feedback-card">
                <div class="action-buttons">
                    <a href="support.php?kode=<?= urlencode($data['Kode']); ?>" class="btn btn-edit">Edit</a>
                    <a href="data_support.php?kode=<?= urlencode($data['Kode']); ?>&proses=hapus"
                       onclick="return confirm('Yakin ingin menghapus feedback ini?')"
                       class="btn btn-delete">Hapus</a>
                </div>

                <div class="user-info">
                    <div class="avatar"><?= $inisial ?></div>
                    <div>
                        <div class="user-name"><?= htmlspecialchars($data['Nama']) ?></div>
                        <div class="user-email"><?= htmlspecialchars($data['Email']) ?></div>
                    </div>
                </div>

                <div class="feedback-text">
                    <?= nl2br(htmlspecialchars($data['Isi'])) ?>
                </div>

                <div class="feedback-date">
                    <?= $tanggal ?>
                </div>

                <!-- Tampilkan balasan admin jika ada -->
                <?php if (!empty($data['Balasan'])): ?>
                    <div class="admin-response">
                        <strong>Balasan Admin:</strong><br>
                        <?= nl2br(htmlspecialchars($data['Balasan'])) ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }
    } else {
        echo "<p style='text-align:center;'>Belum ada feedback.</p>";
    }
    ?>
</div>
<!-- FOOTER -->
        <footer class="bg-black text-white pt-4">
            <div class="container text-center text-md-start">
                <div class="row">
                    <!-- Branding -->
                    <div class="col-md-4 mb-4">
                        <h5 class="fw-bold">JACKDULS</h5>
                        <p class="">Fashion that fits your freedom. Discover your style with JACKDULS Pants®.
                        </p>
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
                        <a href="https://www.instagram.com/jackduls/" target="_blank"
                            class="text-white text-decoration-none d-block mb-2">
                            Instagram
                        </a>
                        <a href="https://www.instagram.com/jackduls/" target="_blank"
                            class="text-white text-decoration-none d-block mb-2">
                            TikTok
                        </a>
                        <a href="https://www.instagram.com/jackduls/" class="text-white text-decoration-none d-block">
                            Email Us
                        </a>
                    </div>
                </div>
                <hr class="bg-light" />
                <div class="text-center pb-3">
                    &copy; 2024 JACKDULS - All Rights Reserved
                </div>
            </div>
        </footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 

<!-- Script untuk auto-hide alert -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const alertElement = document.querySelector('.alert');
    if (alertElement) {
      setTimeout(() => {
        const alert = new bootstrap.Alert(alertElement);
        alert.close();
      }, 3000); // 3 detik
    }
  });
</script>

</body>
</html>