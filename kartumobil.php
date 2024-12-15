<?php
// Konfigurasi koneksi database
$host = 'localhost';
$dbname = 'bendi_car';
$username = 'root';
$password = '';

include 'navbar.php';

try {
    // Membuat koneksi PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Mengatur mode error PDO ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tampilkan struktur tabel
    $stmt = $conn->prepare("DESCRIBE mobil");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Query untuk mengambil data mobil
    $stmt = $conn->prepare("SELECT * FROM mobil");
    $stmt->execute();

    // Mengambil semua data
    $mobils = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Tangani error koneksi
    die("Koneksi gagal: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kartu Mobil</title>
    <style>
        body {
            background: url('assets/img/mobil.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 80px; /* Menyesuaikan jarak dari navbar */
        }

        .card {
            background: rgba(255, 255, 255, 0.9); /* Transparansi untuk card */
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Konten Utama -->
    <div class="container mt-4">
        <div class="row">
            <?php
            if (!empty($mobils)) {
                foreach($mobils as $mobil) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Sesuaikan nama kolom berdasarkan hasil debug -->
                    <img src="assets/img/Mobil 1.jpeg" class="card-img-top" alt="<?php echo htmlspecialchars($mobil['type'] ?? ''); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($mobil['merk'] ?? ''); ?></h5>
                        <p class="card-text">Nyaman Dipakai Untuk Offroad, Jalan Jelek dll</p>
                        <p class="card-text">
                            <?php echo htmlspecialchars($mobil['model'] ?? ''); ?> <hr/>
                            <?php echo htmlspecialchars($mobil['plat_nomor'] ?? ''); ?><hr/>
                            Tahun <?php echo htmlspecialchars($mobil['tahun'] ?? ''); ?><hr/>
                        </p>
                        <p class="card-text">Rp. <?php echo number_format($mobil['harga_sewa'] ?? 0, 0, ',', '.'); ?></p>
                        <div class="action-links">
                            <a class="btn btn-primary" href="login.php" role="button">Beli</a>
                            <a class="btn btn-primary" href="login.php" role="button">Manajemen Mobil</a>
                            <a class="btn btn-primary" href="index.php" role="button">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<div class='col-12'><p class='alert alert-info'>Tidak ada mobil yang ditemukan.</p></div>";
            }
            ?>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
