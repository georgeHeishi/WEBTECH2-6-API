<?php
require_once(__DIR__ . "/../classes/controllers/DaysController.php");
require_once(__DIR__ . "/../classes/controllers/CountriesController.php");
require_once(__DIR__ . "/../classes/controllers/RecordsController.php");
require_once(__DIR__ . "/../classes/models/Record.php");
require_once(__DIR__ . "/../classes/models/Day.php");

class ReadHandler
{
    const validCollections = ["holidays", "memorials"];

    public function processRequest($request)
    {
        if (count($request) == 4) {
            $response = match ($request[0]) {
                "days" => $this->readByNameday($request),
                "names" => $this->readByName($request),
            };
        } else {
            if (in_array(end($request), self::validCollections)) {
                $response = $this->readCollection($request);
            } else {
                $response = null;
            }
        }

        return $response;
    }

    public
    function readByNameday($request)
    {
        if (count($request) != 4 || strcmp(trim($request[2]), "countries") != 0) {
            return null;
        }

        $date = $this->parseDate($request[1]);
        if (count($date) != 2) {
            return null;
        }
        $dayController = new DaysController();
        $dayId = $dayController->selectDayId($date["day"], $date["month"]);

        $countriesController = new CountriesController();
        $countryId = $countriesController->selectCountryId(trim($request[3]));

        if ($dayId == false || $countryId == false) {
            return null;
        }

        $records = (new RecordsController())->selectByDayIdCountryId(intval($dayId), intval($countryId), "name");
        if ($records == false) {
            return null;
        }

        $response = array();

        foreach ($records as $record) {
            array_push($response, $record->getValue());
        }

        return array("names" => $response);
    }

    public
    function readByName($request)
    {
        if (count($request) != 4 || strcmp(trim($request[2]), "countries") != 0) {
            return null;
        }

        $value = trim($request[1]);

        $countriesController = new CountriesController();
        $countryId = $countriesController->selectCountryId(trim($request[3]));

        if ($countryId == false) {
            return null;
        }

        $record = (new RecordsController())->selectDayIdByValueCountryId($value, $countryId);
        if ($record == false) {
            return null;
        }
        $day = (new DaysController())->selectById(intval($record->getDayId()));
        if ($day == false) {
            return null;
        }
        $date = array("day" => $day->getDay(), "month" => $day->getMonth());
        return array("date" => $date);
    }

    public
    function readCollection($request)
    {
        switch (end($request)) {
            case "holidays":
            {
                return $this->readHolidays($request);
            }
            case "memorials":
            {
                return $this->readMemorials($request);
            }
            default:
            {
                return null;
            }
        }
    }

    public
    function readHolidays($request)
    {
        if (count($request) != 3 || strcmp(trim($request[0]), "countries") != 0) {
            return null;
        }

        if (is_null($response = $this->readCollectionFromDb($request[1],'holiday'))) {
            return null;
        }

        return array("holidays" => $response);
    }

    public
    function readMemorials($request)
    {
        if (count($request) != 1) {
            return null;
        }

        if (is_null($response = $this->readCollectionFromDb('SK','memorial'))) {
            return null;
        }

        return array("memorials" => $response);
    }

    public function readCollectionFromDb($country, $type)
    {
        $countriesController = new CountriesController();
        $countryId = $countriesController->selectCountryId(trim($country));

        if ($countryId == false) {
            return null;
        }

        $records = (new RecordsController())->selectAllValueDayId(intval($countryId), trim($type));
        if ($records == false) {
            return null;
        }

        $response = array();

        foreach ($records as $record) {
            $day = (new DaysController())->selectById($record->getDayId());
            if ($day == false) {
                return null;
            }
            array_push($response,array("value" => $record->getValue() , "day" => $day->getDay(), "month" => $day->getMonth()));
        }

        return $response;
    }

    public
    function parseDate($date)
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