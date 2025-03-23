<?php
require_once "./../config/Database.php";
require_once "./../models/Sensor.php";
require_once "./../core/Response.php";

class SensorController
{
    private $db;
    private $sensor;

    public function __construct()
    {
        $this->db = new Database();
        $this->sensor = new Sensor($this->db->connect());
    }

    public function getSensorAll()
    {
        $result = $this->sensor->getSensorAll();
        $this->sendResponseFromResult($result);
    }

    public function getSensorByDate($date)
    {
      $result = $this->sensor->getSensorByDate($date);
      $this->sendResponseFromResult($result);   
    }

    public function getSensorAllByDateAndBetweenTime($date, $start_time,$end_time)
    {
      $result = $this->sensor->getSensorAllByDateAndBetweenTime($date, $start_time,$end_time);
      $this->sendResponseFromResult($result);   
    }

    public function getSensorAllByBetweenDate($start_date, $end_date)
    {
      $result = $this->sensor->getSensorAllByBetweenDate($start_date, $end_date);
      $this->sendResponseFromResult($result);
    }

    public function getSensorTempByDate($date)
    {
      $result = $this->sensor->getSensorTempByDate($date);
      $this->sendResponseFromResult($result);
    }


    //ใช้ในกรณีที่ส่งมามีค่ามากกว่า 1 รายการ/แถว/เรคอร์ด/ช้อมูล
    private function sendResponseFromResult($result) {
        $num = $result->rowCount();
        if ($num > 0) {
            $sensors_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $sensors_arr[] = $row;
            }
            Response::sendResponse(200, $sensors_arr);
        } else {
            Response::sendResponse(404, ["message" => "No data found"]);
        }
    }
}
