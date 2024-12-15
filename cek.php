<?php
$host = 'localhost';
$db = 'bendi_car';
$user = 'root';  // Ganti sesuai user database kamu
$password = '';  // Ganti sesuai password database kamu

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
