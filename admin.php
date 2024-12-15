<?php
// Sertakan file koneksi database di bagian paling atas
require_once 'config.php'; // Pastikan file koneksi.php berisi koneksi PDO
include 'navbar.php';
// Proses penambahan mobil
if (isset($_POST['add'])) {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $tahun = $_POST['tahun'];
    $plat_nomor = $_POST['plat_nomor'];
    $harga_sewa = $_POST['harga_sewa'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO mobil (merk, model, tahun, plat_nomor, harga_sewa, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$merk, $model, $tahun, $plat_nomor, $harga_sewa, $status]);
}

// Proses penghapusan mobil
if (isset($_POST['delete'])) {
    $plat_nomor = $_POST['plat_nomor'];
    $stmt = $pdo->prepare("DELETE FROM mobil WHERE plat_nomor = ?");
    $stmt->execute([$plat_nomor]);
}

// Ambil data mobil untuk ditampilkan
$stmt = $pdo->query("SELECT * FROM mobil");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin PT Bendi Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #0056b3;
        }
        .card-content {
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type=text],
        input[type=number] {
            width: 100%;
            padding: 8px 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #da190b;
        }
        .action-column {
            text-align: center;
        }
        .status-tersedia {
            color: #4CAF50;
            font-weight: bold;
        }
        .status-disewa {
            color: #f44336;
            font-weight: bold;
        }
        .harga {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin PT Bendi Car</h1>
        
        <div class="dashboard">
            <div class="card">
                <div class="card-title">Total Mobil</div>
                <div class="card-content" id="total-mobil">
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) as total FROM mobil");
                    echo $stmt->fetch()['total'];
                    ?>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Mobil Tersedia</div>
                <div class="card-content" id="mobil-tersedia">
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) as tersedia FROM mobil WHERE status='tersedia'");
                    echo $stmt->fetch()['tersedia'];
                    ?>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Mobil Disewa</div>
                <div class="card-content" id="mobil-disewa">
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) as disewa FROM mobil WHERE status='disewa'");
                    echo $stmt->fetch()['disewa'];
                    ?>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-responsive">
            <table>
                <tr>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Tahun</th>
                    <th>Plat Nomor</th>
                    <th>Harga Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["merk"]); ?></td>
                    <td><?php echo htmlspecialchars($row["model"]); ?></td>
                    <td><?php echo htmlspecialchars($row["tahun"]); ?></td>
                    <td><?php echo htmlspecialchars($row["plat_nomor"]); ?></td>
                    <td class="harga">Rp <?php echo number_format($row["harga_sewa"], 2, ',', '.'); ?></td>
                    <td class="status-<?php echo strtolower($row["status"]); ?>"><?php echo htmlspecialchars($row["status"]); ?></td>
                    <td class="action-column">
                        <button class="delete-btn" onclick="hapusMobil('<?php echo $row["plat_nomor"]; ?>')">Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <h2>Tambah Mobil Baru</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="merk">Merk:</label>
                    <input type="text" id="merk" name="merk" required>
                </div>

                <div class="form-group">
                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model" required>
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <input type="number" id="tahun" name="tahun" required>
                </div>

                <div class="form-group">
                    <label for="plat_nomor">Plat Nomor:</label>
                    <input type="text" id="plat_nomor" name="plat_nomor" required>
                </div>

                <div class="form-group">
                    <label for="harga_sewa">Harga Sewa:</label>
                    <input type="number" id="harga_sewa" name="harga_sewa" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" required>
                </div>

                <button type="submit" name="add">Tambah Mobil</button>
            </form>
        </div>
    </div>

    <script>
        function hapusMobil(platNomor) {
            if (confirm('Apakah Anda yakin ingin menghapus mobil dengan plat nomor ' + platNomor + '?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'plat_nomor';
                input.value = platNomor;
                form.appendChild(input);

                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'delete';
                actionInput.value = '1';
                form.appendChild(actionInput);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

<?php
require_once 'db_pelanggan.php';

$database = new Database();
$conn = $database->getConnection();

$pelanggan = new Pelanggan($conn);

$message = '';
$result = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    try {
        if (empty($id)) {
            $result = $pelanggan->tambahPelanggan($nik, $nama_lengkap, $alamat, $no_telp);
            $message = $result ? "Pelanggan berhasil ditambahkan" : "Gagal menambahkan pelanggan";
        } else {
            $result = $pelanggan->updatePelanggan($id, $nik, $nama_lengkap, $alamat, $no_telp);
            $message = $result ? "Pelanggan berhasil diupdate" : "Gagal mengupdate pelanggan";
        }
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
        $result = false;
    }
}

if (isset($_GET['hapus'])) {
    try {
        $id = $_GET['hapus'];
        $result = $pelanggan->hapusPelanggan($id);
        $message = $result ? "Pelanggan berhasil dihapus" : "Gagal menghapus pelanggan";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
        $result = false;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Data Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
            line-height: 1.6;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #0056b3        ;
            padding-bottom: 10px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .alert-danger {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text "] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manajemen Data Pelanggan</h2>

    <?php if ($message): ?>
        <div class="alert <?= $result ? 'alert-success' : 'alert-danger' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="no_telp">No. Telepon:</label>
            <input type="text" id="no_telp" name="no_telp" required>
        </div>
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <button type="submit">Simpan</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $result = $pelanggan->tampilkanPelanggan();
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['no_telp']) . "</td>";
                    echo "<td>
                            <button onclick='editPelanggan(" . $row['id'] . ")' class='action-btn edit-btn'>Edit</button>
                            <a href='?hapus=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin?\")' class='action-btn delete-btn'>Hapus</a>
                        </td>";
                    echo "</tr>";
                }
            } catch (Exception $e) {
                echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function editPelanggan(id) {
        // Fetch data for the selected customer and populate the form
        fetch('get_pelanggan.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('nik').value = data.nik;
                document.getElementById('nama_lengkap').value = data.nama_lengkap;
                document.getElementById('alamat').value = data.alamat;
                document.getElementById('no_telp').value = data.no_telp;
                document.querySelector('input[name="id"]').value = data.id;
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<?php
// Konfigurasi database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'bendi_car'; // Nama database
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

try {
    // Membuat koneksi menggunakan PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Mengatur mode error PDO untuk melempar exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Menghapus pengguna jika ada permintaan penghapusan
    if (isset($_GET['delete_username'])) {
        $delete_username = $_GET['delete_username'];
        $delete_sql = "DELETE FROM users WHERE username = :username";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bindParam(':username', $delete_username, PDO::PARAM_STR);
        $delete_stmt->execute();
        echo "Pengguna dengan username '$delete_username' telah dihapus.<br>";
    }

    // Query untuk mengambil data dari tabel users
    $sql = "SELECT username, password FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Memeriksa apakah ada hasil
    if ($stmt->rowCount() > 0) {
        // Menampilkan data dalam tabel HTML
        echo "<table border='1'>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>";
        
        // Mengambil setiap baris data
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["username"]) . "</td>
                    <td>" . htmlspecialchars($row["password"]) . "</td>
                    <td>
                        <a href='?delete_username=" . htmlspecialchars($row["username"]) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\");'>Hapus</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 hasil";
    }
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Menutup koneksi
$conn = null;
?>

</body>
</html>
</body>
</html>