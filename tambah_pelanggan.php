<?php
ob_start(); // Mulai output buffering
require_once 'db_pelanggan.php';
include 'navbar.php';

// Inisialisasi variabel untuk pesan error dan sukses
$error = '';
$success = '';
$result = false;

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $nik = trim($_POST['nik']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $alamat = trim($_POST['alamat']);
    $no_telp = trim($_POST['no_telp']);

    // Validasi input
    $errors = [];

    if (empty($nik)) {
        $errors[] = "NIK harus diisi";
    }

    if (empty($nama_lengkap)) {
        $errors[] = "Nama Lengkap harus diisi";
    }

    if (empty($alamat)) {
        $errors[] = "Alamat harus diisi";
    }

    if (empty($no_telp)) {
        $errors[] = "Nomor Telepon harus diisi";
    }

    // Jika tidak ada error, lakukan proses tambah pelanggan
    if (empty($errors)) {
        try {
            // Buat koneksi database
            $database = new Database();
            $conn = $database->getConnection();

            // Buat objek Pelanggan
            $pelanggan = new Pelanggan($conn);

            // Cek apakah NIK sudah ada
            $check_sql = "SELECT COUNT(*) FROM pelanggan WHERE nik = :nik";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bindParam(':nik', $nik, PDO::PARAM_STR);
            $check_stmt->execute();
            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                $error = "NIK '$nik' sudah ada. Silakan gunakan NIK yang berbeda.";
            } else {
                // Tambah pelanggan
                $result = $pelanggan->tambahPelanggan($nik, $nama_lengkap, $alamat, $no_telp);

                if ($result) {
                    $success = "Pelanggan berhasil ditambahkan";
                    header("Location: tambah_pelanggan.php");
                    exit;
                } else {
                    $error = "Gagal menambahkan pelanggan";
                }
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        // Gabungkan error menjadi satu string
        $error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: rgb(28, 128, 216);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: rgb(20, 100, 180);
        }

        .error {
            color: red;
            background-color: #f4f4f4;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .success {
            color: green;
            background-color: #eeffee;
            border: 1px solid green;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2> Silahkan Memasukkan Data Pelanggan Baru</h2>

        <?php
        // Tampilkan pesan error jika ada
        if (!empty($error)): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php 
        // Tampilkan pesan sukses jika ada
        if (!empty($success)): ?>
            <div class="success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" 
                    value="<?php echo htmlspecialchars($nik ?? ''); ?>" 
                    required>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" 
                    value="<?php echo htmlspecialchars($nama_lengkap ?? ''); ?>" 
                    required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" 
                    value="<?php echo htmlspecialchars($alamat ?? ''); ?>" 
                    required>
            </div>

            <div class="form-group">
                <label for="no_telp">Nomor Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" 
                    value="<?php echo htmlspecialchars($no_telp ?? ''); ?>" 
                    required>
            </div>

            <button type="submit" class="btn">Tambah Pelanggan</button>
        </form>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Akhiri output buffering
?>