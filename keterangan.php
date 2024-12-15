<?php
// Sertakan file koneksi database di bagian paling atas
require_once 'config.php'; // Pastikan file koneksi.php berisi koneksi PDO

include 'navbar.php';

// Ambil data mobil untuk ditampilkan
$stmt = $pdo->query("SELECT * FROM mobil");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PT Bendi Car</title>
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
            color: #4CAF50;
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
            color: #4CAF50;
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
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
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
        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="dashboard.php" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; text-decoration: none;">Kembali</a>
        </div>
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
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
</body>
</html>