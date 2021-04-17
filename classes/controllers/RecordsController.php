<?php
require_once (__DIR__ . "/../database/Database.php");

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

    public function insertRecord($day_id, $country_id, $type ,$value)
    {
        $this->day_id = $day_id;
        $this->country_id = $country_id;
        $this->type = $type;
        $this->value = $value;

        $this->insertStm->execute();
    }

}