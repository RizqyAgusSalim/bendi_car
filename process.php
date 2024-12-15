<?php
// modules/admin/process.php
require_once 'config.php';
require_once 'process.php';
session_start();
if($_SESSION['role'] != 'admin') {
    die(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

header('Content-Type: application/json');

if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'add':
            $username = trim($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $nama_lengkap = trim($_POST['nama_lengkap']);
            $role = $_POST['role'];
            
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $password, $nama_lengkap, $role]);
                echo json_encode(['success' => true]);
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            break;
            
        case 'delete':
            $id = $_POST['id'];
            try {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true]);
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}