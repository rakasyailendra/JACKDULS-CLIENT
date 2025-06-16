<?php
session_start();

try {
    // Sesuaikan dengan detail database Anda
    $pdo = new PDO("mysql:host=localhost;dbname=jackduls", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Cek apakah user adalah admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE adminname = ?");
    $stmt->execute([$input_username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && isset($admin['password']) && is_string($admin['password'])) {
        if (password_verify($input_password, $admin['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['adminname'] = $admin['adminname'];
            $_SESSION['role'] = 'admin';
            header("Location: ADMIN/dashboard.php");
            exit();
        }
    }

    // Jika bukan admin, cek di tabel users
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$input_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && isset($user['password']) && is_string($user['password'])) {
        if (password_verify($input_password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'user';
            header("Location: index.php");
            exit();
        }
    }

    $error = "Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login - Jackduls Platform</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --accent-color-start: #8A2BE2; 
            --accent-color-end: #9370DB;   
            
            /* [PERUBAHAN] Nilai transparansi dibuat mendekati nol */
            --background-start: rgba(255, 255, 255, 0.05); 
            --background-end: rgba(255, 255, 255, 0.02);   
            --border-color: rgba(255, 255, 255, 0.1); 

            --shadow-color: rgba(0, 0, 0, 0.35);
            --text-color: #ffffff;
            --text-color-muted: rgba(255, 255, 255, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0a0a0a;
            position: relative;
            padding: 1rem;
        }
        
        .video-background {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100vw;
            height: 100vh;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.35; /* Opasitas video dinaikkan agar lebih terlihat jelas */
        }
        
        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .overlay {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at center, rgba(10, 0, 20, 0.1) 0%, rgba(0, 0, 0, 0.8) 90%);
            z-index: 0;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: linear-gradient(135deg, var(--background-start), var(--background-end));
            backdrop-filter: blur(4px); /* [PERUBAHAN] Nilai blur dikurangi drastis */
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            box-shadow: 0 16px 40px var(--shadow-color);
            position: relative;
            z-index: 10;
            animation: fadeIn 1s ease-out;
            display: flex;
            flex-direction: column;
            gap: 1.25rem; 
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 3.5rem;
            color: var(--accent-color-start);
            filter: drop-shadow(0 0 15px var(--accent-color-start));
        }

        .login-header {
            text-align: center;
        }
        
        .login-header h2 {
            font-weight: 600;
            font-size: 2.2rem;
            letter-spacing: 1px;
            color: var(--text-color);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        
        .login-header p {
            color: var(--text-color-muted);
            font-weight: 300;
        }
        
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .input-group {
            position: relative;
        }
        
        .input-group > .fas {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-color-muted);
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        
        .form-control {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 14px 18px 14px 50px;
            font-size: 1rem;
            font-weight: 400;
            background: transparent;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--text-color-muted);
            font-weight: 300;
        }

        .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-color-start);
            box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.3);
        }
        
        .form-control:focus ~ .fas {
            color: var(--accent-color-start);
        }
        
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-color-muted);
            z-index: 5;
            transition: color 0.3s ease;
        }
        .password-toggle:hover {
            color: var(--accent-color-start);
        }
        
        input#password {
            padding-right: 50px; 
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(90deg, var(--accent-color-start), var(--accent-color-end));
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(138, 43, 226, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(138, 43, 226, 0.5);
        }

        .register-link {
            text-align: center;
            color: var(--text-color-muted);
            text-decoration: none;
            font-weight: 400;
            transition: color 0.3s ease;
        }
        
        .register-link:hover {
            color: var(--accent-color-start);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(220, 53, 69, 0.5);
            background: rgba(220, 53, 69, 0.2);
            color: #f8d7da;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                gap: 1rem;
            }

            .login-logo {
                font-size: 3rem;
            }

            .login-header h2 {
                font-size: 1.8rem;
            }
            
            .login-header p {
                font-size: 0.9rem;
            }

            .form-control {
                padding: 12px 15px 12px 45px;
                font-size: 0.95rem;
            }

            .btn-submit {
                padding: 12px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video id="bgVideo" autoplay muted loop playsinline>
            <source src="assets/videoberanda.mp4" type="video/mp4">
            <source src="https://assets.codepen.io/3364143/screen-16_9.mp4" type="video/mp4">
        </video>
    </div>
    <div class="overlay"></div>

    <div class="login-container">
        <div class="login-logo">
            <i class="fas fa-shopping-bag"></i>
        </div>

        <header class="login-header">
            <h2>Selamat Datang</h2>
            <p>Akses akun Anda untuk melanjutkan</p>
        </header>

        <?php if (!empty($error)): ?>
            <div class="alert" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" class="login-form">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <span class="password-toggle" id="passwordToggle"><i class="fas fa-eye"></i></span>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </button>
        </form>

        <a href="register.php" class="register-link">
            Belum punya akun? Daftar sekarang
        </a>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            
            if (passwordToggle) {
                passwordToggle.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = (type === 'password') ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
        });
    </script>
</body>
</html>