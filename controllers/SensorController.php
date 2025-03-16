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
