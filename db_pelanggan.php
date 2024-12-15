<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'bendi_car';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                   $this->username, 
                                   $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class Pelanggan {
    private $conn;
    private $table_name = "pelanggan";

    public function __construct($database) {
        $this->conn = $database;
    }

    public function tambahPelanggan($nik, $nama_lengkap, $alamat, $no_telp) {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                    (nik, nama_lengkap, alamat, no_telp) 
                    VALUES (:nik, :nama_lengkap, :alamat, :no_telp)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':nik', $nik);
            $stmt->bindParam(':nama_lengkap', $nama_lengkap);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':no_telp', $no_telp);
            
            if($stmt->execute()) {
                return $this->conn->lastInsertId();
            }
            return false;
        } catch(PDOException $exception) {
            throw $exception;
        }
    }

    public function tampilkanPelanggan() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        } catch(PDOException $exception) {
            throw $exception;
        }
    }

    public function updatePelanggan($id, $nik, $nama_lengkap, $alamat, $no_telp) {
        try {
            $query = "UPDATE " . $this->table_name . "
                    SET nik = :nik,
                        nama_lengkap = :nama_lengkap,
                        alamat = :alamat,
                        no_telp = :no_telp
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nik', $nik);
            $stmt->bindParam(':nama_lengkap', $nama_lengkap);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':no_telp', $no_telp);
            
            return $stmt->execute();
        } catch(PDOException $exception) {
            throw $exception;
        }
    }

    public function hapusPelanggan($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':id', $id);
            
            return $stmt->execute();
        } catch(PDOException $exception) {
            throw $exception;
        }
    }

    public function cariPelangganById($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            throw $exception;
        }
    }
}
?>