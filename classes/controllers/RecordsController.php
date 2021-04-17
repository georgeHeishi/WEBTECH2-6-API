<?php
require_once(__DIR__ . "/../database/Database.php");
require_once(__DIR__ . "/../models/Record.php");

class RecordsController
{
    private ?PDO $conn;

    public $insertStm;

    public int $day_id;
    public int $country_id;
    public string $type;
    public string $value;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function prepareInsert()
    {
        $this->day_id = 0;
        $this->country_id = 0;
        $this->type = "";
        $this->value = "";

        $this->insertStm = $this->conn->prepare("INSERT IGNORE INTO records (day_id, country_id, type, value) VALUES (:day_id, :country_id , :type ,:value)");
        $this->insertStm->bindParam(":day_id", $this->day_id, PDO::PARAM_INT);
        $this->insertStm->bindParam(":country_id", $this->country_id, PDO::PARAM_INT);
        $this->insertStm->bindParam(":type", $this->type);
        $this->insertStm->bindParam(":value", $this->value);
    }

    public function insertRecord($day_id, $country_id, $type, $value)
    {
        $this->day_id = $day_id;
        $this->country_id = $country_id;
        $this->type = $type;
        $this->value = $value;

        $this->insertStm->execute();
    }

    public function selectByDayIdCountryId($dayId, $countryId, $type)
    {
        $stm = $this->conn->prepare("SELECT value FROM records WHERE day_id=:day_id AND country_id=:country_id AND type=:type");
        try {
            $stm->bindParam(":day_id", $dayId, PDO::PARAM_INT);
            $stm->bindParam(":country_id", $countryId, PDO::PARAM_INT);
            $stm->bindParam(":type", $type);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_CLASS, "Record");
            return $stm->fetchAll();
        } catch (Error $e) {
            return false;
        }
    }

    public function selectDayIdByValueCountryId($value, $countryId)
    {
        $stm = $this->conn->prepare("SELECT day_id FROM records WHERE value=:value AND country_id=:country_id AND type='name'");
        try {
            $stm->bindParam(":value", $value);
            $stm->bindParam(":country_id", $countryId, PDO::PARAM_INT);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_CLASS, "Record");
            return $stm->fetch();
        } catch (Error $e) {
            return false;
        }
    }

}