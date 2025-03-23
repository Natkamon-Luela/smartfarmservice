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
    //ดึงข้อมูลตามวันที่
    public function getSensorByDate($date)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE recorded_date = '" . $date . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //ดึงข้อมูลตามวันที่และเวลา
    public function getSensorAllByDateAndBetweenTime($date, $start_time,$end_time)
    {   //Select * from ชื่อ tb where date = '?????' and time between '??????' and '??????'
       // $query = "SELECT * FROM " . $this->table . " WHERE recorded_date = '" . $date . "' and recorded_time between '" . $start_time . "' and '" . $end_time . "'";
        $query = "SELECT * FROM  $this->table WHERE recorded_date = ' $date ' AND recorded_time BETWEEN '$start_time ' AND ' $end_time '";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //ดึงข้อมูลตามวันนี้ถึงวันนี้
    public function getSensorAllByBetweenDate($start_date, $end_date)
    {
        $query = "SELECT * FROM  $this->table  WHERE recorded_date between ' $start_date ' and ' $end_date '";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //ดึงข้อมูลตามวันที่และอุณหภูมิ
    public function getSensorTempByDate($date)
    {
        $query = "SELECT temperature FROM " . $this->table . " WHERE recorded_date = '" . $date . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
