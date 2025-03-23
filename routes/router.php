<?php
//กำหนด route หลัก ในการใช้งาน CRUD จากฝั่ง client ไปยังฝั่ง server

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "./../core/Request.php";
require_once "./../controllers/SensorController.php";

//สร้างตัวแปรที่ใช้ทำงานกับ controller
$sensorController = new SensorController();
Request::handleRequest("GET", "/smartfarmservice/sensors", function () use ($sensorController) {  //ดึงข้อมูลทั้งหมด get /smartfarmservice/sensors
    $sensorController->getSensorAll();
});
Request::handleRequest("GET", "/smartfarmservice/sensors/date", function () use ($sensorController) { 
    $sensorController->getSensorByDate($_GET["date"]);
});
Request::handleRequest("GET", "/smartfarmservice/sensors/dateandtime", function () use ($sensorController) {
    $sensorController->getSensorAllByDateAndBetweenTime($_GET["date"], $_GET["start_time"], $_GET["end_time"]);
});
Request::handleRequest("GET", "/smartfarmservice/sensors/dateanddate", function () use ($sensorController) {
    $sensorController->getSensorAllByBetweenDate($_GET["start_date"], $_GET["end_date"]);
});
Request::handleRequest("GET", "/smartfarmservice/sensors/datetemp", function () use ($sensorController) {
    $sensorController->getSensorTempByDate($_GET["date"]);
});