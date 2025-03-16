<?php
class Database {
    private $host = "mysql-3271ec56-sau-9f60.e.aivencloud.com:17189";
    private $db_name = "smart_farm";
    private $username = "avnadmin";
    private $password = "AVNS_grpsGfz3AhXjXPlDFDR";
    private $conn;
 
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database Connection Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>