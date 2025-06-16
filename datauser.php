<?php
session_start();
include_once('koneksi.php');

// Proses hapus user
if (isset($_GET['id']) && $_GET['action'] == 'delete') {
    $id = $mysqli->real_escape_string($_GET['id']);
    $query = "DELETE FROM users WHERE id='$id'";
    if ($mysqli->query($query)) {
        $pesan = "User berhasil dihapus.";
    } else {
        $pesan = "Gagal menghapus user: " . $mysqli->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AdminLTE | Data User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
  <style>
    body {
      padding-top: 56px; /* Sesuaikan dengan tinggi navbar */
    }
    .table-actions a {
      margin-right: 10px;
      text-decoration: none;
      color: #007bff;
    }
    .table-actions a:hover {
      color: #0056b3;
    }
    .alert {
      max-width: 600px;
      margin: 15px auto;
      padding: 12px;
      border-radius: 4px;
      font-size: 0.9em;
      text-align: center;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
    }
  </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

  <!-- Main Content -->
  <main class="app-main">
    <div class="container-fluid">
      <h3 style="font-weight: bold;" class="mb-4">Kelola Data Pengguna</h3>

      <?php if (isset($pesan)): ?>
        <div class="alert alert-success"><?= $pesan ?></div>
      <?php endif; ?>

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Daftar Pengguna</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Tanggal Daftar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $result = $mysqli->query("SELECT * FROM users ORDER BY created_at DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><strong>[Hashed]</strong></td>
                    <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                    <td class="table-actions">
                      <a href="?id=<?= $row['id'] ?>&action=delete" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>