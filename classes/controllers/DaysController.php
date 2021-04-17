<?php
require_once(__DIR__ . "/../database/Database.php");
require_once(__DIR__ . "/../models/Day.php");

class DaysController
{
    private ?PDO $conn;

    public $insertStm;

    public string $day;
    public string $month;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function prepareInsert()
    {
        $this->day = "";
        $this->month = "";

        $this->insertStm = $this->conn->prepare("INSERT IGNORE INTO days (day, month) VALUES (:day, :month)");
        $this->insertStm->bindParam(":day", $this->day);
        $this->insertStm->bindParam(":month", $this->month);
    }

    public function insertDay($day, $month)
    {
        $this->day = $day;
        $this->month = $month;
        $this->insertStm->execute();
    }

    public function selectById($id){
        $stm = $this->conn->prepare("SELECT day,month FROM days WHERE id=:id");
        try {
            $stm->bindParam(":id", $id, PDO::PARAM_INT);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_CLASS, "Day");
            return $stm->fetch();
        } catch (Error $e) {
            return false;
        }
    }

    public function selectDayId($day, $month)
    {
        $stm = $this->conn->prepare("SELECT id FROM days WHERE day=:day AND month=:month");
        try {
            $stm->bindParam(":day", $day, PDO::PARAM_INT);
            $stm->bindParam(":month", $month, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (Error $e) {
            return false;
        }
    }

}