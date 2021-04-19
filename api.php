<?php
header("Content-Type: application/json; charset=UTF-8");

require_once(__DIR__ . "/api/ReadHandler.php");
require_once(__DIR__ . "/api/CreateHandler.php");

require_once(__DIR__ . "/classes/controllers/CountriesController.php");
require_once(__DIR__ . "/classes/controllers/DaysController.php");
require_once(__DIR__ . "/classes/controllers/RecordsController.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

$request = array_slice(explode('/', trim(urldecode($_SERVER['REQUEST_URI']), '/')),2);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$handler = null;

switch ($method) {
    case 'GET':
        $handler = new ReadHandler();
        $response = array();
        if (is_null($return = $handler->processRequest($request))) {
            $response["status"] = 404;
            $response["message"] = "Not found";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            http_response_code(404);
        } else {
            $response["status"] = 200;
            $response["message"] = "OK";
            $response["data"] = $return;
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            http_response_code(200);
        }
        break;
    case 'POST':
        $handler = new CreateHandler();
        $response = array();
        if (is_null($return = $handler->createName($request, $data))) {
            $response["status"] = 404;
            $response["message"] = "Not found";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            http_response_code(404);
        } else {
            if($return){
                $response["status"] = 201;
                $response["message"] = "Successfully created";
                $response["data"] = array("name" => $data->name,"day" => $data->day);
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                http_response_code(201);
            }else{
                $response["status"] = 409;
                $response["message"] = "Conflict, object already exists";
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                http_response_code(409);
            }
        }
        break;
    default:
        http_response_code(405);
        die();
}

