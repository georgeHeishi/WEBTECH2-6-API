<?php
header("Content-type: application/json; charset=utf-8");

require_once(__DIR__ . "/api/ReadHandler.php");
require_once(__DIR__ . "/api/CreateHandler.php");

require_once(__DIR__ . "/classes/controllers/CountriesController.php");
require_once(__DIR__ . "/classes/controllers/DaysController.php");
require_once(__DIR__ . "/classes/controllers/RecordsController.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$handler = null;

switch ($method) {
    case 'GET':
        $handler = new ReadHandler();
        break;
    case 'POST':
        $handler = new CreateHandler();
        break;
    default:
        http_response_code(405);
        die();
}

if (is_null($response = $handler->processRequest($request))){
    $response = array();
    $response["error"] = true;
    $response["request"] = $request;
    echo json_encode( $response);
    http_response_code(404);
}else{
    $response["error"] = false;
    echo json_encode($response);
    http_response_code(200);  //http_response_code — Get or Set the HTTP response code
}


