<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bendi Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            width: 100%; /* Pastikan navbar mengambil lebar penuh */
            position: relative; /* Pastikan navbar tidak terpotong */
            z-index: 1000; /* Pastikan navbar berada di atas konten lainnya */
            background-color: rgb(28, 128, 216);
        }

        .navbar .navbar-nav .nav-link {
            padding: 15px 20px; /* Tambahkan padding untuk link navbar */
            position: relative; /* Pastikan posisi relatif untuk pseudo-element */
        }

        .navbar .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0; /* Garis akan muncul di bawah link */
            height: 2px; /* Tinggi garis */
            background-color: #00bcd4; /* Warna garis */
            transform: scaleX(0); /* Mulai dengan garis tidak terlihat */
            transition: transform 0.3s ease; /* Transisi untuk animasi */
        }

        .navbar .navbar-nav .nav-link:hover::after {
            transform: scaleX(1); /* Garis muncul saat hover */
        }

        .navbar .navbar-brand {
            font-weight: bold; /* Membuat brand lebih menonjol */
        }

        .header {
            background-color: #00bcd4;
            color: white;
            padding: 15px;
        }

        /* CSS untuk tombol Logout */
        .logout-btn {
            background-color: #ff4d4d; /* Warna latar belakang merah */
            color: white; /* Warna teks putih */
            border: none; /* Menghapus border default */
            padding: 10px 20px; /* Padding untuk tombol */
            border-radius: 5px; /* Sudut membulat */
            transition: background-color 0.3s; /* Transisi untuk efek hover */
            text-decoration: none; /* Menghapus garis bawah pada link */
            display: inline-block; /* Agar padding berfungsi dengan baik */
        }

        .logout-btn:hover {
            background-color: #ff1a1a; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <!-- Container Fluid untuk Navbar -->
    <div class="container-fluid">
        <!-- Navbar Code Here -->
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo Bendi car.png" alt="Logo" style="height: 60px; margin-right: 10px;"> <!-- Tambahkan logo di sini -->
                    PT Bendi Car
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kartumobil.php">Manajemen Mobil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Spesifikasi.php">Spesifikasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tambah_pelanggan.php">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="keterangan.php">Keterangan</a>
                        </li>
                        <li class="nav -item">
                            <a class="nav-link text-dark" href="Loginadmin.php">Login Admin</a>
                        </li>
                    </ul>
                    <div class="ms-auto">
                        <span class="me-3">SELAMAT DATANG</span>
                        <a href="logout.php" class="logout-btn">Logout</a> <!-- Menggunakan kelas logout-btn -->
                    </div>
                </div>
            </div>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>