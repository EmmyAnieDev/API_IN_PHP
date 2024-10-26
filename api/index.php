<?php

declare(strict_types = 1); 

require dirname(__DIR__) . "/vendor/autoload.php";

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleExecption");

// Create an immutable instance of Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__)); 
$dotenv->load();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

$resource = $parts[3];

$id = $parts[4] ?? null;

// check if the $resource is not equal to 'tasks'
if ($resource != 'tasks'){

    http_response_code(404);
    exit;

}

if (empty($_SERVER["HTTP_X_API_KEY"])) {

    http_response_code(400);
    echo json_encode(["message" => "missing API key"]);
    exit;

}

$api_key = $_SERVER["HTTP_X_API_KEY"];    //  http http://localhost/php_api/api/tasks X-API-Key:haisdjocjkalsc

echo $api_key;
exit;

header('Content-type: application/json; charset=UTF-8');

// create the database object
$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

// Passing the $database object to the TaskGateway constructor
$taskGateway = new TaskGateway($database);

// Passing the $taskGateway object to the TaskController constructor
$controller = new TaskController($taskGateway);

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);

