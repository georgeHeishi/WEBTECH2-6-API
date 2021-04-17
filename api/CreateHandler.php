<?php
require_once(__DIR__ . "/../classes/controllers/DaysController.php");
require_once(__DIR__ . "/../classes/controllers/CountriesController.php");
require_once(__DIR__ . "/../classes/controllers/RecordsController.php");

class CreateHandler
{

    public function createName($request)
    {
        if (count($request) != 4 || strcmp(trim($request[0]), "names") != 0 || strcmp(trim($request[2]), "namedays") != 0) {
            return null;
        }
        $date = $this->parseDate($request[3]);
        if (count($date) != 2) {
            return null;
        }
        $countriesController = new CountriesController();
        $countriesController->prepareInsert();
        $countriesController->insertCountry("Slovensko", "SK");

        $daysController = new DaysController();
        $daysController->prepareInsert();
        $daysController->selectDayId(intval($date["day"]), intval($date["month"]));

        $countryId = (new CountriesController())->selectCountryId('SK');
        $dayId = (new DaysController())->selectDayId($date["day"], $date["month"]);
        if($countryId == false || $dayId == false){
            return null;
        }

        $recordsController = new RecordsController();
        if($recordsController->insertRecordNonIgnore(intval($dayId),intval($countryId),'name',$request[1])){
            return true;
        }else{
            return false;
        }
    }

    public function parseDate($date)
    {
        $parsedDate = array();
        $values = explode('.', trim($date));
        if (isset($values[0])) {
            $parsedDate["day"] = $values[0];
        }
        if (isset($values[1])) {
            $parsedDate["month"] = $values[1];
        }
        return $parsedDate;
    }
}