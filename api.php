<?php
require_once(__DIR__ . "/api/ReadHandler.php");
require_once(__DIR__ . "/api/CreateHandler.php");

require_once(__DIR__ . "/classes/controllers/CountriesController.php");
require_once(__DIR__ . "/classes/controllers/DaysController.php");
require_once(__DIR__ . "/classes/controllers/RecordsController.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$handler = null;

switch ($method){
    case 'GET':
        $handler = new ReadHandler();
    case 'POST':
        $handler = new CreateHandler();
    default:{
        http_response_code(404);  //http_response_code — Get or Set the HTTP response code
        die();
    }
}