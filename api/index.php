<?php

// Enforces strict type checking in the script, ensuring that values passed to functions must match their expected types exactly.
declare(strict_types = 1); 

// to generate autoload files run: composer dump-autoload
require dirname(__DIR__) . "/vendor/autoload.php";

// Set a custom exception handler to manage uncaught exceptions using the handleExecption method of the ErrorHandler class
set_exception_handler("ErrorHandler::handleExecption");


# Outputs the complete URI of the current request
echo $_SERVER['REQUEST_URI'], "\n";

# Extracts only the path part of the URI, excluding the query string or fragment
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

# Splits the path into an array of its segments based on the "/" delimiter
$parts = explode("/", $path);

# Assumes the 4th part of the URI is the resource (index 3 since arrays are zero-indexed)
$resource = $parts[3];

# Assumes the 5th part of the URI is the ID (index 4), and defaults to null if it's not set
$id = $parts[4] ?? null;


/* since we're developing just a tasks (to do) api. only two url are needed "/tasks" and "/task/$id"
any other url should be invalid
*/

// check if the $resource is not equal to 'tasks'
if ($resource != 'tasks'){

    //header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found");

    http_response_code(404);
    exit;

}

// Set the content type of the response to JSON and specify the character encoding as UTF-8
header('Content-type: application/json; charset=UTF-8');

// Create a new instance of the TaskController class
$controller = new TaskController;

// Call the processRequest method, passing the current request method and task ID
$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);





