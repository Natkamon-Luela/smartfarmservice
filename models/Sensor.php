<?php
class Sensor
{
    private $conn;
    private $table = "sensor_tb";

    public $id;
    public $temperature;
    public $humidity;
    public $light;
    public $pm_value;
    public $recorded_date;
    public $recorded_time;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getSensorAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY recorded_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
