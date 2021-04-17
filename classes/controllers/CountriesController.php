<?php
require_once(__DIR__ . "/../database/Database.php");

class CountriesController
{
    private ?PDO $conn;

    public $insertStm;

    public string $title;
    public string $code;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function prepareInsert()
    {
        $this->title = "";
        $this->code = "";

        $this->insertStm = $this->conn->prepare("INSERT IGNORE INTO countries (title, code) VALUES (:title, :code)");
        $this->insertStm->bindParam(":title", $this->title);
        $this->insertStm->bindParam(":code", $this->code);
    }

    public function insertCountry($title, $code)
    {
        $this->title = $title;
        $this->code = $code;
        $this->insertStm->execute();
    }

    public function selectCountryId($code)
    {
        $stm = $this->conn->prepare("SELECT id FROM countries WHERE code=:code");
        try {
            $stm->bindParam(":code", $code);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (Error $e) {
            return false;
        }
    }
}