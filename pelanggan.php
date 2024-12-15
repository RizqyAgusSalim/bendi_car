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
            border-bottom: 2px solid #4CAF50;
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
            background-color: #007BFF;
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

</body>
</html>