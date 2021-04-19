<?php
header("Content-type: application/json; charset=utf-8");

require_once(__DIR__ . "/api/ReadHandler.php");
require_once(__DIR__ . "/api/CreateHandler.php");

require_once(__DIR__ . "/classes/controllers/CountriesController.php");
require_once(__DIR__ . "/classes/controllers/DaysController.php");
require_once(__DIR__ . "/classes/controllers/RecordsController.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

$request = array_slice(explode('/', trim($_SERVER['REQUEST_URI'], '/')),2);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$handler = null;

switch ($method) {
    case 'GET':
        $handler = new ReadHandler();
        if (is_null($response = $handler->processRequest($request))) {
            $response = array();
            $response["error"] = true;
            echo json_encode($response);
            http_response_code(404);
        } else {
            $response["error"] = false;
            echo json_encode($response);
            http_response_code(200);  //http_response_code — Get or Set the HTTP response code
        }
        break;
    case 'POST':
        $handler = new CreateHandler();
        if (is_null($return = $handler->createName($request, $data))) {
            $response = array();
            $response["error"] = true;
            echo json_encode($response);
            http_response_code(404);
        } else {
            if($return){
                $response["error"] = false;
                $response["record"] = array("name" => $data->name,"day" => $data->day);
                echo json_encode($response);
                http_response_code(201);  //http_response_code — Get or Set the HTTP response code
            }else{
                $response["error"] = true;
                echo json_encode($response);
                http_response_code(409);  //http_response_code — Get or Set the HTTP response code
            }
        }
        break;
    default:
        http_response_code(405);
        die();
}

