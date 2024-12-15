<?php
include 'config.php'; // Pastikan file ini ada dan koneksi ke database berhasil
session_start(); // Memulai sesi untuk menyimpan informasi login

$error = ''; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi.';
    } else {
        // Mencari pengguna di database
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Memeriksa apakah pengguna ditemukan dan memverifikasi password
            if ($user && $password === $user['password']) { // Menghapus password_verify
                // Jika berhasil, simpan informasi pengguna di sesi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Alihkan ke halaman dashboard atau halaman lain setelah login berhasil
                header("Location: dashboard.php");
                exit;
            } else {
                $error = 'Username atau password salah.';
            }
        } catch (PDOException $e) {
            $error = 'Terjadi kesalahan saat memproses login: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bendi Car - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .login-container {
            max-width: 400px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
        }

        .brand-name {
            color: white;
            font-size: 1.2rem;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .login-btn {
            background: #764ba2;
            border: none;
            padding: 10px 30px;
        }

        .login-btn:hover {
            background: #667eea;
        }

        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }
    </style>
</head>
<body>
<div class="brand-name">
    <img src="assets/img/logo Bendi car.png" alt="Logo" style="height: 60px; margin-right: 20px;"> <!-- Tambahkan logo di sini -->
    PT Bendi Car
</div>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h2 class="text-center welcome-text">SELAMAT DATANG DI</h2>
        <h3 class="text-center welcome-text mb-4">PT Bendi Car</h3>
        
        <div class="login-container">
            <form method="POST" action="login.php">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary login-btn px-4">Login</button>
                </div>
                <hr/>
                <div class="register">
                    Belum punya Akun? <a href="register.php">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>