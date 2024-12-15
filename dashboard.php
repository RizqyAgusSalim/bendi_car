<?php
// Sertakan file koneksi database di bagian paling atas
require_once 'config.php'; // Pastikan file koneksi.php berisi koneksi PDO

include 'navbar.php';

// Ambil data mobil untuk ditampilkan
$stmt = $pdo->query("SELECT * FROM mobil");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bendi Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%; /* Pastikan html dan body memiliki tinggi 100% */
            margin: 0; /* Menghapus margin default */
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Mengatur arah kolom */
        }

        body {
            background-color: #f8f9fa;
        }

        .main-content {
            flex: 1; /* Membuat konten utama mengisi ruang yang tersisa */
            padding: 20px;
        }

        .car-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 10px;
            max-width: 280px;
        }

        .car-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .car-info {
            padding: 10px;
        }

        .action-links {
            background-color: #00bcd4;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-links a {
            color: white;
            text-decoration: none;
            flex: 1;
            text-align: center;
            margin: 0 5px;
        }

        .bg-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            filter: brightness(0.6);
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }

        footer {
            background-color:rgb(28, 128, 216);
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
            margin-top: auto; /* Pastikan footer berada di bawah */
        }
    </style>
</head>
<body>

    <img class="bg-img" src="assets/img/mobil.jpg" alt="bg image">
    <div class="container-fluid">
        <div class="main-content">
            <div class="row">
                <!-- Kartu mobil pertama -->
                <div class="col-md-2">
                    <div class="car-card">
                        <img src="assets/img/mobil 2 .jpg" class="car-image" alt="Camry">
                        <div class="car-info">
                            <h4>Camry</h4>
                            <p>Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                            <div class="mb-2">Toyota</div>
                            <div class="mb-2">B 1234 XYZ</div>
                            <div class="mb-2">Rp.500.000</div>
                        </div>
                        <div class="action-links">
                            <a class="btn btn-primary" href="tambah_pelanggan.php" role="button">Transaksi</a>
                            <a class="btn btn-primary" href="kartumobil.php" role="button">Manajemen Mobil</a>
                        </div>
                    </div>
                </div>
                <!-- Kartu mobil kedua -->
                <div class="col-md-2">
                    <div class="car-card">
                        <img src="assets/img/Mobil 1.jpeg" class="car-image" alt="Civic">
                        <div class="car-info">
                            <h4>Civic</h4>
                            <p>Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                            <div class="mb-2">Honda</div>
                            <div class="mb-2">B 5678 ABC</div>
                            <div class="mb-2">Rp.450.000</div>
                        </div>
                        <div class="action-links">
                            <a class="btn btn-primary" href="tambah_pelanggan.php" role="button">Transaksi</a>
                            <a class="btn btn-primary" href="kartumobil.php" role="button">Manajemen Mobil</a>
                        </div>
                    </div>
                </div>
                <!-- Kartu mobil ketiga -->
                <div class="col-md-2">
                    <div class="car-card">
                        <img src="assets/img/mobil 3.jpg" class="car-image" alt="Mobil Baru">
                        <div class="car-info">
                            <h4>Civic</h4>
                            <p>Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                            <div class="mb-2">Yamaha</div>
                            <div class="mb-2">BE 4332 J</div>
                            <div class="mb-2">Rp.34.000.000</div>
                        </div>
                        <div class="action-links">
                            <a class="btn btn-primary" href="tambah_pelanggan.php" role="button">Transaksi</a>
                            <a class="btn btn-primary" href="kartumobil.php" role="button">Manajemen Mobil</a>
                        </div>
                    </div>
                </div>
                <!-- Kartu mobil keempat -->
                <div class="col-md-2">
                    <div class="car-card">
                        <img src="assets/img/mobil 2 .jpg" class="car-image" alt="Pajero Sport">
                        <div class="car-info">
                            <h4>Pajero Sport</h4>
                            <p>Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                            <div class="mb-2">Honda</div>
                            <div class="mb-2">BE 3395 KT</div>
                            <div class="mb-2">Rp.100.000.000</div>
                        </div>
                        <div class="action-links">
                            <a class="btn btn-primary" href="tambah_pelanggan.php" role="button">Transaksi</a>
                            <a class="btn btn-primary" href="kartumobil.php" role="button">Manajemen Mobil</a>
                        </div>
                    </div>
                </div>
                <!-- Kartu mobil kelima -->
                <div class="col-md-2">
                    <div class="car-card">
                        <img src="assets/img/mobil 3.jpg" class="car-image" alt="Innova Reborn">
                        <div class="car-info">
                            <h4>Innova Reborn</h4>
                            <p>Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                            <div class="mb-2">Yamaha</div>
                            <div class="mb-2">BE 1234 AMD</div>
                            <div class="mb-2">Rp.20.000.000</div>
                        </div>
                        <div class="action-links">
                            <a class="btn btn-primary" href="tambah_pelanggan.php" role="button">Transaksi</a>
                            <a class="btn btn-primary" href="kartumobil.php" role="button">Manajemen Mobil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p> PT BENDI CAR 2024 - PEMROGRAMAN WEB II </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
