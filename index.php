<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bendi Car - Sewa Mobil Terpercaya</title>
    <meta name="description" content="Bendi Car menyediakan layanan sewa mobil terbaik dengan berbagai pilihan kendaraan berkualitas.">
    <meta name="keywords" content="sewa mobil, rental mobil, transportasi, Bendi Car">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Sticky Footer */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1 0 auto; /* Pastikan konten utama mendapatkan ruang */
        }

        .footer {
            flex-shrink: 0; /* Footer tetap berada di bawah */
            background-color: #f8f9fa; /* Warna latar belakang footer */
            padding: 10px 0; /* Padding footer */
        }

        .navbar-brand {
            font-weight: bold;
            color: #007bff !important;
        }

        .hero-section {
            background-color: transparent;
            padding: 50px 0;
            text-align: center;
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

        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar dengan Toggle -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" aria-label="Beranda Bendi Car">
                <i class="fas fa-car"></i> Bendi Car
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="#" aria-label="Halaman Utama">
                            <i class="fas fa-home me-1 text-primary"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#" aria-label="Daftar Mobil">
                            <i class="fas fa-car me-1 text-primary"></i>Mobil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#" aria-label="Informasi Transaksi">
                            <i class="fas fa-exchange-alt me-1 text-primary"></i>Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#" aria-label="Hubungi Kami">
                            <i class="fas fa-envelope me-1 text-primary"></i>Kontak
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Background Image -->
    <img class="bg-img" src="assets/img/mobil.jpg" alt="bg image">

    <!-- Konten Utama dengan class content -->
    <div class="content">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container">
                <h1 class="display-4 text-white">Selamat Datang di PT Bendi Car</h1>
                <p class="lead text-white">Sewa Mobil Mudah, Nyaman, dan Terpercaya</p>
                <a href="login.php" class="btn btn-primary btn-lg mt-3" aria-label="Lihat Mobil Tersedia">
                    Lihat Mobil <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Mudah</h5>
                            <p class="card-text">Proses sewa mobil cepat dan sederhana.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-shield-alt text-primary me-2"></i>Aman</h5>
                            <p class="card-text">Jaminan keamanan dan kualitas mobil terjamin.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tag text-warning me-2"></i>Terjangkau</h5>
                            <p class="card-text">Harga sewa mobil yang kompetitif.</p>
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Fleksibel</h5>
                            <p class="card-text">Pilihan waktu sewa yang sesuai kebutuhan Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tag text-warning me-2"></i>Dukungan 24/7</h5>
                            <p class="card-text">Layanan pelanggan yang selalu siap membantu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer dengan class footer -->
    <footer class="footer bg-transparent py-4 mt-auto">
        <div class="container text-center text-primary">
            <p class="mb-0">&copy; 2023 Bendi Car. Pemrograman Web 2.</p>
        </div>
    </footer>

    <!-- JavaScript untuk Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>