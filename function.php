<?php
$host = 'localhost';
$db = 'bendi_car';
$user = 'root';  // Change according to your database user
$password = '';  // Change according to your database password

try {
    // Establish a database connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the action parameter is set in the POST request
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            // Validate and sanitize input data
            $username = trim($_POST['username']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $nama_lengkap = trim($_POST['nama_lengkap']);
            
            // Check if username is not empty and meets your criteria
            if (empty($username) || empty($nama_lengkap) || empty($role)) {
                echo json_encode(['success' => false, 'message' => 'Username, full name, and role are required.']);
                exit;
            }

            try {
                // Prepare and execute the insert statement
                $stmt = $pdo->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $password, $nama_lengkap, $role]);
                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error adding user: ' . $e->getMessage()]);
            }
            break;
            
        case 'delete':
            // Validate and sanitize input data
            $id = $_POST['id'];
            if (empty($id)) {
                echo json_encode(['success' => false, 'message' => 'User  ID is required.']);
                exit;
            }

            try {
                // Prepare and execute the delete statement
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$id]);
                if ($stmt->rowCount() > 0) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'User  not found.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error deleting user: ' . $e->getMessage()]);
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No action specified']);
}
?>