<?php
class Koneksi {
    protected $conn;
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $database   = "ti41";

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Koneksi Gagal : " . $e->getMessage();
            exit;
        }
    }
}
?>