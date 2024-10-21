<?php

declare(strict_types = 1); 

require dirname(__DIR__) . "/vendor/autoload.php";

set_exception_handler("ErrorHandler::handleExecption");

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

$resource = $parts[3];

$id = $parts[4] ?? null;

// check if the $resource is not equal to 'tasks'
if ($resource != 'tasks'){

    http_response_code(404);
    exit;

}

header('Content-type: application/json; charset=UTF-8');

// create the database object
$database = new Database('localhost', 'api_db', 'api_db_user', 'test1234');

$database->getConnection();

$controller = new TaskController;

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);

