<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .notification {
            margin-top: 15px;
            text-align: center;
            color: #d9534f; /* Warna merah untuk notifikasi */
        }
        .back-button {
            margin-top: 15px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            padding: 10px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    $notification = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($username) && !empty($password)) {
            try {
                // Koneksi database menggunakan PDO
                $dsn = 'mysql:host=localhost;dbname=nama_database';
                $pdo = new PDO($dsn, 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);

                // Simpan password langsung tanpa hash
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->execute(['username' => $username, 'password' => $password]);

                $notification = 'Akun berhasil ditambahkan.';
            } catch (PDOException $e) {
                $notification = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        } else {
            $notification = 'Harap isi semua kolom.';
        }
    }
    ?>

    <form action="" method="POST">
        <h2>Form Penambahan Akun</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Tambah Akun</button>

        <?php if ($notification): ?>
            <div class="notification"> <?php echo $notification; ?> </div>
        <?php endif; ?>

        <?php if ($notification === 'Akun berhasil ditambahkan.'): ?>
            <button type="button" class="back-button" onclick="window.location.href='login.php'">Kembali ke Login</button>
        <?php endif; ?>
    </form>
</body>
</html>
