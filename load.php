<?php
require_once(__DIR__ . "/classes/controllers/DaysController.php");
require_once(__DIR__ . "/classes/controllers/CountriesController.php");
require_once(__DIR__ . "/classes/controllers/RecordsController.php");

$xml = simplexml_load_file(__DIR__ . "/file/meniny.xml");

$countries = [
    "SK" => "Slovensko",
    "CZ" => "Česko",
    "AT" => "Rakúsko",
    "HU" => "Maďarsko",
    "PL" => "Poľsko"
];

$holidays = [
    "SKsviatky" => "SK",
    "CZsviatky" => "CZ"
];

$memorials = [
    "SKdni" => "SK"
];

$daysController = new DaysController();
$countriesController = new CountriesController();
$recordsController = new RecordsController();

$daysController->prepareInsert();
$countriesController->prepareInsert();
$recordsController->prepareInsert();

foreach ($xml->children() as $row) {
    $day = substr($row->den, 2, 2);
    $month = substr($row->den, 0, 2);
    $daysController->insertDay($day, $month);

    $day_id = $daysController->selectDayId(intval($day), intval($month));

    foreach (array_keys((array)$row) as $item) {

        if (array_key_exists($item, $countries)) {
            $code = $item;
            $title = $countries[$item];
            $countriesController->insertCountry($title, $code);

            $country_id = $countriesController->selectCountryId($code);

            $type = "name";
            foreach (explode(",", $row->$item) as $name) {
                $value = trim(preg_replace('/[\-]+/i', '', $name));
                $recordsController->insertRecord($day_id, $country_id, $type, $value);
            }
        }

        if (array_key_exists($item, $holidays)) {
            $code = $holidays[$item];
            $title = $countries[$code];
            $countriesController->insertCountry($title, $code);

            $country_id = $countriesController->selectCountryId($code);

            $type = "holiday";

            $value = trim($row->$item);
            $recordsController->insertRecord($day_id, $country_id, $type, $value);
        }

        if (array_key_exists($item, $memorials)) {
            $code = $memorials[$item];
            $title = $countries[$code];
            $countriesController->insertCountry($title, $code);

            $country_id = $countriesController->selectCountryId($code);

            $type = "memorial";

            $value = trim($row->$item);
            $recordsController->insertRecord($day_id, $country_id, $type, $value);
        }
    }

    $type = "name";
    $country_id = $countriesController->selectCountryId("SK");
    foreach (explode(",", $row->SKd) as $name) {

        $value = trim(preg_replace('/[\-]+/i', '', $name));
        if (strlen($value) > 0) {
            $recordsController->insertRecord($day_id, $country_id, $type, $value);
        }
    }
}
header('Location: https://wt98.fei.stuba.sk/namedays/');