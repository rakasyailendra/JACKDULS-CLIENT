<?php
session_start();

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php"); // Arahkan ke login jika bukan admin
    exit();
}

require_once '../koneksi.php'; // Path ke file koneksi

$admin_id = $_SESSION['admin_id']; // Kita asumsikan admin_id disimpan di session saat login
$current_adminname = $_SESSION['adminname'];
$pesan = '';
$error = '';

// Proses form jika di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminname_baru = $_POST['adminname'];
    $password_sekarang = $_POST['password_sekarang'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil data admin dari database untuk verifikasi password
    $stmt = $mysqli->prepare("SELECT password FROM admin WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();

    // Verifikasi password saat ini
    if (password_verify($password_sekarang, $admin['password'])) {
        // Password saat ini benar, lanjutkan proses update
        $query_update = "UPDATE admin SET adminname = ? WHERE id = ?";
        $params = [$adminname_baru, $admin_id];
        $types = "si";

        // Cek jika ada password baru yang diisi
        if (!empty($password_baru)) {
            if ($password_baru === $konfirmasi_password) {
                if (strlen($password_baru) >= 6) {
                    $password_hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);
                    $query_update = "UPDATE admin SET adminname = ?, password = ? WHERE id = ?";
                    $params = [$adminname_baru, $password_hash_baru, $admin_id];
                    $types = "ssi";
                } else {
                    $error = "Password baru minimal harus 6 karakter.";
                }
            } else {
                $error = "Konfirmasi password baru tidak cocok.";
            }
        }
        
        // Jalankan query update jika tidak ada error
        if (empty($error)) {
            $stmt_update = $mysqli->prepare($query_update);
            $stmt_update->bind_param($types, ...$params);
            
            if ($stmt_update->execute()) {
                $_SESSION['adminname'] = $adminname_baru; // Update session
                $current_adminname = $adminname_baru;
                $pesan = "Profil berhasil diperbarui.";
            } else {
                $error = "Gagal memperbarui profil.";
            }
            $stmt_update->close();
        }

    } else {
        $error = "Password saat ini yang Anda masukkan salah.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pengaturan Profil - Jackduls</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        :root {
            --sidebar-gradient: linear-gradient(180deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            --sidebar-active-highlight: #00c6ff;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            --border-color: #e9ecef;
        }
        body { background-color: #f8f9fe; font-family: 'Source Sans 3', sans-serif; }
        .app-sidebar { background: var(--sidebar-gradient) !important; }
        .nav-sidebar .nav-item .nav-link.active, .nav-sidebar .nav-item .nav-link:hover { background-color: rgba(0, 0, 0, 0.2) !important; border-left: 3px solid var(--sidebar-active-highlight); }
        .card { border: 1px solid var(--border-color); border-radius: 0.75rem; box-shadow: var(--card-shadow); margin-bottom: 1.5rem; }
        .card-header { background-color: #fff; border-bottom: 1px solid var(--border-color); font-weight: 600; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-white shadow-sm">
            <div class="container-fluid">
                <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list fs-4"></i></a></li></ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"><a class="nav-link" data-bs-toggle="dropdown" href="#"><i class="bi bi-bell fs-4"></i><span class="navbar-badge badge text-bg-danger">15</span></a></li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="../ASSETS/profil.png" class="user-image rounded-circle shadow-sm" alt="User Image" style="width: 32px; height: 32px;">
                            <span class="d-none d-md-inline ms-2"><?= htmlspecialchars($_SESSION['adminname']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li class="user-header" style="background: linear-gradient(135deg, #0f2027 0%, #2c5364 100%); color:white;"><img src="../ASSETS/profil.png" class="img-circle shadow" alt="User Image"><p><?= htmlspecialchars($_SESSION['adminname']); ?><small>Web Developer</small></p></li>
                            <li class="user-footer d-flex justify-content-between p-2"><a href="pengaturan.php" class="btn btn-default btn-flat">Profile</a><a href="../logout.php" class="btn btn-danger btn-flat">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        
        <aside class="app-sidebar shadow" data-bs-theme="dark">
            <div class="sidebar-brand"><a href="./index.html" class="brand-link"><span class="brand-text fw-light">Admin Jackduls</span></a></div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav nav-sidebar flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">MENU UTAMA</li>
                        <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fa-solid fa-house-chimney"></i><p>Dashboard</p></a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fa-solid fa-chart-line"></i><p>Analytics</p></a></li>
                        <li class="nav-item"><a href="feedback.php" class="nav-link"><i class="nav-icon fa-solid fa-comments"></i><p>Feedback</p></a></li>
                        <li class="nav-item"><a href="datauser.php" class="nav-link"><i class="nav-icon fa-solid fa-users"></i><p>Data User</p></a></li>
                        <li class="nav-header">SISTEM</li>
                        <li class="nav-item"><a href="pengaturan.php" class="nav-link active"><i class="nav-icon fa-solid fa-gears"></i><p>Pengaturan</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6"><h3 class="mb-0" style="font-weight: 600;">Pengaturan Profil Admin</h3></div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <?php if (!empty($pesan)): ?>
                                        <div class="alert alert-success"><?= htmlspecialchars($pesan); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                                    <?php endif; ?>

                                    <form method="POST" action="pengaturan.php">
                                        <div class="mb-3">
                                            <label for="adminname" class="form-label">Username Admin</label>
                                            <input type="text" class="form-control" id="adminname" name="adminname" value="<?= htmlspecialchars($current_adminname); ?>" required>
                                        </div>
                                        <hr>
                                        <p class="text-muted">Kosongkan bagian password jika Anda tidak ingin mengubahnya.</p>
                                        <div class="mb-3">
                                            <label for="password_baru" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Minimal 6 karakter">
                                        </div>
                                        <div class="mb-3">
                                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label for="password_sekarang" class="form-label">Password Anda Saat Ini (Wajib diisi untuk menyimpan)</label>
                                            <input type="password" class="form-control" id="password_sekarang" name="password_sekarang" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline"><strong>Version</strong> Final</div>
            <strong>Copyright &copy; 2025 <a href="#">Admin Jackduls</a>.</strong> All rights reserved.
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/adminlte.js"></script> </body>
</html>